<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title> :: Tela de login :: </title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Custom styles for this template -->
    <link href="<?= URL; ?>/assets/css/signin.css" rel="stylesheet">

</head>
<body class="text-center">

	<?php

	if(isset($_SESSION['msg'])){
	echo $_SESSION['msg'];
	unset($_SESSION['msg']);
}

?>

<form method="post" class="form-signin">
	<img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
	<h1 class="h3 mb-3 font-weight-normal">Por favor, faça o login</h1>
	<label for="inputEmail" class="sr-only">E-mail:</label>
	<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
	<label for="inputPassword" class="sr-only">Senha:</label>
	<input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Password" required>
	<button class="btn btn-lg btn-primary btn-block" type="submit" name="sendLogin">Logar</button>
	<br/>
	<a class="btn btn-dark" href="<?=URL .'controller-pessoa/inserir'?>" role="button">Cadastrar</a>
	<p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>