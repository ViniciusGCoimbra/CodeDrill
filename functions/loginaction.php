<?php
session_start();

// Conexão com o banco de dados
include_once __DIR__ . '/../config/conexao.php';

// Configurações de segurança
$maxTentativas = 5;       // Número máximo de tentativas falhas
$tempoBloqueio = 300;     // Tempo de bloqueio em segundos (5 minutos)
// Helper: obtem IP do cliente (considera proxies simples)
function get_client_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // pode conter uma lista de IPs
        $parts = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($parts[0]);
    }
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

// Arquivo temporário para armazenar bloqueios por IP (simples, seguro o suficiente para esta app)
$blocksFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'codedrill_login_blocks.json';

// Carrega mapa de bloqueios
$blocks = [];
if (file_exists($blocksFile)) {
    $raw = @file_get_contents($blocksFile);
    $parsed = @json_decode($raw, true);
    if (is_array($parsed)) $blocks = $parsed;
}

// Limpa entradas expiradas (por segurança)
$now = time();
foreach ($blocks as $k => $entry) {
    if (!empty($entry['blocked_until']) && $entry['blocked_until'] <= $now) {
        unset($blocks[$k]);
    }
}

// Persist helper
function save_blocks($file, $data) {
    $tmp = $file . '.tmp';
    $fh = fopen($tmp, 'c');
    if ($fh) {
        if (flock($fh, LOCK_EX)) {
            ftruncate($fh, 0);
            fwrite($fh, json_encode($data));
            fflush($fh);
            flock($fh, LOCK_UN);
        }
        fclose($fh);
        rename($tmp, $file);
    }
}

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $msg = rawurlencode('Requisição inválida');
    header("Location: ../public/index.php?modal=login&erro={$msg}");
    exit;
}

// Sanitização dos dados recebidos
$email = trim($_POST['email'] ?? '');
$senha = trim($_POST['senha'] ?? '');

// Identifica cliente
$clientIp = get_client_ip();

// Verifica bloqueio por IP (arquivo)
if (!empty($blocks[$clientIp]['blocked_until']) && $blocks[$clientIp]['blocked_until'] > $now) {
    $restante = $blocks[$clientIp]['blocked_until'] - $now;
    $msg = rawurlencode("Muitas tentativas falhas. Tente novamente em {$restante} segundos.");
    header("Location: ../public/index.php?modal=login&erro={$msg}");
    exit;
}

// Verifica preenchimento
if ($email === '' || $senha === '') {
    $msg = rawurlencode('Preencha todos os campos');
    header("Location: ../public/index.php?modal=login&erro={$msg}");
    exit;
}

// Consulta segura ao banco de dados usando prepared statement
// IMPORTANTE: Adiciona o campo 'avatar' na consulta
$sql = "SELECT id, nome, email, senha, avatar FROM usuarios WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

// Flag de sucesso
$loginOk = false;
if ($resultado && mysqli_num_rows($resultado) === 1) {
    $usuario = mysqli_fetch_assoc($resultado);
    if (password_verify($senha, $usuario['senha'])) {
        $loginOk = true;
    }
}

if ($loginOk) {
    // Login bem-sucedido → limpa tentativas e bloqueio por IP
    unset($_SESSION['tentativas_login']);
    unset($_SESSION['login_bloqueado']);
    if (isset($blocks[$clientIp])) unset($blocks[$clientIp]);
    save_blocks($blocksFile, $blocks);

    // Regenera o ID da sessão por segurança
    session_regenerate_id(true);

    // Armazena dados do usuário na sessão
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    $_SESSION['usuario_email'] = $usuario['email'];
    // ADICIONADO: Salva o avatar na sessão (ou usa o padrão se não houver)
    $_SESSION['usuario_avatar'] = $usuario['avatar'] ?? '/Codedrill/public/assets/images/mascote.png';

    // Redireciona para o dashboard
    header("Location: ../public/inicio.php");
    exit;
} else {
    // Falha: incrementa contador por IP
    $blocks[$clientIp]['attempts'] = ($blocks[$clientIp]['attempts'] ?? 0) + 1;
    $blocks[$clientIp]['last_attempt'] = $now;

    if ($blocks[$clientIp]['attempts'] >= $maxTentativas) {
        $blocks[$clientIp]['blocked_until'] = $now + $tempoBloqueio;
        // reset attempts para evitar overflow
        $blocks[$clientIp]['attempts'] = 0;
        save_blocks($blocksFile, $blocks);
        $msg = rawurlencode("Muitas tentativas falhas. Tente novamente em {$tempoBloqueio} segundos.");
        header("Location: ../public/index.php?modal=login&erro={$msg}");
        exit;
    }

    // grava e informa tentativa restante
    save_blocks($blocksFile, $blocks);
    $remaining = $maxTentativas - $blocks[$clientIp]['attempts'];
    $msg = rawurlencode('E-mail ou senha incorretos');
    header("Location: ../public/index.php?modal=login&erro={$msg}&restantes={$remaining}");
    exit;
}