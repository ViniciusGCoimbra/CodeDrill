// Inicializa o editor Ace com configurações melhores
const editor = ace.edit("editor", { maxLines: Infinity });
editor.setTheme("ace/theme/monokai");
editor.session.setMode("ace/mode/python");
// inicializa vazio; placeholder será aplicado dinamicamente após o editor calcular altura
editor.setValue('', -1);
editor.setOptions({ fontSize: '14px', showPrintMargin: false });

// Elementos importantes (serão inicializados quando o DOM estiver pronto)
let linguagemSelect, temaSelect, fontSizeInput, btnExecutar, btnSalvar, btnLimpar;

// Mapear linguagens para modos do Ace
const aceModes = {
  python: "ace/mode/python",
  javascript: "ace/mode/javascript",
  c: "ace/mode/c_cpp",
  java: "ace/mode/java",
  php: "ace/mode/php"
};

function setEditorLanguage(lang) {
  const mode = aceModes[lang] || 'ace/mode/text';
  editor.session.setMode(mode);
}

// Placeholder dinamico: escreve uma mensagem inicial ocupando o número de linhas visiveis
let isPlaceholder = false;
function applyDynamicPlaceholder() {
  try {
    const container = editor.container;
    const lineHeight = editor.renderer.lineHeight || 18;
    const visibleLines = Math.max(3, Math.floor(container.clientHeight / lineHeight));
    const firstLine = "// Escreva seu código aqui";
    const rest = Array(Math.max(0, visibleLines - 1)).fill('').join('\n');
    const placeholder = firstLine + (rest ? '\n' + rest : '');

    if (editor.getValue().trim() === '') {
      isPlaceholder = true;
      // setValue triggers change; we will attach a one-time handler to clear on user input
      editor.setValue(placeholder, -1);
      // ensure cursor at start
      editor.selection.clearSelection();
      editor.moveCursorTo(0, 0);

      const clearOnType = function() {
        if (!isPlaceholder) return;
        // user typed — clear placeholder and remove this handler
        isPlaceholder = false;
        editor.off('change', clearOnType);
        // if there's any user input (change event payload), clear all and leave cursor
        editor.setValue('', -1);
      };
      // attach handler after small timeout to avoid catching the programmatic setValue
      setTimeout(() => editor.on('change', clearOnType), 50);
    }
  } catch (e) {
    // fail silently
    console.error('Placeholder error', e);
  }
}

// Observers serão registrados após o DOM estar pronto

// Limpa a saída
function limparSaida() {
  const saidaBox = document.getElementById('saida');
  saidaBox.textContent = '';
  saidaBox.style.color = '';
}

function setButtonsDisabled(state) {
  [btnExecutar, btnSalvar, btnLimpar].forEach(b => {
    if (!b) return;
    b.disabled = state;
  });
}

// SALVAR → força download via POST
function salvarCodigo() {
  const codigo = editor.getValue();
  const linguagem = linguagemSelect.value;

  const form = document.createElement('form');
  form.method = 'POST';
  form.action = '../functions/execute_code.php';

  const actionField = document.createElement('input');
  actionField.type = 'hidden';
  actionField.name = 'action';
  actionField.value = 'download';
  form.appendChild(actionField);

  const codigoField = document.createElement('input');
  codigoField.type = 'hidden';
  codigoField.name = 'codigo';
  codigoField.value = codigo;
  form.appendChild(codigoField);

  const linguagemField = document.createElement('input');
  linguagemField.type = 'hidden';
  linguagemField.name = 'linguagem';
  linguagemField.value = linguagem;
  form.appendChild(linguagemField);

  document.body.appendChild(form);
  form.submit();
  document.body.removeChild(form);
}

