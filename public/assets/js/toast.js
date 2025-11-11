function showToastFromQuery() {
    function getParam(name) {
        const params = new URLSearchParams(window.location.search);
        return params.get(name);
    }

    const run = () => {
        const sucesso = getParam('sucesso');
        const erro = getParam('erro');

        if (sucesso) {
            try { showToast(decodeURIComponent(sucesso), 'success'); }
            catch(e) { showToast(sucesso, 'success'); }
        }
        if (erro) {
            try { showToast(decodeURIComponent(erro), 'danger'); }
            catch(e) { showToast(erro, 'danger'); }
        }

        // limpa os parâmetros da URL
        const url = new URL(window.location);
        url.searchParams.delete('sucesso');
        url.searchParams.delete('erro');
        window.history.replaceState({}, document.title, url.toString());
    };

    // se DOM já carregou, roda direto
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', run);
    } else {
        run();
    }
}
