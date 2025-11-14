<?php
include("modulos.php");

// Pega o número do módulo da URL
$modulo = $_GET['modulo'] ?? 1;

// Caminho do vídeo (você pode personalizar para cada módulo)
$caminho_do_video = "Teste.mp4";
?>

<div class="area-conteudo ">
    <div class="conteudo-card">
        <!-- Cabeçalho do Módulo -->
        <div class="modulo-header-content">
            <div class="modulo-badge">
                <?= str_pad($modulo, 2, '0', STR_PAD_LEFT) ?>
            </div>
            <div class="modulo-info">
                <h1>Introdução ao PHP</h1>
                <p>
                    <i class="bi bi-play-circle-fill"></i>Videoaula
                    <span style="margin: 0 1rem; color: rgba(255,255,255,0.3);">|</span>
                    <i class="bi bi-clock-fill"></i>25 minutos
                </p>
            </div>
        </div>

        <!-- Player de Vídeo -->
        <div class="video-container">
            <video controls controlsList="nodownload">
                <source src="<?= htmlspecialchars($caminho_do_video) ?>" type="video/mp4">
                Seu navegador não suporta a reprodução de vídeos HTML5.
            </video>
        </div>

        <!-- Descrição do Vídeo -->
        <div class="video-descricao">
            <h3> Sobre esta videoaula</h3>
            <p>
                Nesta videoaula, vamos explorar os fundamentos do PHP de forma prática e visual. 
                Você verá exemplos reais de código, aprenderá as melhores práticas e 
                entenderá como aplicar os conceitos no desenvolvimento de aplicações web. 
                Acompanhe atentamente e não hesite em pausar o vídeo para experimentar o código!
            </p>
        </div>

        <!-- Recursos da Aula -->
        <div class="recursos-aula">
            <div class="recurso-item duracao">
                <i class="bi bi-clock-history"></i>
                <h4>Duração</h4>
                <p>25 minutos de conteúdo focado</p>
            </div>
            <div class="recurso-item nivel">
                <i class="bi bi-bar-chart-fill"></i>
                <h4>Nível</h4>
                <p>Iniciante a Intermediário</p>
            </div>
            <div class="recurso-item pratica">
                <i class="bi bi-code-slash"></i>
                <h4>Prática</h4>
                <p>Exemplos de código inclusos</p>
            </div>
        </div>

        <!-- Navegação entre Aulas -->
        <div class="navegacao-aulas">
            <?php if ($modulo > 1): ?>
                <a href="modulo1_video.php?modulo=<?= $modulo - 1 ?>" class="btn-navegacao btn-anterior">
                    <i class="bi bi-arrow-left"></i>
                    Vídeo Anterior
                </a>
            <?php endif; ?>
            
            <a href="modulo1_texto.php?modulo=<?= $modulo ?>" class="btn-navegacao btn-texto">
                <i class="bi bi-file-text-fill"></i>
                Ver Aula Teórica
            </a>
            
            <?php if ($modulo < 20): ?>
                <a href="modulo1_video.php?modulo=<?= $modulo + 1 ?>" class="btn-navegacao btn-proximo">
                    Próximo Vídeo
                    <i class="bi bi-arrow-right"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>