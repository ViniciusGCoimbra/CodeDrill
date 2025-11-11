<?php include_once __DIR__ . '/../includes/header.php'; ?>
<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php include_once __DIR__ . '/../includes/sidebar.php'; ?>

<!-- CodeMirror CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/theme/dracula.min.css">

<style>
    .CodeMirror {
        border: 1px solid #ddd;
        height: 500px;
        font-size: 1rem;
        border-radius: 8px;
    }
    .output-panel {
        margin-top: 1rem;
        background-color: #282a36; /* Cor do tema Dracula */
        color: #f8f8f2;
        padding: 15px;
        border-radius: 8px;
        height: 200px;
        overflow-y: auto;
        font-family: 'Courier New', Courier, monospace;
    }
</style>

<main class="ms-250 p-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="welcome-card p-4">
                    <h3 class="welcome-title">Ambiente de Desenvolvimento</h3>
                    <p class="text-white-85">Escreva, compile e execute seus códigos aqui.</p>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <label for="language" class="form-label">Linguagem:</label>
                                <select id="language" class="form-select-sm">
                                    <option value="python" selected>Python</option>
                                    <option value="javascript">JavaScript</option>
                                    <option value="php">PHP</option>
                                    <option value="java">Java</option>
                                    <option value="c">C</option>
                                    <option value="cpp">C++</option>
                                </select>
                            </div>
                            <button id="runBtn" class="btn btn-config text-white">
                                <i class="bi bi-play-fill"></i> Executar
                            </button>
                        </div>

                        <textarea id="code-editor"></textarea>

                        <h5 class="mt-4">Saída:</h5>
                        <pre id="output" class="output-panel">A saída do seu código aparecerá aqui...</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- CodeMirror JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/python/python.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/javascript/javascript.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/php/php.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/clike/clike.min.js"></script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editor = CodeMirror.fromTextArea(document.getElementById('code-editor'), {
        lineNumbers: true,
        theme: 'dracula',
        mode: 'python', // Linguagem padrão
        indentUnit: 4
    });

    const languageSelect = document.getElementById('language');
    languageSelect.addEventListener('change', function() {
        let mode = this.value;
        let modeFile = mode;
        if (mode === 'c' || mode === 'cpp' || mode === 'java') {
            mode = 'text/x-c++src'; // Mapeamento para C-like languages
        }
        editor.setOption('mode', mode);
    });

    const runBtn = document.getElementById('runBtn');
    const outputPanel = document.getElementById('output');

    runBtn.addEventListener('click', function() {
        const code = editor.getValue();
        const language = languageSelect.value;

        outputPanel.textContent = 'Executando...';

        // AQUI ENTRARÁ A LÓGICA PARA CHAMAR A API
        // Por enquanto, vamos apenas simular
        setTimeout(() => {
            outputPanel.textContent = `Código a ser executado em ${language}:\n\n${code}`;
            console.log("Código:", code);
            console.log("Linguagem:", language);
        }, 500);
    });
});
</script>
