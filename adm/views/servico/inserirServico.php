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
	$listarPagamento = new ModelsServico();
	$listarPagamento->listarTPagamento();
	$pagamento = $listarPagamento->getResult();

	$listarCarro = new ModelsServico();
	$listarCarro->listarCarro();
	$carros = $listarCarro->getResult();

	$listarTServico = new ModelsServico();
	$listarTServico->listarTServico();
	$tservicos = $listarTServico->getResult();
	?>

	<form method="post" name="formCadastro" action="">
		<div class="form-row">
			<div class="form-group col-auto">
				<label for="icarro">Carro</label>
				<select id="icarro" name="carro" class="form-control">
					<option value = "" selected disabled>Selecione uma opção</option>
					<?php
					foreach($carros as $linha) {
						echo '<option value='.$linha['idCarro'].'>'.$linha['placa'].'</option>';
					}
					?> 
				</select>
			</div>
			<div class="form-group col-auto">
				<label for="iData">Data</label>
				<input name="dataAgendada" type="date" class="form-control" id="idata" placeholder="DD/MM/AAAA" values="<?php if (isset($this->dados['dataAgendada'])) {echo $this->dados['dataAgendada'];}?>" required>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="ihora">Horário</label>
				<input name="horaInicio" type="time" class="form-control" id="ihora" placeholder="HH:MM" values="<?php if (isset($this->dados['horaInicio'])) {echo $this->dados['horaInicio'];}?>" required>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="iTipoPag">Forma de Pagamento</label>
				<select id="iTipoPag" name="tipoPagamento" class="form-control">
					<option value = "" selected disabled>Selecione uma opção</option>
					<?php
					foreach($pagamento as $linha) {
						echo '<option value='.$linha['idTipoPagamento'].'>'.$linha['nomeTp'].'</option>';
					}
					?> 
				</select>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="ivalor">Valor Total</label>
				<input name="valorTotal" type="number" class="form-control" id="ivalor" placeholder="Valor final" value="<?php if (isset($this->dados['valorTotal'])) {echo $this->dados['valorTotal'];}?>" required>
			</div>
		</div>
		

		<div class="form-row">
			<div class="form-group col-md-3">
				<fieldset>
					<legend>Serviços</legend>
					<?php
					foreach($tservicos as $linha) {?>
					<?= $linha['nomeTs'] ?>
					<input name="serv[]" type="checkbox" class="form-control" id="iserv[]" value="<?= $linha['idTipoServico'] ?>" />					
					<?php }
					?>
				</fieldset>
			</div>
		</div>

		<button name="enviarInserirServico" type="submit" class="btn btn-primary">Cadastrar</button>
	</form>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>

<script type="text/javascript">

	function addTipoServico(texto){
		var tipoServico = document.getElementById("listTipoServico");
		var novoTipoServico = document.createElement("li");		
		novoTipoServico.innerHTML = texto;
		tipoServico.appendChild(novoTipoServico);

		var phpNovoTipoServico = document.createElement("input");
		phpNovoTipoServico.setAttribute('name')

	}

	function remTipoServico(texto){
		var tipoServico = document.getElementById("listTipoServico");
		var tam = tipoServico.childElementCount;
		var i;
		var node;

		for (i = 0; i < tam; i++){        
			if (tipoServico.children[i].innerHTML == texto){
				node = document.getElementById("listTipoServico").children[i];
				if (node.parentNode) {
					node.parentNode.removeChild(node);
				}
				break;
			}
		}    
	}

</script>

</main>