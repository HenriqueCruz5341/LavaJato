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

	<form method="post" name="formEditar" action="">
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="iNomeTS">Nome: </label>
				<input name="nomeTs" type="text" class="form-control" id="iNomeTS" placeholder="Nome do serviço" value="<?php if (isset($this->dados['nomeTs'])) {echo $this->dados['nomeTs'];}?>">
			</div>
			<div class="form-group col-md-1">
				<label for="iValor">Valor: </label>
				<input name="valor" type="number" class="form-control" id="iValor" min="0" max="999" step="1" value="<?php if (isset($this->dados['valor'])) {echo $this->dados['valor'];}?>">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="iDescricao">Descrição: </label>
				<input name="descricao" type="text" class="form-control" id="iDescricao" placeholder="Descrição do serviço" value="<?php if (isset($this->dados['descricao'])) {echo $this->dados['descricao'];}?>">
			</div>
		</div>

		<button name="enviarEditarTipoServico" type="submit" class="btn btn-primary">Confirmar</button>
	</form>

</main>