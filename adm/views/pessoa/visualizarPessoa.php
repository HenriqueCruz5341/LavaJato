<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<br></br>
		<h1 class="h2">Visualizar Pessoas</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
			</div>
		</div>
	</div>

	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">E-mail</th>
				<th scope="col">DDD</th>
				<th scope="col">Telefone</th>
				<th scope="col">Tipo</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			extract($this->dados[0]);
			?>

			<tr>
				<th scope="row"><?= $idPessoa; ?></th>
				<td><?= $email; ?></td>
				<td><?= $ddd; ?></td>
				<td><?= $telefone; ?></td>
				<td><?= $tipo; ?></td>
			</tr>
		</tbody>
	</table>

</main>