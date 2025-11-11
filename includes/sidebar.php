<!-- Sidebar container -->
<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php
// Pega nome/avatar da sessão; tenta buscar no DB se necessário
$usuario_nome = $_SESSION['usuario_nome'] ?? null;
$usuario_avatar = $_SESSION['usuario_avatar'] ?? '/Codedrill/public/assets/images/mascote.png';

if (!empty($_SESSION['usuario_id']) && empty($_SESSION['usuario_avatar'])) {
  $usuario_id = (int) $_SESSION['usuario_id'];
  $conPath = __DIR__ . '/../config/conexao.php';
  if (file_exists($conPath)) {
    include_once $conPath;
    $colCheck = mysqli_query($conn, "SHOW COLUMNS FROM usuarios LIKE 'avatar'");
    if ($colCheck && mysqli_num_rows($colCheck) > 0) {
      $stmt = mysqli_prepare($conn, "SELECT avatar FROM usuarios WHERE id = ? LIMIT 1");
      if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $usuario_id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if ($res && mysqli_num_rows($res) === 1) {
          $row = mysqli_fetch_assoc($res);
          if (!empty($row['avatar'])) {
            $usuario_avatar = $row['avatar'];
            $_SESSION['usuario_avatar'] = $usuario_avatar;
          }
        }
      }
    }
  }
}
?>

<div class="d-flex flex-column flex-shrink-0 p-3 vh-100 position-fixed sidebar">
  <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto sidebar-top">
    <a href="/Codedrill/public/inicio.php" class="d-flex align-items-center text-white text-decoration-none sidebar-brand">
      <img src="/Codedrill/public/assets/images/mascote.png" alt="logo" width="40" height="40" class="me-2 rounded brand-logo"> 
      <span class="fs-4 brand-text">CodeDrill</span>
    </a>
    <button id="sidebarToggle" class="btn btn-sm btn-outline-light ms-2 text-white" type="button" aria-label="Minimizar sidebar" aria-pressed="false" role="button" tabindex="0">
      <i class="bi bi-chevron-left" aria-hidden="true"></i>
    </button>
  </div>
  <hr>

  <!-- Menu principal -->
  <ul class="nav nav-pills flex-column mb-auto">
    <li>
      <a href="/Codedrill/public/inicio.php" class="nav-link text-white sidebar-link">
        <i class="bi bi-house-door-fill"></i>
        <span class="ms-2 link-text">Início</span>
      </a>
    </li>
    <li>
      <a href="/Codedrill/public/modulos.php" class="nav-link text-white sidebar-link">
        <i class="bi-stack"></i>
        <span class="ms-2 link-text">Módulos</span>
      </a>
    </li>
    <li>
      <a href="/Codedrill/public/progresso.php" class="nav-link text-white sidebar-link">
        <i class="bi bi-bar-chart-line-fill"></i>
        <span class="ms-2 link-text">Progresso</span>
      </a>
    </li>
    <li>
      <a href="/Codedrill/public/compilador.php" class="nav-link text-white sidebar-link">
        <i class="bi-code-slash"></i>
        <span class="ms-2 link-text">Ambiente</span>
      </a>
    </li>
    <li>
      <a href="/Codedrill/public/configuracoes.php" class="nav-link text-white sidebar-link">
        <i class="bi bi-gear-fill"></i>
        <span class="ms-2 link-text">Configurações</span>
      </a>
    </li>
  </ul>

  <hr>

  <!-- Perfil fixado na parte inferior -->
  <div class="dropdown mt-auto">
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="<?= htmlspecialchars($usuario_avatar) ?>" alt="perfil" width="32" height="32" class="rounded-circle me-2 profile-img">
      <strong class="profile-name"><?= htmlspecialchars($usuario_nome ?? 'Meu Perfil') ?></strong>
    </a>
    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser">
      <li><a class="dropdown-item" href="/Codedrill/public/perfil.php">Perfil</a></li>
      <li><a class="dropdown-item" href="/Codedrill/functions/logout.php">Sair</a></li>
    </ul>
  </div>
</div>
