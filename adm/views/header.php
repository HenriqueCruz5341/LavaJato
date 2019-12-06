<!doctype html>
<html lang="pt-br" style="height:100%;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author">

	<title>Projeto PW_4ano</title>

	<!-- Bootstrap core CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= URL .'assets/css/telaIndex.css' ?>">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>

<body style="height:100%;">

	<div class="geral">

		<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
			<div class="container">
				<a class="navbar-brand" href="<?=URL .'ControllerHome/index'?>">Marcelo Lava-Jato</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="#">Sobre nós</a>
						</li>
						<?php
						if(isset($_SESSION['idPessoa']) && $_SESSION['tipo'] = 1){?>
							<li class="nav-item">
								<a class="nav-link" href="<?=URL?>ControllerServico/exibirServicosCli/<?=$_SESSION['idPessoa']?>">Serviços</a>
								</li><?php
							}else{?>
								<li class="nav-item">
									<a class="nav-link" href="<?=URL?>ControllerServico/index">Serviços</a>
									</li><?php

								}?>						
								<li class="nav-item">
									<a class="nav-link" href="https://blackrockdigital.github.io/startbootstrap-modern-business/contact.html">Contact</a>
								</li>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="https://blackrockdigital.github.io/startbootstrap-modern-business/index.html#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Portfolio
									</a>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
										<a class="dropdown-item" href="https://blackrockdigital.github.io/startbootstrap-modern-business/portfolio-1-col.html">1 Column Portfolio</a>
										<a class="dropdown-item" href="https://blackrockdigital.github.io/startbootstrap-modern-business/portfolio-2-col.html">2 Column Portfolio</a>
										<a class="dropdown-item" href="https://blackrockdigital.github.io/startbootstrap-modern-business/portfolio-3-col.html">3 Column Portfolio</a>
										<a class="dropdown-item" href="https://blackrockdigital.github.io/startbootstrap-modern-business/portfolio-4-col.html">4 Column Portfolio</a>
										<a class="dropdown-item" href="https://blackrockdigital.github.io/startbootstrap-modern-business/portfolio-item.html">Single Portfolio Item</a>
									</div>
								</li>
								<?php
								if(isset($_SESSION['idPessoa'])){?>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Minha conta
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdown">
											<a class="dropdown-item" href="<?=URL .'ControllerHome/perfil'?>">Perfil</a>
											<a class="dropdown-item" href="<?=URL .'ControllerAuth/logout'?>">Sair</a>
										</div>
									</li>
									<?php
								}else{?>
									<li class="nav-item">
										<a class="nav-link" href="<?=URL .'ControllerAuth/auth'?>">Entrar</a>
									</li>
									<?php
								}?>
							</ul>
						</div>
					</div>
				</nav>

				<?php
				var_dump($_SESSION);
				?>

				<div class="container" id="geral">
					<div class="row">