<?php 
// Inclui o cabeçalho da página (HTML <head>, estilos, etc.)
// O header.php já inicia a sessão automaticamente
require_once __DIR__ . '/../includes/header.php'; 

// Debug temporário - REMOVA depois de funcionar
error_log("=== DEBUG INDEX ===");
error_log("Session ID: " . session_id());
error_log("usuario_id: " . ($_SESSION['usuario_id'] ?? 'NÃO DEFINIDO'));

// Verifica se o usuário está logado
$usuario_logado = isset($_SESSION['usuario_id']) && !empty($_SESSION['usuario_id']);
$usuario_nome = $_SESSION['usuario_nome'] ?? '';
?>

<?php 
// Inclui o menu de navegação do site
require_once __DIR__ . '/../includes/menu.php'; 
?>

<main class="d-flex flex-column justify-content-center align-items-center min-vh-100 text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="d-flex flex-column justify-content-center align-items-center py-5 main-content">
                    
                    <!-- Título principal do site -->
                    <h1 class="text-white mb-4 main-title">CodeDrill</h1>
                    
                    <!-- Subtítulo com mensagem motivacional -->
                    <p class="text-white mb-4 main-subtitle">
                        O conhecimento dos bons<br>
                        deve ser usado para<br>
                        benefício de todos
                    </p>
                    
                    <?php if ($usuario_logado): ?>
                        
                        <a href="/Codedrill/public/inicio.php" class="btn-main btn-primary btn-lg text-white">
                            Começar
                        </a>
                    <?php else: ?>
                        <!-- Botão que abre o modal de cadastro para usuário deslogado -->
                        <button type="button" class="btn-main btn-primary btn-lg text-white"
                                data-bs-toggle="modal" data-bs-target="#cadastroModal">
                            Começar
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Elementos decorativos circulares -->
<div>
    <div class="circle"></div>
</div>
<div class="bg-circle"></div>

<!-- Imagem ilustrativa central -->
<div class="img-fluid">
    <img src="../public/assets/images/mc.png" alt="Ilustração" class="img-fluid">
</div>

<?php 
// Inclui o rodapé da página (scripts, fechamento de tags, etc.)
require_once __DIR__ . '/../includes/footer.php'; 
?>