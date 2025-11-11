<?php 
session_start();
include_once __DIR__ . '/../includes/header.php';
include_once __DIR__ . '/../includes/sidebar.php';
include_once __DIR__ . '/../config/conexao.php';

$usuario_id = $_SESSION['usuario_id'] ?? null;
$usuario_nome = $_SESSION['usuario_nome'] ?? 'Usuário';

if (!$usuario_id) {
    header("Location: login.php");
    exit;
}
?>

<main class="ms-250 p-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="welcome-card card-highlight p-4">
                    <h3 class="welcome-title">Bem-vindo, <?php echo htmlspecialchars($usuario_nome); ?>!</h3>
                    <p class="text-white-85">Aqui está o seu painel de controle. Use o menu à esquerda para navegar pelos recursos.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../includes/footer.php'?>
