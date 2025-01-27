<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Painel Administrativo - Login</title>

	<link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />

	<link href="/assets/css/pace.min.css" rel="stylesheet" />
	<script src="/assets/js/pace.min.js"></script>

	<link rel="stylesheet" href="/assets/css/styles.css">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Roboto&display=swap" />

	<link rel="stylesheet" href="/assets/css/app.css" />
</head>

<body class="bg-login">
	<div class="wrapper">
		<div class="section-authentication-login d-flex align-items-center justify-content-center mt-4">
			<div class="row">
				<div class="col-12 col-lg-8 mx-auto">
					<div class="card radius-15 overflow-hidden">
						<div class="row g-0">
							<div class="col-xl-6">
								<div class="card-body p-5">
									<div class="text-center">
										<img src="/assets/images/logo-icon.png" width="80" alt="">
										<h3 class="mt-4 font-weight-bold">Bem-Vindo</h3>
									</div>
									<div class="">
										<div class="form-body">
											<form id="loginForm" class="row g-3">
												<div class="col-12">
													<label for="inputEmailAddress" class="form-label">E-mail</label>
													<input type="email" class="form-control" id="inputEmailAddress" placeholder="E-mail" required>
												</div>
												<div class="col-12">
													<label for="inputChoosePassword" class="form-label">Senha</label>
													<div class="input-group" id="show_hide_password">
														<input type="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Senha" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
													</div>
												</div>
												<div class="col-12">
													<div class="d-grid">
														<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Entrar</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							 </div>
							<div class="col-xl-6 bg-login-color d-flex align-items-center justify-content-center">
								<img src="/assets/images/login-images/login-frent-img.jpg" class="img-fluid" alt="...">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<script src="/assets/js/bundle.js"></script>

<script>
	$(document).ready(function () {
		$("#show_hide_password a").on('click', function (event) {
			event.preventDefault();
			if ($('#show_hide_password input').attr("type") == "text") {
				$('#show_hide_password input').attr('type', 'password');
				$('#show_hide_password i').addClass("bx-hide");
				$('#show_hide_password i').removeClass("bx-show");
			} else if ($('#show_hide_password input').attr("type") == "password") {
				$('#show_hide_password input').attr('type', 'text');
				$('#show_hide_password i').removeClass("bx-hide");
				$('#show_hide_password i').addClass("bx-show");
			}
		});

		$('#loginForm').on('submit', function (e) {
			e.preventDefault();

			const email = $('#inputEmailAddress').val();
			const password = $('#inputChoosePassword').val();

			$.ajax({
				url: '/admin/login',
				method: 'POST',
				data: { email: email, password: password },
				dataType: 'json',
				success: function (response) {
					Swal.fire({
						icon: 'success',
						title: 'Bem-vindo!',
						text: 'Login realizado com sucesso.',
					}).then(() => {
						window.location.href = '/admin/dashboard';
					});
				},
				error: function (xhr) {
					let message = 'Erro ao realizar o login.';

					if (xhr.responseJSON && xhr.responseJSON.error) {
						message = xhr.responseJSON.error;
					}

					Swal.fire({
						icon: 'error',
						title: 'Erro!',
						text: message,
					});
				}
			});
		});
	});
</script>

</html>
