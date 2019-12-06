<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<br></br>
		<h1 class="h2">Listar Pessoas</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
			</div>
		</div>
	</div>



	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Fornecedor</th>
				<th scope="col">Produto</th>
				<th scope="col">Marca</th>
				<th scope="col">Preco</th>
				<th scope="col">Quantidade em Estoque</th>
				<th scope="col">Quantidade Mínima</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			extract($this->dados[0]);
			?>

			<tr>
				<th scope="row"><?= $idProduto; ?></th>
				<td><?= $email; ?></td>
				<td><?= $nomeProduto; ?></td>
				<td><?= $marca; ?></td>
				<td><?= $preco; ?></td>
				<td><?= $quantidade; ?></td>
				<td><?= $qtdMin; ?></td>
			</tr>
		</tbody>
	</table>

</main>