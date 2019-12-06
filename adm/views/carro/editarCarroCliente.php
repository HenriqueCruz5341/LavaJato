<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<br></br>
		<h1 class="h2">Editar Carro</h1>
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
	$listarDono = new ModelsCarro();
	$listarDono->listarPessoa();
	$dono = $listarDono->getResult();
	//var_dump($dono);
	?>

	<script type="text/javascript">
		function formatar(mascara, documento){
			var i = documento.value.length;
			var saida = mascara.substring(0,1);
			var texto = mascara.substring(i)

			if (texto.substring(0,1) != saida){
				documento.value += texto.substring(0,1);
			}
		}
	</script>

	<form method="post" name="formEditar" action="">
		<div class="form-row">
			<div class="form-group col-auto">
				<label for="iPlaca">Placa</label>
				<input name="placa" type="text" OnKeyPress="formatar('###-####', this)" data-mask="SSS-9999" class="form-control" id="iPlaca" placeholder="Placa do Veículo" minlength="8" maxlength="8" value="<?php if (isset($this->dados['placa'])) {echo $this->dados['placa'];}?>" required>
			</div>
			<div class="form-group col-auto">
				<label for="iCor">Cor</label>
				<input name="cor" type="text" class="form-control" id="iCor" placeholder="Cor do veículo" value="<?php if (isset($this->dados['cor'])) {echo $this->dados['cor'];}?>" required>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="iModel">Modelo</label>
				<input name="modelo" type="text" class="form-control" id="iModel" placeholder="Modelo do veículo" value="<?php if (isset($this->dados['modelo'])) {echo $this->dados['modelo'];}?>" required>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="iPessoa">Dono</label>
				<select id="iPessoa" name="pessoa" class="form-control" readonly>
						<?php 
						echo '<option value='.$_SESSION['idPessoa'].'>'.$_SESSION['email'].'</option>';
						?> 
					</select>
				</div>
			</div>

			<button name="enviarEditarCarroCliente" type="submit" class="btn btn-primary">Confirmar</button>
		</form>

	</main>