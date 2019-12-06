<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Marcelo LavaJato</a>
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="<?=URL .'ControllerAuth/logout'?>">Deslogar</a>
			</li>
		</ul>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link active" href="<?=URL .'controllerPessoa/index' ?>">
								<span data-feather="home"></span>
								Principal <span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?=URL .'controllerPessoa/index' ?>">
								<span data-feather="users"></span>
								Usuários
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?=URL .'controllerCarro/index' ?>">
								<span data-feather="truck"></span>
								Carros
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?=URL .'controllerProduto/index' ?>">
								<span data-feather="shopping-cart"></span>
								Produtos
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?=URL .'controllerServico/index' ?>">
								<span data-feather="layers"></span>
								Serviço
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?=URL .'controllerTipoServico/index' ?>">
								<span data-feather="credit-card"></span>
								Tipos de Serviço
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?=URL .'controllerFuncionarios/index' ?>">
								<span data-feather="user-plus"></span>
								Funcionários
							</a>
						</li>					
					</ul>
				</div>
			</nav>