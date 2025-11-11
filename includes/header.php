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

  <!-- Ícone da aba do navegador -->
  <link rel="icon" type="image/png" href="/Codedrill/public/assets/images/mascote.png">
</head>
<body>
