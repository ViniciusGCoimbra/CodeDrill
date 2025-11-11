<?php 
// Inclui o cabeçalho da página (HTML <head>, estilos, etc.)
require_once __DIR__ . '/../includes/header.php'; 
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
                    
                    <!-- Botão que abre o modal de cadastro -->
                    <button type="button" class="btn-main btn-primary btn-lg text-white"
                            data-bs-toggle="modal" data-bs-target="#cadastroModal">
                        Começar
                    </button>
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
// Inclui o modal de login
require_once __DIR__ . '/login.php'; 

// Inclui o modal de cadastro
require_once __DIR__ . '/cadastro.php'; 
?>

<!-- Comentário explicando que os modais e toasts são ativados após os scripts do footer -->

<?php 
// Inclui o rodapé da página (scripts, fechamento de tags, etc.)
require_once __DIR__ . '/../includes/footer.php'; 
?>
