<?php
// Sessão e logout seguro
session_start();

// Limpa variáveis de sessão
$_SESSION = array();

// Remove cookie de sessão se existir
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'], $params['secure'], $params['httponly']
    );
}

// Destroi a sessão
session_destroy();

// Redireciona para a página inicial com mensagem de sucesso
$msg = rawurlencode('Desconectado com sucesso');
// redirect using absolute path relative to project root
header("Location: /Codedrill/public/index.php?sucesso={$msg}");
exit;
