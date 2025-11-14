<?php
// ===== IMPORTANTE: Inicia a sessão ANTES de qualquer saída HTML =====
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Debug temporário - REMOVA depois de funcionar
error_log("=== DEBUG HEADER ===");
error_log("Session iniciada - ID: " . session_id());
error_log("usuario_id na sessão: " . ($_SESSION['usuario_id'] ?? 'NÃO DEFINIDO'));
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- Configurações básicas do documento -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CodeDrill</title>

  <?php
  // Caminho base para os arquivos CSS públicos
  $cssBaseWeb = '/Codedrill/public/assets/css';

  // Diretório raiz do servidor, sem a barra final
  $docRoot = rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR);

  // Função que gera o href do CSS com versão baseada na data de modificação do arquivo
  function css_href($baseWeb, $file) {
      $web = "{$baseWeb}/{$file}"; // Caminho web
      $fs = $GLOBALS['docRoot'] . $web; // Caminho físico no servidor
      return $web . '?v=' . (file_exists($fs) ? filemtime($fs) : time()); // Adiciona versão
  }
  ?>

  <!-- Estilos principais com controle de cache via versão -->
  <link rel="stylesheet" href="<?= css_href($cssBaseWeb, 'bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= css_href($cssBaseWeb, 'bootstrap-icons.css') ?>">
  <link rel="stylesheet" href="<?= css_href($cssBaseWeb, 'style.css') ?>">
  <link rel="stylesheet" href="<?= css_href($cssBaseWeb, 'custom.css') ?>">
  <link rel="stylesheet" href="<?= css_href($cssBaseWeb, 'semi.css') ?>">
  <link rel="stylesheet" href="<?= css_href($cssBaseWeb, 'sobri.css') ?>">
  <link rel="stylesheet" href="<?= css_href($cssBaseWeb, 'modulo.css') ?>">
  <link rel="stylesheet" href="<?= css_href($cssBaseWeb, 'modulos.scss') ?>">

  <!-- Ícone da aba do navegador -->
  <link rel="icon" type="image/png" href="/Codedrill/public/assets/images/mascote.png">
</head>
<body>