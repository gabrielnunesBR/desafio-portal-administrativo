<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Painel Administrativo - Adicionar Cliente</title>

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
								<h4 class="mb-0">Adicionar Cliente</h4>
							</div>

							<hr/>

							<form id="clientForm" class="row g-3">
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
												<label for="inputDataNascimento" class="col-sm-3 col-form-label">Data de Nascimento</label>
												<div class="col-sm-9">
													<input type="date" class="form-control" id="inputDataNascimento" placeholder="Data de Nascimento" min="1900-01-01" max="2100-12-31" required>
												</div>
											</div>

											<div class="row mb-3">
												<label for="inputCpf" class="col-sm-3 col-form-label">CPF</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="inputCpf" placeholder="CPF" required>
												</div>
											</div>

											<div class="row mb-3">
												<label for="inputRg" class="col-sm-3 col-form-label">RG</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="inputRg" maxlength="20" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
												</div>
											</div>

											<div class="row mb-3">
												<label for="inputTelefone" class="col-sm-3 col-form-label">Telefone</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="inputTelefone" placeholder="Telefone" required>
												</div>
											</div>

											<div class="row mb-3"></div>
											<div class="row mb-3"></div>

											<div class="row">
												<div class="card-title d-flex justify-content-between">
													<h4 class="mb-0">Endereços</h4>
													<button type="button"class="btn btn-info add-address">Adicionar Endereço</button>
												</div>

												<div class="accordion" id="addressAccordion">
													<div class="accordion-item">
														<h2 class="accordion-header">
															<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
																Endereço 1
															</button>
														</h2>
														<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#addressAccordion">
															<div class="accordion-body">

																<div class="mb-3">
																	<label for="cep1" class="form-label">CEP</label>
																	<input type="text" class="form-control" id="cep1" required>
																</div>

																<div class="mb-3">
																	<label for="logradouro1" class="form-label">Logradouro</label>
																	<input type="text" class="form-control" id="logradouro1" maxlength="255" required>
																</div>

																<div class="mb-3">
																	<label for="numero1" class="form-label">Número</label>
																	<input type="text" class="form-control" id="numero1" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
																</div>

																<div class="mb-3">
																	<label for="complemento1" class="form-label">Complemento</label>
																	<input type="text" class="form-control" id="complemento1" maxlength="255">
																</div>

																<div class="mb-3">
																	<label for="bairro1" class="form-label">Bairro</label>
																	<input type="text" class="form-control" id="bairro1" maxlength="255" required>
																</div>

																<div class="mb-3">
																	<label for="cidade1" class="form-label">Cidade</label>
																	<input type="text" class="form-control" id="cidade1" maxlength="255" required>
																</div>

																<div class="mb-3">
																	<label for="estado1" class="form-label">Estado</label>
																	<input type="text" class="form-control" id="estado1" maxlength="2" required>
																</div>

																<button type="button" class="btn btn-danger remove-address">Remover Endereço</button>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="row mb-3"></div>
											<div class="row mb-3"></div>

											<div class="row mt-6"> 
												<div> 
													<button type="submit" class="btn btn-primary">Cadastrar</button>
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
	</div>

	<script src="/assets/js/bundle.js"></script>

	<script>
		$(document).ready(function () {

			const applyMask = (selector, mask) => {
				Inputmask(mask, { placeholder: '_' }).mask(selector);
			};

			applyMask('#inputCpf', '999.999.999-99');
			applyMask('#inputTelefone', '(99) 99999-9999');

			const applyCepMask = (id) => applyMask(`#cep${id}`, '99999-999');
			applyCepMask(1);

			const fetchCepData = (cep, addressId) => {
				Swal.fire({
					title: 'Carregando...',
					text: 'Buscando informações do CEP...',
					allowOutsideClick: false,
					didOpen: () => Swal.showLoading()
				});

				$.ajax({
					url: `https://viacep.com.br/ws/${cep}/json/`,
					method: 'GET',
					dataType: 'json',
					success: function (data) {
						if (data.erro) {
							Swal.fire({ icon: 'error', title: 'Erro', text: 'CEP não encontrado.' });
						} else {
							$(`#logradouro${addressId}`).val(data.logradouro);
							$(`#bairro${addressId}`).val(data.bairro);
							$(`#cidade${addressId}`).val(data.localidade);
							$(`#estado${addressId}`).val(data.uf);
							Swal.close();
						}
					},
					error: function () {
						Swal.fire({ icon: 'error', title: 'Erro', text: 'Ocorreu um erro ao buscar o CEP.' });
					}
				});
			};

			$(document).on('blur', 'input[id^="cep"]', function () {
				const cep = $(this).val().replace(/\D/g, '');
				if (cep.length === 8) {
					const addressId = $(this).attr('id').replace('cep', '');
					fetchCepData(cep, addressId);
				}
			});

			const addressAccordion = $('#addressAccordion');
			let addressCount = 1;

			const createAddressItem = (index) => {
				return `
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
								data-bs-target="#collapse${index}" aria-expanded="false" aria-controls="collapse${index}">
								Endereço ${index}
							</button>
						</h2>
						<div id="collapse${index}" class="accordion-collapse collapse" data-bs-parent="#addressAccordion">
							<div class="accordion-body">
								${generateAddressForm(index)}
								<button type="button" class="btn btn-danger remove-address">Remover Endereço</button>
							</div>
						</div>
					</div>
				`;
			};

			const generateAddressForm = (index) => {
				const fields = [
					{ label: 'CEP', id: `cep${index}`, type: 'text', required: true },
					{ label: 'Logradouro', id: `logradouro${index}`, type: 'text', required: true },
					{ label: 'Número', id: `numero${index}`, type: 'text', required: true, extra: "oninput=\"this.value=this.value.replace(/[^0-9]/g,'')\"" },
					{ label: 'Complemento', id: `complemento${index}`, type: 'text' },
					{ label: 'Bairro', id: `bairro${index}`, type: 'text', required: true },
					{ label: 'Cidade', id: `cidade${index}`, type: 'text', required: true },
					{ label: 'Estado', id: `estado${index}`, type: 'text', required: true, extra: 'maxlength="2"' },
				];

				return fields.map(field => `
					<div class="mb-3">
						<label for="${field.id}" class="form-label">${field.label}</label>
						<input type="${field.type}" class="form-control" id="${field.id}" ${field.required ? 'required' : ''} ${field.extra || ''}>
					</div>
				`).join('');
			};

			const addAddress = () => {
				addressCount++;
				addressAccordion.append(createAddressItem(addressCount));
				applyCepMask(addressCount);
			};

			const removeAddress = (event) => {
				$(event.target).closest('.accordion-item').remove();
				addressCount--;
				reindexAddresses();
			};

			const reindexAddresses = () => {
				addressAccordion.children().each((index, item) => {
					const newIndex = index + 1;
					$(item).find('.accordion-header button').text(`Endereço ${newIndex}`)
						.attr('data-bs-target', `#collapse${newIndex}`)
						.attr('aria-controls', `collapse${newIndex}`);
					$(item).find('.accordion-collapse').attr('id', `collapse${newIndex}`);
				});
			};

			$('.add-address').on('click', addAddress);
			$(document).on('click', '.remove-address', removeAddress);

			$('#clientForm').on('submit', function (e) {
				e.preventDefault();

				const clientData = {
					nome: $('#inputNome').val(),
					data_nascimento: $('#inputDataNascimento').val(),
					cpf: $('#inputCpf').val(),
					rg: $('#inputRg').val(),
					telefone: $('#inputTelefone').val(),
					enderecos: []
				};

				$('.accordion-item').each(function () {
					const endereco = {
						cep: $(this).find('input[id^="cep"]').val(),
						logradouro: $(this).find('input[id^="logradouro"]').val(),
						numero: $(this).find('input[id^="numero"]').val(),
						complemento: $(this).find('input[id^="complemento"]').val(),
						bairro: $(this).find('input[id^="bairro"]').val(),
						cidade: $(this).find('input[id^="cidade"]').val(),
						estado: $(this).find('input[id^="estado"]').val()
					};
					clientData.enderecos.push(endereco);
				});

				$.ajax({
					url: '/admin/clients/store',
					method: 'POST',
					data: clientData,
					dataType: 'json',
					success: function (response) {
						Swal.fire({
							icon: 'success',
							title: 'Sucesso!',
							text: response.message || 'Cliente cadastrado com sucesso.',
							confirmButtonText: 'Ok'
						}).then(() => window.location.reload());
					},
					error: function (xhr) {
						Swal.fire({
							icon: 'error',
							title: 'Erro!',
							text: xhr.responseJSON?.error || 'Ocorreu um erro ao cadastrar o cliente.',
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

	<script src="/assets/js/app.js"></script>
</body>

</html>
