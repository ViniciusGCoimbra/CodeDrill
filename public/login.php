<!-- Modal de Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> 
        <!-- Define o tamanho grande e centraliza verticalmente o modal -->

        <div class="modal-content" style="background: transparent; border: none;"> 
            <!-- Remove fundo e borda do conteúdo do modal -->

            <div class="card-custom row g-0">
                <!-- Layout em grid com espaçamento zero entre colunas -->

                <div class="col-md-5 card-left">
                    <!-- Coluna esquerda do card (pode conter imagem ou estilo decorativo) -->
                </div>

                <div class="col-md-7 p-4">
                    <!-- Coluna direita com o formulário de login -->

                    <form action="../functions/loginaction.php" method="POST">
                        <!-- Formulário que envia dados para o script de login -->

                        <div class="mb-3 position-relative">
                            <!-- Campo de email com ícone -->
                            <label for="email" class="form-label text-white">Email:</label>
                            <i class="bi bi-envelope-fill input-icon"></i>
                            <input type="email" name="email" id="email" class="form-control rounded-pill ps-5" placeholder="Email" required>
                        </div>

                        <div class="mb-3 position-relative">
                            <!-- Campo de senha com ícone de cadeado e ícone de visualização -->
                            <label for="senhaLogin" class="form-label text-white">Senha:</label>
                            <i class="bi bi-lock-fill input-icon-lock"></i>
                            <input type="password" name="senha" id="senhaLogin" class="form-control rounded-pill ps-5" placeholder="Senha" required>
                            <i class="bi bi-eye-slash-fill input-icon-eye" data-target="senhaLogin"></i>
                        </div>

                        <div class="d-grid">
                            <!-- Botão de envio do formulário -->
                            <button type="submit" class="text-white btn-primary btn-custom">Entrar</button>
                        </div>

                        <div class="text-center mt-3">
                            <!-- Link para abrir o modal de cadastro -->
                            <label class="text-white form-label">
                                Não tem uma conta? 
                                <a target="_self" href="../public/index.php" data-bs-toggle="modal" data-bs-target="#cadastroModal" class="link-warning">
                                    Registre-se
                                </a>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
