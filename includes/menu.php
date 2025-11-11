<!-- Importa o arquivo CSS principal do projeto -->
<link rel="stylesheet" href="../public/assets/css/style.css">

<!-- Barra de navegação fixa no topo da página -->
<nav class="navbar navbar-expand-lg fixed-top shadow-sm">
    <div class="container">
        
        <!-- Logotipo da marca com link para a página inicial -->
        <a target="_self" class="navbar-brand" href="/Codedrill/public/index.php">
            <img src="../public/assets/images/mascote.png" alt="CodeDrill Logo" height="30" class="me-2">
        </a>

        <!-- Botão para abrir/fechar o menu em telas pequenas -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu de navegação colapsável -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                
                <!-- Link para a página inicial -->
                <li class="nav-item">
                    <a target="_self" class="nav-link text-white" href="/Codedrill/public/index.php">Home</a>
                </li>

                <!-- Link para a página "Sobre" -->
                <li class="nav-item">
                    <a target="_self" class="nav-link text-white" href="/Codedrill/public/sobre.php">Sobre</a>
                </li>

                <!-- Link que abre o modal de login -->
                <li class="nav-item">
                    <a target="_self" class="nav-link text-white" href="#" 
                       data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                </li>

                <!-- Link que abre o modal de cadastro -->
                <li class="nav-item">
                    <a target="_self" class="nav-link text-white" href="#" 
                       data-bs-toggle="modal" data-bs-target="#cadastroModal">Cadastro</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Inclusão dos modais de login e cadastro -->
<?php require_once __DIR__ . '/../public/login.php'; ?>
<?php require_once __DIR__ . '/../public/cadastro.php'; ?>
