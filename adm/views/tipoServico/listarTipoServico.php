<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<br></br>
		<h1 class="h2">Listar Tipos de Serviço</h1>
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
				<th scope="col">Nome</th>
				<th scope="col">Descrição</th>
				<th scope="col">Valor</th>
				<th scope="col">Ações</th>
			</tr>
		</thead>
		<tbody>

			<?php
			foreach ($this->dados as $linha) {
				extract($linha);
				?>
				<tr>
					<th scope="row"><?= $idTipoServico; ?></th>
					<td><?= $nomeTs; ?></td>
					<td><?= $descricao; ?></td>
					<td><?= $valor; ?></td>
					<td>
						<a class="btn btn-dark" href="<?= URL; ?>controller-tipo-servico/visualizar/<?= $idTipoServico;?>" role="button">Visualizar</a>
						<a class="btn btn-warning" href="<?= URL; ?>controller-tipo-servico/editar/<?= $idTipoServico;?>" role="button">Editar</a>
						<a class="btn btn-danger" href="<?= URL; ?>controller-tipo-servico/apagar/<?= $idTipoServico;?>" role="button">Apagar</a>
					</td>
					</tr><?php
				}
				?>
			</tbody>
		</table>

		<a class="btn btn-dark" href="<?=URL .'controller-tipo-servico/inserir'?>" role="button">Inserir</a>

	</main>