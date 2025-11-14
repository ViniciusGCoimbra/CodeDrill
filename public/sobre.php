<?php
// Inclui o cabeçalho da página (HTML <head>, estilos, etc.)
require_once __DIR__ . '/../includes/header.php'; 

// Inclui o menu de navegação do site
require_once __DIR__ . '/../includes/menu.php';
?>

<!-- Container principal com espaçamento vertical -->
<div class="container py-5">

    <!-- Elemento decorativo semicircular -->
    <div class="semicirculo"></div>
</div>

<!-- Segundo container com conteúdo da página "Sobre" -->
<div class="container py-5">

    <!-- Seção de introdução com título e frase -->
    <div class="box text-center mb-5">
        <div class="titulo">
            <h1>Sobre o CodeDrill</h1>
            <div class="frase">
                <h2>"A árvore não prova a doçura dos próprios frutos. O conhecimento dos bons deve ser usado para benefício de todos."</h2>
            </div>
        </div>
    </div>

    <!-- Seção: A Logo -->
    <div class="row align-items-center descricoes mb-5 flex-md-row-reverse">
        <!-- Imagem da logo -->
        <div class="col-md-6 text-center">
            <div class="imglogo" style="background-image:url('../public/assets/images/mascotepb.png');"></div>
        </div>

        <!-- Texto explicativo sobre a logo -->
        <div class="col-md-6">
            <div class="titulosbody">
                <h1>A Logo</h1>
                <p class="subtituloesquerda">
                    A logo do CodeDrill foi criada para representar dinamismo e modernidade,
                    transmitindo a ideia de avanço contínuo no aprendizado de programação.
                </p>
            </div>
        </div>
    </div>

    <!-- Seção: O Nome -->
    <div class="row align-items-center descricoes mb-5">
        <!-- Imagem do nome -->
        <div class="col-md-6 text-center">
            <div class="imgnome" style="background-image:url('../public/assets/images/nome.png');"></div>
        </div>

        <!-- Texto explicativo sobre o nome -->
        <div class="col-md-6">
            <div class="titulosbody">
                <h1>O Nome</h1>
                <p class="subtitulodireita">
                    "CodeDrill" significa treinar código constantemente,
                    reforçando o conceito de prática diária como base para dominar a lógica.
                </p>
            </div>
        </div>
    </div>

    <!-- Seção: O Significado -->
    <div class="row align-items-center descricoes mb-5 flex-md-row-reverse">
        <!-- Imagem do significado -->
        <div class="col-md-6 text-center">
            <div class="imgsignificado" style="background-image:url('../public/assets/images/significado.png');"></div>
        </div>

        <!-- Texto explicativo sobre o propósito do projeto -->
        <div class="col-md-6">
            <div class="titulosbody">
                <h1>O Significado</h1>
                <p class="subtituloesquerda">
                    O projeto busca proporcionar um ambiente inclusivo, moderno e eficiente,
                    com foco no ensino de programação para iniciantes e jovens estudantes.
                </p>
            </div>
        </div>
    </div>

<?php 
// Inclui o rodapé da página (scripts, fechamento de tags, etc.)
require_once __DIR__ . '/../includes/footer.php'; 
?>