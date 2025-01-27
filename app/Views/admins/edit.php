<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Painel Administrativo - Editar Admin</title>

	<link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />

	<!-- loader-->
	<link href="/assets/css/pace.min.css" rel="stylesheet" />
	<script src="/assets/js/pace.min.js"></script>

	<link rel="stylesheet" href="/assets/css/styles.css">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Roboto&display=swap" />

	<link rel="stylesheet" href="/assets/css/app.css" />
</head>

<body>
	<div class="wrapper">
    <div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div class="">
					<img src="/assets/images/logo-icon.png" class="logo-icon-2" alt="" />
				</div>
				<div>
					<h4 class="logo-text">Painel Administrativo</h4>
				</div>
				<a href="javascript:;" class="toggle-btn ms-auto"> <i class="bx bx-menu"></i>
				</a>
			</div>

			<ul class="metismenu" id="menu">
                <li>
					<a href="/admin/dashboard">
						<div class="parent-icon icon-color-1"><i class="bx bx-home-alt"></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>

				<li class="menu-label">Gerenciamento de Usuários</li>

				<li>
					<a href="/admin/clients">
						<div class="parent-icon icon-color-2"><i class="bx bx-envelope"></i>
						</div>
						<div class="menu-title">Clientes</div>
					</a>
				</li>

				<li>
					<a href="/admin/users">
						<div class="parent-icon icon-color-3"> <i class="bx bx-conversation"></i>
						</div>
						<div class="menu-title">Administradores</div>
					</a>
				</li>
			</ul>
		</div>

		<header class="top-header">
			<nav class="navbar navbar-expand">
				<div class="right-topbar ms-auto">
					<ul class="navbar-nav">
						<li class="nav-item dropdown dropdown-user-profile">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
								<div class="d-flex user-box align-items-center">
									<div class="user-info">
										<p class="user-name mb-0"><?= $adminName ?></p>
									</div>
									<img src="/assets/images/logo-icon.png" class="user-img" alt="user avatar">
								</div>
							</a>
                            <div class="dropdown-menu dropdown-menu-end">
								<div class="dropdown-divider mb-0"></div>
									<a class="dropdown-item" href="javascript:;" id="logoutAdmin">
										<i class="bx bx-power-off"></i><span>Logout</span>
									</a>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<div class="page-wrapper">
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex justify-content-between">
								<h4 class="mb-0">Editar Admin</h4>
							</div>

							<hr/>

							<form id="adminEditForm" class="row g-3">
                            <div class="card border-top border-0 border-4 border-info">
									<div class="card-body">
										<div class="border p-4 rounded">
											<div class="row mb-3">
												<label for="inputNome" class="col-sm-3 col-form-label">Nome</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="inputNome" placeholder="Nome" maxlength="255" required>
												</div>
											</div>

											<div class="row mb-3">
												<label for="inputEmail" class="col-sm-3 col-form-label">E-mail</label>
												<div class="col-sm-9">
													<input type="email" class="form-control" id="inputEmail" placeholder="E-mail" maxlength="255" required>
												</div>
											</div>

											<div class="row mb-3">
												<label for="inputSenha" class="col-sm-3 col-form-label">Senha</label>
												<div class="col-sm-9">
													<input type="password" class="form-control" id="inputSenha" placeholder="Senha" minlength="6" maxlength="255">
												</div>
											</div>

											<div class="row mb-3"></div>
											<div class="row mb-3"></div>

											<div class="row mt-6"> 
												<div> 
													<button type="submit" class="btn btn-primary">Editar</button>
												</div>
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

		<div class="overlay toggle-btn-mobile"></div>

		<div class="footer">
			<p class="mb-0">Painel Administrativo @2025</p>
		</div>

		<script src="/assets/js/bundle.js"></script>

        <script>
            $(document).ready(function () {

                // Inicia o processo de autopreenchimento dos campos

                const adminData = <?php echo json_encode($admin); ?>;
                const adminId   = adminData.id;

                Swal.fire({
                    title: 'Carregando...',
                    html: 'Estamos carregando os dados do cliente.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $('#inputNome').val(adminData.nome);
                $('#inputEmail').val(adminData.email);
                $('#inputSenha').val(adminData.senha);

                Swal.close();

                $('#adminEditForm').on('submit', function (e) {
                    e.preventDefault();

                    const adminData = {
                        nome: $('#inputNome').val(),
                        email: $('#inputEmail').val(),
                    };

                    const senha = $('#inputSenha').val();

                    if (senha !== '') {
                        adminData.senha = senha;
                    }

                    $.ajax({
                        url: `/admin/users/edit/${adminId}`,
                        method: 'PATCH',
                        data: adminData,
                        dataType: 'json',
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso!',
                                text: response.message || 'Admin alterado com sucesso.',
                                confirmButtonText: 'Ok'
                            }).then(() => window.location.reload());
                        },
                        error: function (xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro!',
                                text: xhr.responseJSON?.error || 'Ocorreu um erro ao alterar o admin.',
                                confirmButtonText: 'Ok'
                            });
                        }
                    });
                });
            });

			$(document).on('click', '#logoutAdmin', function () {
				Swal.fire({
					title: 'Você tem certeza?',
					text: "Deseja realmente sair?",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sim, sair!',
					cancelButtonText: 'Cancelar'
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: '/admin/logout',
							type: 'POST',
							success: function (response) {
								Swal.fire(
									'Desconectado!',
									'Você foi desconectado com sucesso.',
									'success'
								).then(() => {
									window.location.href = '/admin/login';
								});
							},
							error: function (xhr) {
								Swal.fire(
									'Erro!',
									'Ocorreu um erro ao tentar desconectar.',
									'error'
								);
							}
						});
					}
				});
			});
        </script>
	</div>
</body>

</html>
