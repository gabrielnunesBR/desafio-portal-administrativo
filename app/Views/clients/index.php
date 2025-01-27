<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Painel Administrativo - Clientes</title>

	<link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />

	<!--Data Tables -->
	<link href="/assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">

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
									<a class="dropdown-item" href="javascript:;">
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
								<h4 class="mb-0">Clientes</h4>
                                <a href="/admin/clients/create" class="btn btn-primary">Adicionar</a>
							</div>
							<hr/>
							<div class="table-responsive">
								<table id="table-clients" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>Nome</th>
											<th>Data de Nascimento</th>
											<th>CPF</th>
											<th>RG</th>
											<th>Telefone</th>
											<th>Ações</th>
										</tr>
									</thead>

									<tbody>
                                        <?php foreach ($clients as $client): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($client['nome']) ?></td>

                                                <td>
                                                    <?php
                                                        $date = new DateTime($client['data_nascimento']);
                                                        echo htmlspecialchars($date->format('d/m/Y'));
                                                    ?>
                                                </td>

                                                <td><?= htmlspecialchars($client['cpf']) ?></td>
                                                <td><?= htmlspecialchars($client['rg']) ?></td>
                                                <td><?= htmlspecialchars($client['telefone']) ?></td>

                                                <td>
                                                    <a href="/admin/clients/<?= $client['id']; ?>" class="btn btn-sm btn-info me-3">Visualizar</a>
                                                    <a href="/admin/clients/edit/<?= $client['id']; ?>" class="btn btn-sm btn-warning me-3">Editar</a>
													<a href="javascript:void(0);" class="btn btn-sm btn-danger delete-client" data-id="<?= $client['id']; ?>">Excluir</a>
												</td>
                                            </tr>
                                        <?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="overlay toggle-btn-mobile"></div>

		<div class="footer">
			<p class="mb-0">Painel Administrativo @2025</p>
		</div>
	</div>

	<script src="/assets/js/bundle.js"></script>
	
	<!--Data Tables js-->
	<script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>

	<script>
		$(document).ready(function () {
			$('#table-clients').DataTable({
                language: {
                    "sEmptyTable":   "Não foi encontrado nenhum registro",
                    "sLoadingRecords": "A carregar...",
                    "sProcessing":   "A processar...",
                    "sLengthMenu":   "Mostrar _MENU_ registros",
                    "sZeroRecords":  "Não foram encontrados resultados",
                    "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
                    "sSearch":       "Procurar:",
                    "oPaginate": {
                        "sFirst":    "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext":     "Próximo",
                        "sLast":     "Último"
                    },
                    "oAria": {
                        "sSortAscending":  ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                }
            });
		});

		$(document).on('click', '.delete-client', function () {
			const clientId = $(this).data('id');
			const row      = $(this).closest('tr');
			const table    = $('#table-clients').DataTable();

			Swal.fire({
				title: 'Tem certeza?',
				text: "Esta ação não pode ser desfeita!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Sim, excluir!',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire({
						title: 'Excluindo...',
						text: 'Por favor, aguarde',
						allowOutsideClick: false,
						didOpen: () => {
							Swal.showLoading();
						}
					});

					$.ajax({
						url: `/admin/clients/${clientId}`,
						type: 'DELETE',
						success: function (response) {
							table.row(row).remove().draw();

							Swal.fire(
								'Excluído!',
								'O cliente foi excluído com sucesso.',
								'success'
							);
						},
						error: function (xhr) {
							Swal.fire(
								'Erro!',
								'Não foi possível excluir o cliente. Tente novamente.',
								'error'
							);
						}
					});
				}
			});
		});
	</script>

	<script src="/assets/js/app.js"></script>
</body>

</html>
