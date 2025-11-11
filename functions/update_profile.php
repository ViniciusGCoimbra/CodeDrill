<?php
session_start();

// Verifica usuário logado
if (empty($_SESSION['usuario_id'])) {
    $msg = rawurlencode('Acesso negado');
    header("Location: ../public/index.php?erro={$msg}");
    exit;
}

// Conexão com o banco
include_once __DIR__ . '/../config/conexao.php';

$usuario_id = (int) $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $msg = rawurlencode('Requisição inválida');
    header("Location: ../public/perfil.php?erro={$msg}");
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$avatar_choice = trim($_POST['avatar_choice'] ?? '');

// valida nome
if ($nome === '') {
    $msg = rawurlencode('O nome não pode ficar vazio');
    header("Location: ../public/perfil.php?erro={$msg}");
    exit;
}

$novo_avatar = null;

// 1) se o usuário escolheu um avatar padrão
if ($avatar_choice) {
    // sanitize: permitir apenas caminhos dentro de assets/images/avatars
    $allowedPrefix = '/Codedrill/public/assets/images/avatars/';
    if (strpos($avatar_choice, $allowedPrefix) === 0) {
        $novo_avatar = $avatar_choice;
    }
}

// 2) se houver upload de arquivo, processar upload (tem prioridade)
if (isset($_FILES['avatar_file']) && $_FILES['avatar_file']['error'] === UPLOAD_ERR_OK) {
    $fileTmp = $_FILES['avatar_file']['tmp_name'];
    $fileName = basename($_FILES['avatar_file']['name']);
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed = ['png','jpg','jpeg','gif','svg'];

    if (!in_array($ext, $allowed)) {
        $msg = rawurlencode('Tipo de arquivo não permitido');
        header("Location: ../public/perfil.php?erro={$msg}");
        exit;
    }

    // Gera nome único e move para uploads
    $safeName = preg_replace('/[^a-z0-9._-]/i', '_', pathinfo($fileName, PATHINFO_FILENAME));
    $newFileName = $safeName . '_' . time() . '.' . $ext;
    $destDir = __DIR__ . '/../public/uploads/avatars/';
    if (!is_dir($destDir)) mkdir($destDir, 0755, true);
    $destPath = $destDir . $newFileName;

    if (move_uploaded_file($fileTmp, $destPath)) {
        // Salva caminho relativo para uso no front-end
        $novo_avatar = '/Codedrill/public/uploads/avatars/' . $newFileName;
    } else {
        $msg = rawurlencode('Falha ao mover arquivo');
        header("Location: ../public/perfil.php?erro={$msg}");
        exit;
    }
}

// Atualiza o nome e possivelmente avatar
if ($novo_avatar !== null) {
    $sql = "UPDATE usuarios SET nome = ?, avatar = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssi', $nome, $novo_avatar, $usuario_id);
} else {
    $sql = "UPDATE usuarios SET nome = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $nome, $usuario_id);
}

if (!$stmt) {
    error_log('Erro MySQL prepare: ' . mysqli_error($conn));
    $msg = rawurlencode('Erro ao preparar atualização');
    header("Location: ../public/perfil.php?erro={$msg}");
    exit;
}

if (mysqli_stmt_execute($stmt)) {
    // atualiza sessão
    $_SESSION['usuario_nome'] = $nome;
    if ($novo_avatar !== null) $_SESSION['usuario_avatar'] = $novo_avatar;

    $msg = rawurlencode('Perfil atualizado com sucesso');
    header("Location: ../public/perfil.php?sucesso={$msg}");
    exit;
} else {
    error_log('Erro MySQL execute: ' . mysqli_error($conn));
    $msg = rawurlencode('Erro ao atualizar perfil');
    header("Location: ../public/perfil.php?erro={$msg}");
    exit;
}

?>