<?php include_once __DIR__ . '/../includes/header.php'; ?>
<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php include_once __DIR__ . '/../includes/sidebar.php';?>

<main class="ms-250 p-4 compilador-page">
  <div class="container-fluid">
    <!-- VSCode-like top action bar (Bootstrap toolbar + icons) -->
    <div class="vscode-bar mb-3 d-flex align-items-center">
      <div class="vscode-left d-flex align-items-center">
        <div class="btn-toolbar" role="toolbar" aria-label="Editor toolbar">
          <div class="btn-group me-2" role="group" aria-label="File group">
            <img src="../public/assets/images/mascote.png" alt="CodeDrill Logo" height="30" class="me-2">
          </div>
        </div>
      </div>

      <div class="vscode-center text-center flex-fill">
        <strong>CodeDrill</strong>
      </div>

      <div class="vscode-actions d-flex align-items-center">
        <div class="d-flex align-items-center me-3">
          <label for="linguagem" class="me-2 mb-0 small text-white">Linguagem</label>
          <select id="linguagem" class="form-select form-select-sm">
            <option value="python">Python</option>
            <option value="javascript">JavaScript</option>
            <option value="c">C</option>
            <option value="java">Java</option>
            <option value="php">PHP</option>
          </select>
        </div>

        <div class="d-flex align-items-center me-3">
          <label for="temaEditor" class="me-2 mb-0 small text-white">Tema</label>
          <select id="temaEditor" class="form-select form-select-sm">
            <option value="ace/theme/monokai">Monokai</option>
            <option value="ace/theme/github">GitHub (claro)</option>
            <option value="ace/theme/solarized_dark">Solarized Dark</option>
          </select>
        </div>

        <div class="d-flex align-items-center me-2 font-size-control">
          <label for="fontSize" class="me-2 mb-0 small text-white">Fonte</label>
          <input id="fontSize" type="number" min="12" max="24" value="14" class="form-control form-control-sm" style="width:78px;">
        </div>

        <div class="btn-group ms-2" role="group" aria-label="Actions">
          <button id="btnSalvar" class="btn btn-sm btn-outline-success" onclick="salvarCodigo()" title="Salvar"><i class="bi bi-save"></i></button>
          <button id="btnExecutar" class="btn btn-sm btn-primary" onclick="executarCodigo()" title="Executar"><i class="bi bi-play-fill"></i></button>
          <button id="vsc-terminal-toggle" class="btn btn-sm btn-outline-secondary" title="Terminal"><i class="bi bi-terminal-fill"></i></button>
        </div>
      </div>
    </div>

    <!-- Editor + Saída (lado a lado em desktop, empilha em mobile) -->
      <div class="row g-3 vscode-layout">
        <div class="col-12">
          <div class="row">
            <div class="col-lg-8 mb-3">
              <div class="editor-container border rounded h-100">
                <div id="editor" style="width:100%;"></div>
              </div>
            </div>

            <div class="col-lg-4 d-flex mb-3">
              <div id="vscode-terminal" class="card vscode-terminal bg-dark text-white w-100">
                <div class="card-body p-2 d-flex flex-column">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong>Saída</strong>
                    <div>
                      <button id="vsc-clear" class="btn btn-sm btn-outline-light">Clear</button>
                    </div>
                  </div>
                  <pre id="saida" class="form-control bg-dark text-white border-secondary flex-fill" style="min-height:520px; overflow:auto;"></pre>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</main>

<?php include_once(__DIR__ . '/../includes/footer.php'); ?>

