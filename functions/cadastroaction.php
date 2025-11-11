<?php
session_start();

// Conexão com o banco de dados
include_once __DIR__ . '/../config/conexao.php';

// Verifica se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitização e validação básica dos dados recebidos
    $nome   = trim($_POST['nome'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $senha  = $_POST['senha'] ?? '';
    $senha2 = $_POST['senha2'] ?? '';

    // Verifica se todos os campos foram preenchidos
    if (!$nome || !$email || !$senha || !$senha2) {
        $msg = rawurlencode('Preencha todos os campos');
        header("Location: ../public/index.php?modal=cadastro&erro={$msg}");
        exit;
    }

    // Valida o formato do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = rawurlencode('Email inválido');
        header("Location: ../public/index.php?modal=cadastro&erro={$msg}");
        exit;
    }

    // Verifica se as senhas coincidem
    if ($senha !== $senha2) {
        $msg = rawurlencode('As senhas não coincidem');
        header("Location: ../public/index.php?modal=cadastro&erro={$msg}");
        exit;
    }

    // Verifica se a senha tem pelo menos 8 caracteres
    if (strlen($senha) < 8) {
        $msg = rawurlencode('A senha deve ter pelo menos 8 caracteres');
        header("Location: ../public/index.php?modal=cadastro&erro={$msg}");
        exit;
    }

    // Verifica se o e-mail já está cadastrado
    $sqlCheck = "SELECT id FROM usuarios WHERE email = ?";
    $stmtCheck = mysqli_prepare($conn, $sqlCheck);
    mysqli_stmt_bind_param($stmtCheck, "s", $email);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_store_result($stmtCheck);

    if (mysqli_stmt_num_rows($stmtCheck) > 0) {
        $msg = rawurlencode('Email já cadastrado');
        header("Location: ../public/index.php?modal=cadastro&erro={$msg}");
        exit;
    }

    // Criptografa a senha com Argon2id se disponível, senão usa padrão
    if (defined('PASSWORD_ARGON2ID')) {
        $senhaHash = password_hash($senha, PASSWORD_ARGON2ID);
    } else {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    }

    // Insere os dados no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senhaHash);

    if (mysqli_stmt_execute($stmt)) {
        $msg = rawurlencode('Cadastro realizado com sucesso');
        // Redireciona para a página inicial com modal de login e mensagem de sucesso
        header("Location: ../public/index.php?modal=login&sucesso={$msg}");
        exit;
    } else {
        // Registra erro no log interno
        error_log("Erro MySQL: " . mysqli_error($conn));
        $msg = rawurlencode('Erro ao cadastrar. Tente novamente.');
        header("Location: ../public/index.php?modal=cadastro&erro={$msg}");
        exit;
    }

} else {
    // Requisição inválida (não é POST)
    $msg = rawurlencode('Requisição inválida');
    header("Location: ../public/index.php?modal=cadastro&erro={$msg}");
    exit;
}
