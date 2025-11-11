// sidebar toggle/minimize - versão melhorada
(function(){
  const toggle = document.getElementById('sidebarToggle');
  const sidebar = document.querySelector('.sidebar');
  if (!toggle || !sidebar) return;

  // utilitário: retorna se estamos em viewport pequena (onde não queremos minimizar por padrão)
  function isMobileWidth() {
    return window.matchMedia && window.matchMedia('(max-width: 768px)').matches;
  }

  function setState(minimized, save = true) {
    if (minimized) {
      sidebar.classList.add('sidebar-minimized');
      document.body.classList.add('sidebar-minimized');
      toggle.setAttribute('aria-pressed', 'true');
      // ícone indica ação disponível (expandir)
      toggle.innerHTML = '<i class="bi bi-chevron-right" aria-hidden="true"></i>';
      toggle.setAttribute('aria-label', 'Expandir sidebar');
      toggle.setAttribute('title', 'Expandir sidebar');
      if (save) localStorage.setItem('sidebarMinimized', '1');
    } else {
      sidebar.classList.remove('sidebar-minimized');
      document.body.classList.remove('sidebar-minimized');
      toggle.setAttribute('aria-pressed', 'false');
      // ícone indica ação disponível (minimizar)
      toggle.innerHTML = '<i class="bi bi-chevron-left" aria-hidden="true"></i>';
      toggle.setAttribute('aria-label', 'Minimizar sidebar');
      toggle.setAttribute('title', 'Minimizar sidebar');
      if (save) localStorage.removeItem('sidebarMinimized');
    }
  }

  // alterna estado com proteção para mobile
  function toggleState() {
    const minimized = sidebar.classList.contains('sidebar-minimized');
    setState(!minimized);
  }

  // Inicializa: aplica estado salvo, mas desativa minimizado em telas pequenas
  function init() {
    const saved = localStorage.getItem('sidebarMinimized');
    // Prioriza preferência salva. Se não houver preferência, em mobile inicia minimizado.
    if (saved === '1') {
      setState(true, false);
    } else if (saved === '0') {
      setState(false, false);
    } else if (isMobileWidth()) {
      setState(true, false);
    } else {
      setState(false, false);
    }
  }

  // Eventos
  toggle.addEventListener('click', function(e){
    e.preventDefault();
    toggleState();
  });

  // Suporte a teclado (Enter / Space)
  toggle.addEventListener('keydown', function(e){
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      toggleState();
    }
  });

  // No resize, ajusta comportamento (por exemplo: restaura expandido em mobile)
  let resizeTimer = null;
  window.addEventListener('resize', function(){
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function(){
      const saved = localStorage.getItem('sidebarMinimized');
      if (isMobileWidth()) {
        // em mobile: se o usuário já salvou uma preferência, respeita; caso contrário garante minimizado
        if (saved === '1') setState(true, false);
        else if (saved === '0') setState(false, false);
        else setState(true, false);
      } else {
        // desktop: respeita preferência salva ou expande por padrão
        if (saved === '1') setState(true, false);
        else setState(false, false);
      }
    }, 150);
  });

  // Inicializa após DOM pronto
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
