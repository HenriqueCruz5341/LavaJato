<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<br></br>
		<h1 class="h2">Listar Pessoas</h1>
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
	$con=mysqli_connect("localhost","root","","lavajato");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sqlC = "SELECT * FROM carro";
	$sqlTP = "SELECT * FROM tipoPagamento";

	$resultC = mysqli_query($con, $sqlC);
	$resultTP = mysqli_query($con, $sqlTP);
	?>

	<form method="post" name="formEditar" action="">
		<div class="form-row">
			<div class="form-group col-auto">
				<label for="iPlaca">Placa</label>
				<select id="iCarro" name="carro" class="form-control">
					<option value = ""></option>
					<?php
					while($rowC = mysqli_fetch_array($resultC)) {
						echo '<option value='.$rowC['idCarro'].'>'.$rowC['placa'].'</option>';
					}
					?> 
				</select>
			</div>
			<div class="form-group col-auto">
				<label for="iData">Data</label>
				<input name="dataAgendada" type="date" class="form-control" id="idata" placeholder="DD/MM/AAAA" value="<?php if (isset($this->dados['dataAgendada'])) {echo $this->dados['dataAgendada'];}?>" required>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="ihora">Horário</label>
				<input name="horaInicio" type="time" class="form-control" id="ihora" placeholder="HH:MM" value="<?php if (isset($this->dados['horaInicio'])) {echo $this->dados['horaInicio'];}?>" required>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="iTipoPag">Forma de Pagamento</label>
				<select id="iTipoPag" name="tipoPagamento" class="form-control">
					<option value = ""></option>
					<?php
					while($rowTP = mysqli_fetch_array($resultTP)) {
						echo '<option value='.$rowTP['idTipoPagamento'].'>'.$rowTP['nomeTp'].'</option>';
					}
					?> 
				</select>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="ivalor">Valor Total</label>
				<input name="valorTotal" type="number" class="form-control" id="ivalor" placeholder="valor final" value="<?php if (isset($this->dados['valorTotal'])) {echo $this->dados['valorTotal'];}?>" required>
			</div>
		</div>

		<button name="enviarEditarServico" type="submit" class="btn btn-primary">Confirmar</button>
	</form>

</main>