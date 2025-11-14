<?php
// Cabeçalho e menu
include_once __DIR__ . '/../includes/header.php';
include_once __DIR__ . '/../includes/menumodulos.php';

// Define o módulo atual (pode vir da URL)
$modulo_atual = $_GET['modulo'] ?? null;
$tipo_aula = $_GET['tipo'] ?? null; // 'texto' ou 'video'
?>

<!-- Botão Toggle para Mobile -->
<button class="toggle-sidebar" onclick="toggleSidebar()">
    <i class="bi bi-list" style="font-size: 1.5rem;"></i>
</button>

<!-- Layout Principal -->
<div class="modulos-layout">
    <!-- Sidebar de Módulos -->
    <aside class="sidebar-modulos" id="sidebarModulos">
        <!-- Botões de Navegação -->
        <div class="nav-buttons">
            <a href="/Codedrill/public/inicio.php" class="btn">
                <i class="bi bi-house-fill"></i>INÍCIO
            </a>
            <a href="/Codedrill/public/pratica.php" class="btn">
                <i class="bi bi-code-slash"></i>PRATICAR
            </a>
        </div>

        <!-- Lista de Módulos -->
        <ul class="modulos-list">
            <?php for ($i = 1; $i <= 20; $i++): ?>
            <li class="modulo-item">
                <div class="modulo-header" onclick="toggleModulo(<?= $i ?>)">
                    <div>
                        <span class="modulo-numero"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></span>
                        <span>Introdução ao PHP</span>
                    </div>
                    <i class="bi bi-chevron-down modulo-icone"></i>
                </div>
                <ul class="submenu" id="submenu-<?= $i ?>">
                    <li>
                        <a href="modulo1_texto.php?modulo=<?= $i ?>&tipo=texto">
                            <i class="bi bi-file-text-fill"></i>
                            Aula <?= $i ?>
                        </a>
                    </li>
                    <li>
                        <a href="modulo1_video.php?modulo=<?= $i ?>&tipo=video">
                            <i class="bi bi-play-circle-fill"></i>
                            Videoaula <?= $i ?>
                        </a>
                    </li>
                </ul>
            </li>
            <?php endfor; ?>
        </ul>
    </aside>
</div>

<script>
// Toggle de módulos
function toggleModulo(numero) {
    const submenu = document.getElementById(`submenu-${numero}`);
    const header = submenu.previousElementSibling;
    
    // Fecha outros submenus (opcional - comente se quiser múltiplos abertos)
    /*
    document.querySelectorAll('.submenu').forEach(sub => {
        if (sub !== submenu) {
            sub.classList.remove('aberto');
            sub.previousElementSibling.classList.remove('ativo');
        }
    });
    */
    
    submenu.classList.toggle('aberto');
    header.classList.toggle('ativo');
}

// Toggle sidebar mobile
function toggleSidebar() {
    document.getElementById('sidebarModulos').classList.toggle('show');
}

// Fecha sidebar ao clicar fora (mobile)
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebarModulos');
    const toggleBtn = document.querySelector('.toggle-sidebar');
    
    if (window.innerWidth <= 991 && 
        !sidebar.contains(event.target) && 
        !toggleBtn.contains(event.target)) {
        sidebar.classList.remove('show');
    }
});
</script>