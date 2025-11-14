<?php
include("modulos.php");

// Pega o número do módulo da URL
$modulo = $_GET['modulo'] ?? null;

// Se não tiver módulo selecionado, mostra mensagem
if (!$modulo) {
    echo '<div class="area-conteudo">
            <div class="mensagem-inicial">
                <i class="bi bi-book"></i>
                <h2>Bem-vindo aos Módulos!</h2>
                <p>Selecione um módulo no menu lateral para começar seus estudos. Cada módulo contém uma aula teórica e uma videoaula para facilitar seu aprendizado.</p>
            </div>
          </div>';
    include_once __DIR__ . '/../includes/footer.php';
    exit;
}
?>


<div class="area-conteudo">
    <div class="conteudo-card">
        <!-- Cabeçalho do Módulo -->
        <div class="modulo-header-content">
            <div class="modulo-badge">
                <?= str_pad($modulo, 2, '0', STR_PAD_LEFT) ?>
            </div>
            <div class="modulo-info">
                <h1>Introdução ao PHP</h1>
                <p>
                    <i class="bi bi-file-text-fill"></i>Aula Teórica
                    <span style="margin: 0 1rem; color: rgba(255,255,255,0.3);">|</span>
                    <i class="bi bi-clock-fill"></i>30 min de leitura
                </p>
            </div>
        </div>

        <!-- Conteúdo da Aula -->
        <div class="aula-conteudo">
            <h2>O que você vai aprender</h2>
            <p>
                Nesta aula, você vai conhecer os fundamentos da programação em PHP, 
                uma das linguagens mais utilizadas para desenvolvimento web no mundo. 
                Vamos explorar desde a sintaxe básica até conceitos importantes para 
                você começar a criar suas próprias aplicações.
            </p>

            <h2>Conceitos Fundamentais</h2>
            <p>
                PHP (Hypertext Preprocessor) é uma linguagem de script do lado do servidor 
                amplamente utilizada e especialmente adequada para desenvolvimento web. 
                O código PHP é executado no servidor antes de ser enviado ao navegador.
            </p>

            <h3>Sintaxe Básica</h3>
            <p>Todo código PHP deve estar entre as tags de abertura e fechamento:</p>
            <pre><code>&lt;?php
                // Seu código PHP aqui
                echo "Olá, Mundo!";
                ?&gt;</code></pre>

            <h3>Variáveis em PHP</h3>
            <p>
                Em PHP, as variáveis são declaradas com o símbolo <code>$</code> seguido 
                do nome da variável. Elas não precisam ter seu tipo declarado explicitamente.
            </p>
            <pre><code>&lt;?php
                $nome = "João";
                $idade = 25;
                $altura = 1.75;
                $ativo = true;
                ?&gt;</code></pre>

            <h3>Tipos de Dados</h3>
            <ul>
                <li><strong>String:</strong> Texto entre aspas ("texto" ou 'texto')</li>
                <li><strong>Integer:</strong> Números inteiros (1, 42, -10)</li>
                <li><strong>Float:</strong> Números decimais (3.14, 2.5)</li>
                <li><strong>Boolean:</strong> Verdadeiro ou falso (true, false)</li>
                <li><strong>Array:</strong> Coleção de valores</li>
                <li><strong>Object:</strong> Instância de uma classe</li>
            </ul>

            <h3>Operadores</h3>
            <p>PHP suporta diversos tipos de operadores:</p>
            <ul>
                <li><strong>Aritméticos:</strong> +, -, *, /, %</li>
                <li><strong>Comparação:</strong> ==, ===, !=, !==, &lt;, &gt;, &lt;=, &gt;=</li>
                <li><strong>Lógicos:</strong> && (and), || (or), ! (not)</li>
                <li><strong>Atribuição:</strong> =, +=, -=, *=, /=</li>
            </ul>

            <h2> Exemplo Prático</h2>
            <pre><code>&lt;?php
// Declarando variáveis
$produto = "Notebook";
$preco = 2500.00;
$desconto = 0.10;

// Calculando o preço final
$precoFinal = $preco - ($preco * $desconto);

// Exibindo o resultado
echo "Produto: " . $produto . "&lt;br&gt;";
echo "Preço original: R$ " . $preco . "&lt;br&gt;";
echo "Preço com desconto: R$ " . $precoFinal;
?&gt;</code></pre>

            <h2>Resumo</h2>
            <p>
                Nesta aula você aprendeu os conceitos básicos do PHP, incluindo sintaxe, 
                variáveis, tipos de dados e operadores. Esses são os fundamentos que você 
                usará em todos os seus programas PHP. Na próxima aula, vamos explorar 
                estruturas de controle como if/else e loops!
            </p>
        </div>

        <!-- Navegação entre Aulas -->
        <div class="navegacao-aulas">
            <?php if ($modulo > 1): ?>
                <a href="modulo1_texto.php?modulo=<?= $modulo - 1 ?>" class="btn-navegacao btn-anterior">
                    <i class="bi bi-arrow-left"></i>
                    Aula Anterior
                </a>
            <?php endif; ?>
            
            <a href="modulo1_video.php?modulo=<?= $modulo ?>" class="btn-navegacao btn-video">
                <i class="bi bi-play-circle-fill"></i>
                Ver Videoaula
            </a>
            
            <?php if ($modulo < 20): ?>
                <a href="modulo1_texto.php?modulo=<?= $modulo + 1 ?>" class="btn-navegacao btn-proximo">
                    Próxima Aula
                    <i class="bi bi-arrow-right"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>