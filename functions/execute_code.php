<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain; charset=utf-8");

// Suporta JSON (fetch) ou form POST (download via form)
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);
if (!is_array($data)) {
  // fallback para form-encoded
  $data = $_POST;
}

$action = $data["action"] ?? null;
$codigo = $data["codigo"] ?? ($data['code'] ?? "");
$linguagem = $data["linguagem"] ?? ($data['language'] ?? "python");
$stdin = $data['stdin'] ?? '';

// Diretório temporário para salvar e executar os arquivos
$baseDir = __DIR__ . "/../temp_exec/";
if (!is_dir($baseDir)) mkdir($baseDir, 0777, true);

// Helpers
$isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';

function runCommand(array $cmdParts, $cwd, $stdin = '', $timeout = 5) {
  $descriptors = [0 => ["pipe","r"], 1 => ["pipe","w"], 2 => ["pipe","w"]];
  // Build command string (avoid shell escaping problems on Windows)
  $cmd = implode(' ', array_map(function($p){ return $p; }, $cmdParts));

  $proc = @proc_open($cmd, $descriptors, $pipes, $cwd);
  if (!is_resource($proc)) return [false, "failed-to-start"];

  if ($stdin !== '') fwrite($pipes[0], $stdin);
  fclose($pipes[0]);

  stream_set_blocking($pipes[1], false);
  stream_set_blocking($pipes[2], false);

  $output = '';
  $err = '';
  $start = microtime(true);
  $status = proc_get_status($proc);
  while ($status['running']) {
    $output .= stream_get_contents($pipes[1]);
    $err .= stream_get_contents($pipes[2]);
    if ((microtime(true) - $start) > $timeout) {
      // timeout
      proc_terminate($proc);
      foreach ($pipes as $p) { @fclose($p); }
      return [false, "timeout", $output, $err];
    }
    usleep(100000);
    $status = proc_get_status($proc);
  }

  // read remaining
  $output .= stream_get_contents($pipes[1]); fclose($pipes[1]);
  $err .= stream_get_contents($pipes[2]); fclose($pipes[2]);

  $code = proc_close($proc);
  return [true, $code, $output, $err];
}

switch ($action) {
  case "run":
    $filename = $baseDir . "main";
    $saida = "";

    switch ($linguagem) {
      case "python":
        $file = "$filename.py";
        file_put_contents($file, $codigo);
        $candidates = [
          '"C:\\Users\\User\\AppData\\Local\\Programs\\Python\\Launcher\\py.exe" -3',
          '"C:\\Users\\User\\AppData\\Local\\Programs\\Python\\Launcher\\py.exe"',
          'py -3',
          'py',
          'python3',
          'python'
        ];
        $ran = false; $errors = [];
        foreach ($candidates as $cand) {
          $parts = [$cand . ' ' . escapeshellarg($file)];
          $res = runCommand($parts, $baseDir, $stdin, 8);
          if ($res[0]) {
            $saida = trim(($res[2] ?? '') . (($res[3] ?? '') ? "\n" . $res[3] : ""));
            $ran = true; break;
          } else {
            $errors[] = is_array($res) && isset($res[1]) ? $res[1] : 'unknown';
          }
        }
        if (!$ran) $saida = "Falha ao iniciar processo Python. Tentativas: " . implode('; ', $errors) . ". Verifique se o Python está instalado e acessível.";
        break;

      case "javascript":
        $file = "$filename.js";
        file_put_contents($file, $codigo);
        $res = runCommand(['node ' . escapeshellarg($file)], $baseDir, $stdin, 8);
        if ($res[0]) $saida = trim(($res[2] ?? '') . (($res[3] ?? '') ? "\n" . $res[3] : ""));
        else $saida = "Falha ao iniciar Node.js: " . ($res[1] ?? 'unknown');
        break;

      case "php":
        $file = "$filename.php";
        file_put_contents($file, $codigo);
        $res = runCommand(['php ' . escapeshellarg($file)], $baseDir, $stdin, 8);
        if ($res[0]) $saida = trim(($res[2] ?? '') . (($res[3] ?? '') ? "\n" . $res[3] : ""));
        else $saida = "Falha ao iniciar PHP-CLI: " . ($res[1] ?? 'unknown');
        break;

      case "c":
        $file = "$filename.c";
        file_put_contents($file, $codigo);
        $exe = $baseDir . ($isWindows ? 'a.exe' : 'a.out');
        $resC = runCommand(['gcc', escapeshellarg($file), '-o', escapeshellarg($exe)], $baseDir, '', 15);
        if (!$resC[0] || ($resC[2] ?? '') || ($resC[3] ?? '')) {
          // show compiler output if any
          $saida = trim(($resC[2] ?? '') . "\n" . ($resC[3] ?? '')) ?: "Erro na compilação C.";
        } else {
          $runRes = runCommand([escapeshellarg($exe)], $baseDir, $stdin, 8);
          if ($runRes[0]) $saida = trim(($runRes[2] ?? '') . (($runRes[3] ?? '') ? "\n" . $runRes[3] : ""));
          else $saida = "Falha ao executar o binário C: " . ($runRes[1] ?? 'unknown');
        }
        break;

      case "java":
        // tenta encontrar nome de classe pública para nomear o arquivo corretamente
        $className = 'Main';
        if (preg_match('/public\s+class\s+([A-Za-z_][A-Za-z0-9_]*)/s', $codigo, $m)) {
          $className = $m[1];
        }
        $file = "$baseDir" . $className . ".java";
        file_put_contents($file, $codigo);
        $resJ = runCommand(['javac', escapeshellarg($file)], $baseDir, '', 20);
        if (!$resJ[0] || ($resJ[2] ?? '') || ($resJ[3] ?? '')) {
          $saida = trim(($resJ[2] ?? '') . "\n" . ($resJ[3] ?? '')) ?: "Erro na compilação Java.";
        } else {
          $run = runCommand(['java', '-cp', escapeshellarg($baseDir), $className], $baseDir, $stdin, 10);
          if ($run[0]) $saida = trim(($run[2] ?? '') . (($run[3] ?? '') ? "\n" . $run[3] : ""));
          else $saida = "Falha ao executar Java: " . ($run[1] ?? 'unknown');
        }
        break;

      default:
        echo "Linguagem não suportada.";
        exit;
    }

    echo $saida ?: "Nenhuma saída gerada.";
    break;

  case "download":
    $extensoes = [
      'python' => 'py',
      'javascript' => 'js',
      'c' => 'c',
      'java' => 'java',
      'php' => 'php'
    ];
    $ext = $extensoes[$linguagem] ?? 'txt';

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="meu_codigo.' . $ext . '"');
    echo $codigo;
    break;

  default:
    echo "Ação inválida.";
    break;
}