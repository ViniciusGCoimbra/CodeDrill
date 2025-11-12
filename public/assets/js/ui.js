// UI helper: cria e mostra toasts usando Bootstrap
function showToast(message, type = 'info', delay = 4000) {
  try {
    const container = document.getElementById('toast-container');
    if (!container) return console.warn('Toast container não encontrado');

    // cria o toast
    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-bg-' + (type === 'danger' ? 'danger' : (type === 'success' ? 'success' : 'secondary')) + ' border-0';
    toast.setAttribute('role','alert');
    toast.setAttribute('aria-live','assertive');
    toast.setAttribute('aria-atomic','true');

    toast.style.pointerEvents = 'auto';
    toast.style.marginTop = '0.5rem';
    toast.style.minWidth = '220px';
    toast.style.maxWidth = '100%';

    const inner = document.createElement('div');
    inner.className = 'd-flex';
    inner.innerHTML = '<div class="toast-body">' + message + '</div>' +
                      '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>';

    toast.appendChild(inner);
    container.appendChild(toast);

    const bsToast = new bootstrap.Toast(toast, { delay: delay });
    bsToast.show();

    // remove o toast do DOM quando escondido
    toast.addEventListener('hidden.bs.toast', function () {
      toast.remove();
    });
  } catch (e) {
    console.error('showToast erro:', e);
  }
}
// Abre modal quando a função estiver disponível
function openModalWhenAvailable(fnName) {
  let attempts = 0;
  function tryOpen() {
    if (window[fnName] && typeof window[fnName] === 'function') {
      window[fnName]();
      return;
    }
    if (++attempts < 50) setTimeout(tryOpen, 100);
  }
  tryOpen();
}
