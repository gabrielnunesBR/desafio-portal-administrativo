<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Painel Administrativo - Visualizar Cliente</title>

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
								<h4 class="mb-0">Visualizar Cliente</h4>
							</div>
							<hr/>

                            <div class="container mt-5">
                                <div class="row">
                                    <!-- Card do Cliente -->
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                Detalhes do Cliente
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Nome: <?= $client['nome'] ?></li>

                                                    <li class="list-group-item">
                                                        Data de Nascimento:
                                                        
                                                        <?php
                                                            $date = new DateTime($client['data_nascimento']);
                                                            echo htmlspecialchars($date->format('d/m/Y'));
                                                        ?>
                                                    </li>

                                                    <li class="list-group-item">
                                                        CPF:

                                                        <?php
                                                            $cpf = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $client['cpf']);
                                                            echo htmlspecialchars($cpf);
                                                        ?>
                                                    </li>

                                                    <li class="list-group-item">RG: <?= $client['rg'] ?></li>

                                                    <li class="list-group-item">
                                                        Telefone:

                                                        <?php
                                                            $telefone = preg_replace('/(\d{2})(\d{4,5})(\d{4})/', '($1) $2-$3', $client['telefone']);
                                                            echo htmlspecialchars($telefone);
                                                        ?>
                                                    </li>

                                                    <li class="list-group-item">
                                                        Data de Criação:

                                                        <?php
                                                            $date = new DateTime($client['created_at']);
                                                            echo htmlspecialchars($date->format('d/m/Y H:i:s'));
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <!-- Cards dos Endereços -->

                                    <?php foreach ($client['enderecos'] as $key => $address): ?>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    Endereço <?= $key + 1 ?>
                                                </div>

                                                <div class="card-body">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            CEP:

                                                            <?php
                                                                $cep = preg_replace('/(\d{5})(\d{3})/', '$1-$2', $address['cep']);
                                                                echo htmlspecialchars($cep);
                                                            ?>
                                                        </li>

                                                        <li class="list-group-item">Rua: <?= $address['logradouro'] ?></li>
                                                        <li class="list-group-item">Número: <?= $address['numero'] ?></li>
                                                        <li class="list-group-item">Complemento: <?= $address['complemento'] ?></li>
                                                        <li class="list-group-item">Bairro: <?= $address['bairro'] ?></li>
                                                        <li class="list-group-item">Cidade: <?= $address['cidade'] ?></li>
                                                        <li class="list-group-item">Estado: <?= $address['estado'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
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

	<script src="/assets/js/app.js"></script>
</body>

</html>
