<!-- Modal de Cadastro -->
<div class="modal fade" id="cadastroModal" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <!-- Modal grande e centralizado verticalmente -->

        <div class="modal-content" style="background: transparent; border: none;">
            <!-- Remove fundo e borda para aplicar estilo personalizado -->

            <div class="card-custom row g-0">
                <!-- Layout em grid com espaçamento zero entre colunas -->

                <div class="col-md-5 card-left">
                    <!-- Coluna esquerda (pode conter imagem ou estilo decorativo) -->
                </div>

                <div class="col-md-7 p-4">
                    <!-- Coluna direita com o formulário de cadastro -->

                    <!-- Formulário que envia dados para o script de cadastro -->
                    <form action="../functions/cadastroaction.php" method="POST">

                        <!-- Campo Nome -->
                        <div class="mb-3 position-relative">
                            <label for="username" class="form-label text-white">Nome:</label>
                            <i class="bi bi-person-fill input-icon"></i>
                            <input type="name" name="nome" id="username" class="form-control rounded-pill ps-5" placeholder="Nome" required>
                        </div>

                        <!-- Campo Email -->
                        <div class="mb-3 position-relative">
                            <label for="email" class="form-label text-white">Email:</label>
                            <i class="bi bi-envelope-fill input-icon"></i>
                            <input type="email" name="email" id="email" class="form-control rounded-pill ps-5" placeholder="Email" required>
                        </div>

                        <!-- Campo Senha -->
                        <div class="mb-3 position-relative">
                            <label for="senha1" class="form-label text-white">Senha:</label>
                            <i class="bi bi-lock-fill input-icon-lock"></i>
                            <input type="password" name="senha" id="senhaCadastro" autocomplete="new-password" class="form-control rounded-pill ps-5" placeholder="Senha" required>
                            <i class="bi bi-eye-slash-fill input-icon-eye" data-target="senhaCadastro"></i>
                        </div>

                        <!-- Campo Repetir Senha -->
                        <div class="mb-3 position-relative">
                            <label for="senha2" class="form-label text-white">Repita sua senha:</label>
                            <i class="bi bi-lock-fill input-icon-lock"></i>
                            <input type="password" name="senha2" id="senhaCadastro2" autocomplete="new-password" class="form-control rounded-pill ps-5" placeholder="Senha" required>
                            <i class="bi bi-eye-slash-fill input-icon-eye" data-target="senhaCadastro2"></i>
                        </div>

                        <!-- Aceite dos Termos -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="termos" required>
                            <label class="form-check-label text-white" for="termos">
                                Li e Concordo com as 
                                <a target="_self" href="../public/privacidade.php" class="link-warning">Políticas de Privacidade</a>
                            </label>
                        </div>

                        <!-- Botão de envio do formulário -->
                        <div class="d-grid">
                            <button type="submit" class="btn-primary btn-custom text-white">Cadastrar-se</button>
                        </div>

                        <!-- Link para abrir o modal de login -->
                        <div class="text-center mt-3">
                            <label class="text-white form-label">
                                Já tem uma conta? 
                                <a target="_self" href="#" class="link-warning" data-bs-toggle="modal" data-bs-target="#loginModal">Faça login</a>
                            </label>
                        </div>

                    </form>

                    <script>
                    // Bloqueia copy/cut do campo senha e impede paste no campo repetir senha
                    (function(){
                        const senha = document.getElementById('senhaCadastro');
                        const senha2 = document.getElementById('senhaCadastro2');
                        if (senha) {
                            senha.addEventListener('copy', e => e.preventDefault());
                            senha.addEventListener('cut', e => e.preventDefault());
                        }
                        if (senha2) {
                            senha2.addEventListener('paste', e => {
                                // evita colar conteúdo — aviso visual opcional
                                e.preventDefault();
                                // opcional: mostrar breve aviso ao usuário
                                senha2.classList.add('border','border-warning');
                                setTimeout(()=> senha2.classList.remove('border','border-warning'), 1200);
                            });
                        }
                    })();
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
