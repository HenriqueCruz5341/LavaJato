<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title> :: Marcelo Lava-Jato :: </title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<?php

	require ("config/Config.php");
	$teste = new ConfigController();
	$teste->carregar();
	//$conn = new ModelsConn();
	//$conn->getConn();
	//$view = new ConfigView("users/listarUsers");
	//$view->renderizar();

		//require ("config/config.php");
		//$users = new ControllerUsers();
		//$users -> inserir();

	//print_r($_GET['url']);
	?>


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>