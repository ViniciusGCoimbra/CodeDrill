<?php
// Importa as constantes de configuração do banco de dados
require_once __DIR__ . '/config.php';

// Cria a conexão com o banco de dados usando os dados do config.php
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
    // Retorna erro HTTP 500 para chamadas via API (por exemplo, AJAX)
    http_response_code(500);

    // Interrompe a execução e exibe mensagem de erro
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Define o charset da conexão para UTF-8 com suporte a emojis e acentos
mysqli_set_charset($conn, 'utf8mb4');
?>
