// Abre modal de Login
function showLoginModalWhenReady() {
    let attempts = 0;
    function tryShow() {
        const el = document.getElementById('loginModal');
        if (el && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            new bootstrap.Modal(el).show();
            return;
        }
        if (++attempts < 50) setTimeout(tryShow, 100);
    }
    document.readyState === 'loading'
        ? document.addEventListener('DOMContentLoaded', tryShow)
        : tryShow();
}

// Abre modal de Cadastro
function showCadastroModalWhenReady() {
    let attempts = 0;
    function tryShow() {
        const el = document.getElementById('cadastroModal');
        if (el && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            new bootstrap.Modal(el).show();
            return;
        }
        if (++attempts < 50) setTimeout(tryShow, 100);
    }
    document.readyState === 'loading'
        ? document.addEventListener('DOMContentLoaded', tryShow)
        : tryShow();
}

// Abre modal com base no parâmetro ?modal=login|cadastro
function showModalFromQuery() {
    function getParam(name) { return new URLSearchParams(window.location.search).get(name); }
    const modal = getParam('modal');
    if (!modal) return;
    if (modal === 'login') showLoginModalWhenReady();
    if (modal === 'cadastro') showCadastroModalWhenReady();
}

// executa após DOM carregado
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', showModalFromQuery);
} else {
    showModalFromQuery();
}
