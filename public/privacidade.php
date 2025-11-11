<?php 
// Inclui o cabeçalho da página (HTML <head>, estilos, etc.)
require_once __DIR__ . '/../includes/header.php'; 
?>

<!-- Conteúdo principal da Política de Privacidade -->
<div class="text-white">
    <div class="container py-5">
        
        <!-- Breadcrumb de navegação -->
        <div class="row justify-content-center">
            <div class="col-auto">
                <nav aria-label="breadcrumb" class="mb-4 barra text-center card-highlight px-3 py-2">
                    <ol class="breadcrumb bg-transparent p-0 mb-0 justify-content-center">
                        <li class="breadcrumb-item">
                            <a target="_self" href="index.php" class="text-light text-decoration-none">Início</a>
                        </li>
                        <li class="breadcrumb-item active text-white" aria-current="page">
                            Política de Privacidade
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Card com o conteúdo da política -->
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 mx-auto">
                <div class="card shadow-sm mb-4 card-highlight">
                    <div class="card-body text-white">
                        
                        <!-- Título da seção -->
                        <h1 class="h4 mb-3">Política de Privacidade</h1>
                        <p class="text-white-85">
                            Esta Política de Privacidade descreve como coletamos, usamos e protegemos suas informações ao utilizar nosso site.
                        </p>

                        <!-- Seção 1: Informações coletadas -->
                        <h6 class="mt-4">1. Informações Coletadas</h6>
                        <ul class="list-unstyled mb-3 text-white-85">
                            <li class="mb-2">• Nome, e-mail e senha fornecidos no cadastro.</li>
                            <li class="mb-2">• Dados de navegação como IP, navegador e páginas acessadas.</li>
                            <li class="mb-2">• Cookies para melhorar sua experiência.</li>
                        </ul>

                        <!-- Seção 2: Uso das informações -->
                        <h6>2. Uso das Informações</h6>
                        <p class="text-white-85">
                            Utilizamos seus dados para autenticação, personalização de conteúdo e comunicação com você.
                        </p>

                        <!-- Seção 3: Compartilhamento -->
                        <h6>3. Compartilhamento</h6>
                        <p class="text-white-85">
                            Não compartilhamos suas informações com terceiros, exceto quando exigido por lei ou para funcionamento do sistema.
                        </p>

                        <!-- Seção 4: Segurança -->
                        <h6>4. Segurança</h6>
                        <p class="text-white-85">
                            Adotamos medidas técnicas para proteger seus dados contra acesso não autorizado.
                        </p>

                        <!-- Seção 5: Direitos do usuário -->
                        <h6>5. Seus Direitos</h6>
                        <p class="text-white-85">
                            Você pode solicitar acesso, correção ou exclusão dos seus dados a qualquer momento.
                        </p>

                        <!-- Seção 6: Alterações na política -->
                        <h6>6. Alterações</h6>
                        <p class="text-white-85">
                            Esta política pode ser atualizada. Recomendamos que você a revise periodicamente.
                        </p>

                        <!-- Contato -->
                        <p class="mt-3 text-white-85">
                            Em caso de dúvidas, entre em contato pelo e-mail: 
                            <strong class="text-white">contato@codedrill.com.br</strong>
                        </p>

                        <!-- Botão para voltar à página inicial -->
                        <div class="text-center mt-3">
                            <a target="_self" href="index.php" class="btn-privacy btn-primary text-decoration-none text-white">
                                Voltar ao Início
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
// Inclui o rodapé da página (scripts, fechamento de tags, etc.)
require_once __DIR__ . '/../includes/footer.php'; 
?>