// EXECUTAR → envia código + stdin e mostra saída, com estado de botões
function executarCodigo() {
  const codigo = editor.getValue();
  const linguagem = linguagemSelect.value;

  const saidaBox = document.getElementById('saida');
  saidaBox.textContent = 'Executando...';
  saidaBox.style.color = 'lightblue';

  setButtonsDisabled(true);

  fetch('../functions/execute_code.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ action: 'run', linguagem, codigo })
  })
  .then(async r => {
    const text = await r.text();
    return text;
  })
  .then(saida => {
    saidaBox.textContent = saida || 'Nenhuma saída gerada.';
    // colorir erros básicos
    const lower = (saida || '').toLowerCase();
    if (lower.includes('error') || lower.includes('erro') || lower.includes('exception') || lower.includes('fatal')) {
      saidaBox.style.color = 'salmon';
    } else {
      saidaBox.style.color = 'lime';
    }
  })
  .catch(err => {
    saidaBox.textContent = 'Erro na execução: ' + (err.message || err);
    saidaBox.style.color = 'salmon';
  })
  .finally(() => setButtonsDisabled(false));
}

// Inicialização: aplica valores iniciais e registra handlers com segurança
document.addEventListener('DOMContentLoaded', () => {
  linguagemSelect = document.getElementById('linguagem');
  temaSelect = document.getElementById('temaEditor');
  fontSizeInput = document.getElementById('fontSize');
  btnExecutar = document.getElementById('btnExecutar');
  btnSalvar = document.getElementById('btnSalvar');
  // btnLimpar = document.getElementById('btnLimpar'); // Não usado no HTML atual

  // Terminal toggle and clear
  const terminalToggle = document.getElementById('vsc-terminal-toggle');
  const vscodeClear = document.getElementById('vsc-clear');
  const vscodeTerminal = document.getElementById('vscode-terminal');

  // Adiciona a funcionalidade de toggle do terminal
  if (terminalToggle && vscodeTerminal) {
    terminalToggle.addEventListener('click', () => {
      const isHidden = window.getComputedStyle(vscodeTerminal).display === 'none';
      const ed = document.getElementById('editor');
      if (isHidden) {
        vscodeTerminal.style.display = 'block';
        // Ajusta a altura do editor para caber o terminal abaixo
        if (ed) ed.style.height = '360px'; 
      } else {
        vscodeTerminal.style.display = 'none';
        if (ed) ed.style.height = '520px'; // Retorna à altura padrão
      }
      // Permite que o ACE repinte (resize) para ajustar o layout
      setTimeout(() => { try { editor.resize(); applyDynamicPlaceholder(); } catch(e){} }, 120);
    });
  }

  // Limpar a saída do terminal
  if (vscodeClear) {
    vscodeClear.addEventListener('click', () => {
      const saidaBox = document.getElementById('saida');
      if (saidaBox) { saidaBox.textContent = ''; saidaBox.style.color = ''; }
    });
  }

  // Mudança de Linguagem
  if (linguagemSelect) {
    setEditorLanguage(linguagemSelect.value);
    linguagemSelect.addEventListener('change', (e) => setEditorLanguage(e.target.value));
  }

  // Mudança de Tema
  if (temaSelect) {
    editor.setTheme(temaSelect.value || 'ace/theme/monokai');
    temaSelect.addEventListener('change', (e) => editor.setTheme(e.target.value));
  }

  // Mudança de Fonte
  if (fontSizeInput) {
    // garantir valor válido
    let initial = parseInt(fontSizeInput.value, 10);
    if (isNaN(initial) || initial < 12) initial = 14;
    if (initial > 24) initial = 24;
    fontSizeInput.value = initial;
    editor.setOptions({ fontSize: initial + 'px' });

    fontSizeInput.addEventListener('input', (e) => {
      let v = parseInt(e.target.value, 10);
      if (isNaN(v)) v = 14;
      v = Math.max(12, Math.min(24, v));
      e.target.value = v; // força o valor dentro dos limites
      editor.setOptions({ fontSize: v + 'px' });
    });
  }
  // aplica placeholder dinâmico inicialmente
  applyDynamicPlaceholder();
  // recalcula placeholder em resize (debounced)
  let _resizeTimer = null;
  window.addEventListener('resize', () => {
    clearTimeout(_resizeTimer);
    _resizeTimer = setTimeout(() => { try { editor.resize(); applyDynamicPlaceholder(); } catch(e){} }, 120);
  });
});