<?php

// === Nome da aplicação ===
define('APP_NAME', 'CodeDrill');

// === Detecta ambiente automaticamente (localhost ou produção) ===
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$basePath = ($host === 'localhost') ? '/codedrill/public' : '/public';
define('BASE_URL', "http://{$host}{$basePath}");

// === Configurações do Banco de Dados ===
define('DB_HOST', 'localhost');         // Host do banco
define('DB_NAME', 'codedrill_db');      // Nome do banco
define('DB_USER', 'root');              // Usuário do banco
define('DB_PASS', '');                  // Senha do banco

// === Diretório de Uploads ===
define('UPLOAD_DIR', realpath(dirname(__DIR__) . '/uploads')); // Caminho absoluto
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // Tamanho máximo de upload: 5MB

// === Charset e Timezone ===
date_default_timezone_set('America/Sao_Paulo'); // Define fuso horário
ini_set('default_charset', 'UTF-8');            // Define codificação padrão

// === Inicialização de Sessão com segurança ===
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);               // Protege contra acesso via JavaScript
    ini_set('session.use_strict_mode', 1);               // Evita reutilização de IDs de sessão
    ini_set('session.cookie_secure', isset($_SERVER['HTTPS'])); // Usa cookie seguro se HTTPS estiver ativo
    session_start();                                     // Inicia a sessão
}

// === Configurações locais opcionais (sobrescrevem as padrões) ===
if (file_exists(__DIR__ . '/config.local.php')) {
    require_once __DIR__ . '/config.local.php';
}
?>
