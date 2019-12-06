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
	$listarPessoa = new ModelsProduto();
	$listarPessoa->listarPessoa();
	$fornecedor = $listarPessoa->getResult();
	?>

	<form method="post" name="formCadastro" action="">
		<div class="form-row">
			<div class="form-group col-auto">
				<label for="iNomeP">Nome</label>
				<input name="nomeProduto" type="text" class="form-control" id="iNomeProduto" placeholder="Nome do produto" values="<?php if (isset($this->dados['nomeProduto'])) {echo $this->dados['nomeProduto'];}?>" required>
			</div>
			<div class="form-group col-auto">
				<label for="iForn">Fornecedor</label>
				<select id="iForn" name="pessoa" class="form-control">
					<option value = "" selected disabled>Selecione uma Opção</option>
					<?php
					foreach($fornecedor as $linha) {
						echo '<option value='.$linha['idPessoa'].'>'.$linha['email'].'</option>';
					}
					?>
				</select>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="iModel">Marca</label>
				<input name="marca" type="text" class="form-control" id="iMarca" placeholder="Marca" values="<?php if (isset($this->dados['marca'])) {echo $this->dados['marca'];}?>" required>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="ipreco">Preco</label>
				<input name="preco" type="number" class="form-control" id="ipreco" placeholder="Preco" values="<?php if (isset($this->dados['preco'])) {echo $this->dados['preco'];}?>" required>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="iQuantidade">Quantidade em Estoque</label>
				<input name="quantidade" type="number" class="form-control" id="iQuantidade" placeholder="Quantidade" values="<?php if (isset($this->dados['quantidade'])) {echo $this->dados['quantidade'];}?>" required>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="iQtdM">Quantidade Mínima</label>
				<input name="qtdMin" type="number" class="form-control" id="iQtdMin" placeholder="Quantidade Mínima" values="<?php if (isset($this->dados['qtdMin'])) {echo $this->dados['qtdMin'];}?>" required>
			</div>
		</div>
		
		<button name="enviarInserirProduto" type="submit" class="btn btn-primary">Cadastrar</button>
	</form>

	<?php 

	?>

</main>