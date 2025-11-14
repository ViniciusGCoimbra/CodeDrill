<?php
// A sessão já foi iniciada no header.php

// Debug temporário - REMOVA depois de funcionar
error_log("=== DEBUG MENU ===");
error_log("Session ID: " . session_id());
error_log("usuario_id: " . ($_SESSION['usuario_id'] ?? 'NÃO DEFINIDO'));
error_log("Session completa: " . print_r($_SESSION, true));

// Verifica se o usuário está logado
$usuario_logado = isset($_SESSION['usuario_id']) && !empty($_SESSION['usuario_id']);
$usuario_nome = $_SESSION['usuario_nome'] ?? 'Usuário';
$usuario_avatar = $_SESSION['usuario_avatar'] ?? '/Codedrill/public/assets/images/mascote.png';

// Debug temporário - REMOVA depois de funcionar
error_log("Usuario logado? " . ($usuario_logado ? 'SIM' : 'NÃO'));
?>

<!-- Importa o arquivo CSS principal do projeto -->
<link rel="stylesheet" href="../public/assets/css/modulos.css">

<!-- Barra de navegação fixa no topo da página -->
<nav class="navbar navbar-expand-lg fixed-top shadow-sm">
    <div class="container">
        
        <!-- Logotipo da marca com link para a página inicial -->      
        <a target="_self" class="navbar-brand d-flex align-items-center text-white text-decoration-none" href="/Codedrill/public/index.php">
            <img src="../public/assets/images/mascote.png" alt="CodeDrill Logo" height="50" class="me-2">
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
                <!-- Links sincronizados com o sidebar (azul escuro) -->
                <li class="nav-item">
                    <a target="_self" class="nav-link text-white" href="/Codedrill/public/inicio.php">Início</a>
                </li>
                <li class="nav-item">
                    <a target="_self" class="nav-link text-white" href="/Codedrill/public/modulos.php">Módulos</a>
                </li>
                <li class="nav-item">
                    <a target="_self" class="nav-link text-white" href="/Codedrill/public/progresso.php">Progresso</a>
                </li>
                <li class="nav-item">
                    <a target="_self" class="nav-link text-white" href="/Codedrill/public/compilador.php">Ambiente</a>
                </li>

                <?php if ($usuario_logado): ?>
                    <!-- Menu para usuário LOGADO -->
                    
                    <!-- Dropdown do perfil do usuário -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center" 
                           href="#" 
                           id="perfilDropdown" 
                           role="button" 
                           data-bs-toggle="dropdown" 
                           aria-expanded="false">
                            <img src="<?= htmlspecialchars($usuario_avatar) ?>" 
                                 alt="Avatar" 
                                 class="rounded-circle me-2" 
                                 width="30" 
                                 height="30"
                                 style="object-fit: cover; border: 2px solid rgba(255,255,255,0.3);">
                            <span><?= htmlspecialchars($usuario_nome) ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-custom" aria-labelledby="perfilDropdown">
                            <li>
                                <a class="dropdown-item" href="/Codedrill/public/perfil.php">
                                    <i class="bi bi-person-circle me-2"></i>Meu Perfil
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="/Codedrill/functions/logout.php">
                                    <i class="bi bi-box-arrow-right me-2"></i>Sair
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php else: ?>
                    <!-- Menu para usuário DESLOGADO -->
                    
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

                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<?php if (!$usuario_logado): ?>
    <!-- Inclusão dos modais de login e cadastro apenas se usuário não estiver logado -->
    <?php require_once __DIR__ . '/../public/login.php'; ?>
    <?php require_once __DIR__ . '/../public/cadastro.php'; ?>
<?php endif; ?>

<!-- CSS adicional para estilizar o dropdown do perfil -->
<style>
/* Estilo do dropdown menu */
.dropdown-custom {
    background-color: rgba(26, 26, 46, 0.95);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    margin-top: 0.5rem;
}

.dropdown-custom .dropdown-item {
    color: #ffffff;
    padding: 0.6rem 1.2rem;
    transition: all 0.3s ease;
}

.dropdown-custom .dropdown-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: #ffffff;
}

.dropdown-custom .dropdown-item.text-danger:hover {
    background-color: rgba(220, 53, 69, 0.2);
    color: #ff6b6b;
}

.dropdown-custom .dropdown-divider {
    border-color: rgba(255, 255, 255, 0.1);
}

/* Ajuste do ícone do dropdown */
.nav-link.dropdown-toggle::after {
    margin-left: 0.5rem;
}

/* Estilo responsivo para mobile */
@media (max-width: 991px) {
    .nav-link.dropdown-toggle {
        justify-content: flex-start;
    }
}
</style>

<!-- JS: inicializa dropdown do perfil; fallback se bootstrap não estiver carregado -->
<script>
document.addEventListener('DOMContentLoaded', function(){
    var toggle = document.getElementById('perfilDropdown');
    if (!toggle) return;
    var menu = document.querySelector('[aria-labelledby="perfilDropdown"]');

    // Se bootstrap estiver disponível, usa a API dele
    if (typeof bootstrap !== 'undefined' && bootstrap.Dropdown) {
        try {
            // Inicializa caso ainda não tenha sido inicializado
            new bootstrap.Dropdown(toggle);
        } catch (e) {
            // não bloqueia se falhar
            console.warn('Bootstrap dropdown init failed:', e);
        }
        return;
    }

    // Fallback simples: alterna classe .show no menu
    function toggleMenu(e){
        e.preventDefault();
        if (!menu) return;
        var isShown = menu.classList.contains('show');
        if (isShown) {
            menu.classList.remove('show');
            toggle.setAttribute('aria-expanded','false');
        } else {
            menu.classList.add('show');
            toggle.setAttribute('aria-expanded','true');
        }
    }

    toggle.addEventListener('click', toggleMenu);

    // Fecha quando clicar fora
    document.addEventListener('click', function(ev){
        if (!menu) return;
        if (menu.classList.contains('show')){
            if (!toggle.contains(ev.target) && !menu.contains(ev.target)){
                menu.classList.remove('show');
                toggle.setAttribute('aria-expanded','false');
            }
        }
    });
});
</script>
