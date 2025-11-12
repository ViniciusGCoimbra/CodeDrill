<!-- Elemento raiz para toasts (pode ser usado para renderização dinâmica) -->
<div id="toast-root"></div>

<!-- Container centralizado para exibir os toasts -->
<div id="toast-container" 
     class="position-fixed top-0 start-50 translate-middle-x p-3 d-flex flex-column align-items-center" 
     style="z-index:10800; width:100%; max-width:900px; pointer-events:none;">
</div>

<!-- Scripts essenciais: Bootstrap + scripts personalizados -->
<script src="../public/assets/js/bootstrap.bundle.min.js"></script>
<script src="../public/assets/js/ui.js"></script>
<script src="../public/assets/js/toast.js"></script>
<script src="../public/assets/js/modals.js"></script>
<script src="../public/assets/js/visisenha.js"></script>
<script src="../public/assets/js/sidebar.js"></script>
<script src="assets/ace/ace.js"></script>
<script src="assets/js/compilador.js"></script>

<!-- Executa automaticamente a função de exibir toast com base na query string -->
<script>
    function _runToastFromQueryWhenReady() {
        if (typeof showToastFromQuery === 'function') {
            showToastFromQuery();
            return;
        }
        setTimeout(_runToastFromQueryWhenReady, 100);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', _runToastFromQueryWhenReady);
    } else {
        _runToastFromQueryWhenReady();
    }
</script>
</body>
</html>
