    document.addEventListener('DOMContentLoaded', function() {
        // Seleciona todos os ícones de olho na página
        const toggleIcons = document.querySelectorAll('.input-icon-eye');

        toggleIcons.forEach(icon => {
            icon.addEventListener('click', function () {
                // Pega o ID do input alvo do atributo 'data-target'
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);

                if (passwordInput) {
                    // 1. Alterna o tipo de input
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // 2. Alterna o ícone (olho cortado <-> olho aberto)
                    this.classList.toggle('bi-eye-slash-fill');
                    this.classList.toggle('bi-eye-fill');
                }
            });
        });
    });
