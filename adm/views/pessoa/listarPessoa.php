<main role="main" class="col-md-auto">
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

	<a class="btn btn-dark" role="button" href="<?=URL .'controller-pessoa/buscar'?>">Search</a>
	<br/>

	<br/>


	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">E-mail</th>
				<th scope="col">DDD</th>
				<th scope="col">Telefone</th>
				<th scope="col">Tipo</th>
				<th scope="col">Ações</th>
			</tr>
		</thead>
		<tbody>

			<?php
			foreach ($this->dados as $linha) {
				extract($linha);?>
				<tr>
					<th scope="row"><?= $idPessoa; ?></th>
					<td><?= $email; ?></td>
					<td><?= $ddd; ?></td>
					<td><?= $telefone; ?></td>
					<td><?php switch ($tipo) {
						case '0':
						echo('Administrador');
						break;
						case '1':
						echo('Física');
						break;

						case '2':
						echo('Jurídica');
						break;

						case '3':
						echo('Fornecedor');
						break;

						default:
							# code...
						break;
					}; 

					?></td>
					<td>
						<a class="btn btn-dark" href="<?= URL; ?>controller-pessoa/visualizar/<?= $idPessoa;?>" role="button">Visualizar</a>
						<a class="btn btn-warning" href="<?= URL; ?>controller-pessoa/editar/<?= $idPessoa;?>" role="button">Editar</a>
						<a class="btn btn-danger" href="<?= URL; ?>controller-pessoa/apagar/<?= $idPessoa;?>" role="button">Apagar</a>
					</td>
					</tr><?php
				}
				?>
			</tbody>
		</table>

		<a class="btn btn-dark" href="<?=URL .'controller-pessoa/inserir'?>" role="button">Inserir</a>

</main>