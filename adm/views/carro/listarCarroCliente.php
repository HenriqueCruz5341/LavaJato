<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<br></br>
		<h1 class="h2">Seus Carros</h1>
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
				<th scope="col">Modelo</th>
				<th scope="col">Placa</th>
				<th scope="col">Cor</th>
				<th scope="col">Dono</th>
				<th scope="col">Ações</th>
			</tr>
		</thead>
		<tbody>

			<?php
			foreach ($this->dados as $linha) {
				extract($linha);?>
				<tr>
					<th scope="row"><?= $idCarro; ?></th>
					<td><?= $modelo; ?></td>
					<td><?= $placa; ?></td>
					<td><?= $cor; ?></td>
					<td><?= $email; ?></td>
					<td>
						<a class="btn btn-dark" href="<?= URL; ?>controller-carro/visualizar/<?= $idCarro;?>" role="button">Visualizar</a>
						<a class="btn btn-warning" href="<?= URL; ?>controller-carro/editarCarroCli/<?= $idCarro;?>" role="button">Editar</a>
						<a class="btn btn-danger" href="<?= URL; ?>controller-carro/apagar/<?= $idCarro;?>" role="button">Apagar</a>
					</td>
					</tr><?php
				}
				?>
			</tbody>
		</table>

		<a class="btn btn-dark" href="<?=URL .'controller-carro/inserirCarroCli'?>" role="button">Inserir</a>

	</main>