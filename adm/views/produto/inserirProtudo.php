<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title> :: Tipo Servico:: </title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=URL .'controller-carro/index'?>">ControllerCarro</a></li>
			<li class="breadcrumb-item"><a href="">Inserir</a></li>
			<li class="breadcrumb-item active" aria-current="page">InserirCarro</li>
		</ol>
	</nav>

	<?php
	if (isset($this->dados['msg'])) {
		echo $this->dados['msg'];
	}
	?>

	<?php
	$con=mysqli_connect("localhost","root","","lavajato");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql = "SELECT * FROM pessoa";
	$result = mysqli_query($con, $sql);
	?>

	<form method="post" name="formCadastro" action="">
		<div class="form-row">
			<div class="form-group col-auto">
				<label for="iPlaca">Placa</label>
				<input name="placa" type="text" class="form-control" id="iPlaca" placeholder="Placa do Veículo" values="<?php if (isset($this->dados['placa'])) {echo $this->dados['placa'];}?>" required>
			</div>
			<div class="form-group col-auto">
				<label for="iCor">Cor</label>
				<input name="cor" type="text" class="form-control" id="iCor" placeholder="Cor do veículo" values="<?php if (isset($this->dados['cor'])) {echo $this->dados['cor'];}?>" required>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="iModel">Modelo</label>
				<input name="modelo" type="text" class="form-control" id="iModel" placeholder="Modelo do veículo" values="<?php if (isset($this->dados['modelo'])) {echo $this->dados['modelo'];}?>" required>
			</div>
		</div>

		<!--<div class="form-row">
			<div class="form-group col-md-3">
				<label for="iPessoa">Dono</label>
				<select class="form-control" name="pessoa" id="iPessoa">
					<option label="Pablo" value="<?php if (isset($this->dados['pessoa'])) {echo $this->dados['pessoa'];}?>"></option>
				</select>
			</div>
		</div>-->
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="iModel">Dono</label>
				<select id="ipessoa" name="pessoa">
					<option value = "" selected disabled>Selecione uma Opção</option>
					<?php
					while($row = mysqli_fetch_array($result)) {
						echo '<option value='.$row['idPessoa'].'>'.$row['email'].'</option>';
					}
					?> 
				</select>
			</div>
		</div>
		

		<button name="enviarInserirCarro" type="submit" class="btn btn-primary">Cadastrar</button>
	</form>

	<?php 

	?>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>