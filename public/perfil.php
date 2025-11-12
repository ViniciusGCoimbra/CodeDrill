<?php include_once __DIR__ . '/../includes/header.php'; ?>
<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php $usuario_nome = $_SESSION['usuario_nome'] ?? 'Meu Perfil'; ?>
<?php $usuario_avatar = $_SESSION['usuario_avatar'] ?? '/Codedrill/public/assets/images/mascote.png'; ?>
<?php include_once __DIR__ . '/../includes/sidebar.php'; ?>

<main class="ms-250 p-4">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="welcome-card card-highlight p-4">
					<h3 class="welcome-title">Perfil</h3>
					<p class="text-white-85">Aqui você pode alterar seu nome e avatar. Escolha um avatar padrão ou envie um arquivo.</p>

					<div class="card card-custom p-3 config-card mt-3">
						<form class="config-form" action="../functions/update_profile.php" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-8">
									<div class="mb-3">
										<label class="form-label">Nome</label>
										<input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($usuario_nome) ?>" required>
									</div>
									<div class="mb-3">
										<label class="form-label">Enviar novo avatar (opcional)</label>
										<input type="file" name="avatar_file" class="form-control">
									</div>
									<div>
										<button class="btn btn-config text-white">Salvar</button>
									</div>
								</div>
								<div class="col-md-4">
									<div class="text-center">
										<label class="form-label">Avatar atual</label>
										<div class="mb-2">
											<img id="avatarCurrent" src="<?= htmlspecialchars($usuario_avatar) ?>" alt="avatar" width="120" height="120" class="rounded-circle">
										</div>
										<div class="d-grid">
											<button type="button" class="btn btn-config btn-sm text-white mb-2" data-bs-toggle="modal" data-bs-target="#avatarModal">Trocar avatar</button>
											<input type="hidden" name="avatar_choice" id="avatar_choice" value="">
										</div>
									</div>
								</div>
							</div>

							<!-- Modal de escolha de avatar -->
							<div class="modal fade" id="avatarModal" tabindex="-1" aria-labelledby="avatarModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="avatarModalLabel">Escolha um avatar</h5>
											<button type="button" class="btn-close text-white btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
										</div>
										<div class="modal-body">
											<div class="d-flex flex-wrap justify-content-start" id="avatarOptions">
												<?php for ($i = 1; $i <= 10; $i++):
													$path = "/Codedrill/public/assets/images/avatars/avatar{$i}.jpg";
												?>
													<div class="m-2 text-center avatar-choice-opt">
														<img src="<?= $path ?>" width="64" height="64" class="rounded avatar-option-modal" data-path="<?= $path ?>" style="cursor:pointer; border:2px solid transparent;">
													</div>
												<?php endfor; ?>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-config text-white" data-bs-dismiss="modal">Cancelar</button>
											<button type="button" class="btn btn-config text-white" id="avatarSaveBtn">Salvar</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

<script>
// Permite selecionar visualmente o avatar escolhido
document.addEventListener('DOMContentLoaded', function(){
	// seleção no modal
	let selectedAvatar = '';
	document.querySelectorAll('.avatar-option-modal').forEach(function(img){
		img.addEventListener('click', function(){
			// limpar destaque
			document.querySelectorAll('.avatar-option-modal').forEach(i => i.style.border = '2px solid transparent');
			img.style.border = '2px solid rgba(255,255,255,0.6)';
			selectedAvatar = img.getAttribute('data-path');
		});
	});

	// Botão salvar do modal aplica ao hidden e atualiza preview
	const saveBtn = document.getElementById('avatarSaveBtn');
	saveBtn.addEventListener('click', function(){
		if (selectedAvatar) {
			document.getElementById('avatar_choice').value = selectedAvatar;
			document.getElementById('avatarCurrent').setAttribute('src', selectedAvatar);
		}
		// fecha o modal
		const modalEl = document.getElementById('avatarModal');
		const modal = bootstrap.Modal.getInstance(modalEl);
		if (modal) modal.hide();
	});
    
	// fallback: permitir clicar diretamente no avatar atual para abrir modal
	const avatarCurrent = document.getElementById('avatarCurrent');
	if (avatarCurrent) avatarCurrent.addEventListener('click', function(){
		const modalEl = document.getElementById('avatarModal');
		const modal = new bootstrap.Modal(modalEl);
		modal.show();
	});
});
</script>

