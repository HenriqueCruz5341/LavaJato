<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<br></br>
		<h1 class="h2">Inserir Carro</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
			</div>
		</div>

		<?php
		if (isset($this->dados['msg'])) {
			echo $this->dados['msg'];
		}

		?>

	</div>
	<?php
	$listarPessoa = new ModelsCarro();
	$listarPessoa->listarPessoa();
	$dono = $listarPessoa->getResult();
	?>

	<form method="post" name="formCadastro" action="">
		<div class="form-row">
			<div class="form-group col-auto">
				<label for="iPlaca">Placa</label>
				<input name="placa" type="text" class="form-control" id="iPlaca" data-mask="SSS-9999" placeholder="Placa do Veículo" minlength="8" maxlength="8" values="<?php if (isset($this->dados['placa'])) {echo $this->dados['placa'];}?>" required>
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

		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="iDono">Dono</label>
				<select id="ipessoa" name="pessoa" class="form-control">
					<option value = "" selected disabled>Selecione uma Opção</option>
					<?php
					foreach($dono as $linha) {
						echo '<option value='.$linha['idPessoa'].'>'.$linha['email'].'</option>';
					}
					?> 
				</select>
			</div>
		</div>
		

		<button name="enviarInserirCarro" type="submit" class="btn btn-primary">Cadastrar</button>
	</form>

	<?php 

	?>

	
</main>