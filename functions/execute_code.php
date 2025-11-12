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

switch ($action) {
  case "run":
    $filename = $baseDir . "main";
    $saida = "";

    switch ($linguagem) {
      case "python":
        $file = "$filename.py";
        file_put_contents($file, $codigo);
        // tenta vários invocadores comuns; prioriza o launcher do Windows (py -3)
        // adiciona também fallback absoluto para o py.exe do usuário (Windows)
        $candidates = [
          '"C:\\Users\\User\\AppData\\Local\\Programs\\Python\\Launcher\\py.exe" -3',
          '"C:\\Users\\User\\AppData\\Local\\Programs\\Python\\Launcher\\py.exe"',
          'py -3',
          'py',
          'python3',
          'python'
        ];
        $descriptors = [
          0 => ["pipe", "r"],
          1 => ["pipe", "w"],
          2 => ["pipe", "w"]
        ];
        $ran = false;
        $errors = [];
        foreach ($candidates as $cand) {
          $cmd = $cand . ' ' . escapeshellarg($file);
          $proc = @proc_open($cmd, $descriptors, $pipes, $baseDir);
          if (is_resource($proc)) {
            if ($stdin !== '') fwrite($pipes[0], $stdin);
            fclose($pipes[0]);
            $out = stream_get_contents($pipes[1]); fclose($pipes[1]);
            $err = stream_get_contents($pipes[2]); fclose($pipes[2]);
            $code = proc_close($proc);
            $saida = trim($out . ($err ? "\n" . $err : ""));
            $ran = true;
            break;
          } else {
            $errors[] = "tentativa: '" . $cmd . "' falhou";
          }
        }
        if (!$ran) {
          $saida = "Falha ao iniciar processo Python. Tentativas: " . implode('; ', $errors) . ". Verifique se o Python está instalado e no PATH do usuário do servidor (Apache/IIS).";
        }
        break;

      case "javascript":
        $file = "$filename.js";
        file_put_contents($file, $codigo);
        $candidates = ["node"];
        $descriptors = [0=>["pipe","r"],1=>["pipe","w"],2=>["pipe","w"]];
        $ran = false; $errors = [];
        foreach ($candidates as $cand) {
          $cmd = $cand . ' ' . escapeshellarg($file);
          $proc = @proc_open($cmd, $descriptors, $pipes, $baseDir);
          if (is_resource($proc)) {
            if ($stdin !== '') fwrite($pipes[0], $stdin);
            fclose($pipes[0]);
            $out = stream_get_contents($pipes[1]); fclose($pipes[1]);
            $err = stream_get_contents($pipes[2]); fclose($pipes[2]);
            proc_close($proc);
            $saida = trim($out . ($err ? "\n" . $err : ""));
            $ran = true; break;
          } else { $errors[] = "tentativa: '" . $cmd . "' falhou"; }
        }
        if (!$ran) $saida = "Falha ao iniciar Node.js. Tentativas: " . implode('; ', $errors);
        break;

      case "php":
        $file = "$filename.php";
        file_put_contents($file, $codigo);
        $candidates = ["php"];
        $descriptors = [0=>["pipe","r"],1=>["pipe","w"],2=>["pipe","w"]];
        $ran = false; $errors = [];
        foreach ($candidates as $cand) {
          $cmd = $cand . ' ' . escapeshellarg($file);
          $proc = @proc_open($cmd, $descriptors, $pipes, $baseDir);
          if (is_resource($proc)) {
            if ($stdin !== '') fwrite($pipes[0], $stdin);
            fclose($pipes[0]);
            $out = stream_get_contents($pipes[1]); fclose($pipes[1]);
            $err = stream_get_contents($pipes[2]); fclose($pipes[2]);
            proc_close($proc);
            $saida = trim($out . ($err ? "\n" . $err : ""));
            $ran = true; break;
          } else { $errors[] = "tentativa: '" . $cmd . "' falhou"; }
        }
        if (!$ran) $saida = "Falha ao iniciar PHP-CLI. Tentativas: " . implode('; ', $errors);
        break;

      case "c":
        $file = "$filename.c";
        file_put_contents($file, $codigo);
        // Compila o código C
        $compile = shell_exec("gcc " . escapeshellarg($file) . " -o " . escapeshellarg($baseDir . 'a.out') . " 2>&1");
        if ($compile) {
          $saida = $compile; // Saída de erro de compilação
        } else {
          // Executa o binário compilado
          $run = shell_exec(escapeshellarg($baseDir . 'a.out') . " 2>&1");
          $saida = $run ?: "Executado (sem saída).";
        }
        break;

      case "java":
        $file = "$filename.java";
        file_put_contents($file, $codigo);
        // Compila o código Java (requer que a classe principal seja "Main")
        $compile = shell_exec("javac " . escapeshellarg($file) . " 2>&1");
        if ($compile) {
          $saida = $compile; // Saída de erro de compilação
        } else {
          // Executa a classe compilada
          $run = shell_exec("java -cp " . escapeshellarg($baseDir) . " Main 2>&1");
          $saida = $run ?: "Executado (sem saída).";
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