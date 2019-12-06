<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<br></br>
		<h1 class="h2">Listar Pessoas</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
			</div>
		</div>

		<?php

		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}

		?>
	</div>

	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Produto</th>
				<th scope="col">Marca</th>
				<th scope="col">Fornecedor</th>
				<th scope="col">Preço</th>
				<th scope="col">Quantidade</th>
				<th scope="col">Ações</th>
			</tr>
		</thead>
		<tbody>

			<?php
			foreach ($this->dados as $linha) {
				extract($linha);?>
				<tr>
					<th scope="row"><?= $idProduto; ?></th>
					<td><?= $nomeProduto; ?></td>
					<td><?= $marca; ?></td>
					<td><?= $email; ?></td>
					<td><?= $preco; ?></td>
					<td><?= $quantidade; ?></td>
					<td>
						<a class="btn btn-dark" href="<?= URL; ?>controller-produto/visualizar/<?= $idProduto;?>" role="button">Visualizar</a>
						<a class="btn btn-warning" href="<?= URL; ?>controller-produto/editar/<?= $idProduto;?>" role="button">Editar</a>
						<a class="btn btn-danger" href="<?= URL; ?>controller-produto/apagar/<?= $idProduto;?>" role="button">Apagar</a>
					</td>
					</tr><?php
				}
				?>
			</tbody>
		</table>

		<a class="btn btn-dark" href="<?=URL .'controller-produto/inserir'?>" role="button">Inserir</a>

	</main>