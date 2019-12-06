<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<br></br>
		<h1 class="h2">Seus Serviços</h1>
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
				<th scope="col">Data Agendada</th>
				<th scope="col">Horário de Início</th>
				<th scope="col">Horário de Término</th>
				<th scope="col">Valor</th>
				<th scope="col">Placa do Carro</th>
				<th scope="col">Ações</th>
			</tr>
		</thead>
		<tbody>

			<?php
			if(isset($this->dados)){
				foreach ($this->dados as $linha) {
					extract($linha);?>
					<tr>
						<th scope="row"><?= $idServico; ?></th>
						<td><?= $dataAgendada; ?></td>
						<td><?= $horaInicio; ?></td>
						<td><?= $horaFim; ?></td>
						<td><?= $valorTotal; ?></td>
						<td><?= $carro; ?></td>
						<td>
							<a class="btn btn-dark" href="<?= URL; ?>controller-servico/visualizar/<?= $idServico;?>" role="button">Visualizar</a>
							<a class="btn btn-warning" href="<?= URL; ?>controller-servico/editar/<?= $idServico;?>" role="button">Editar</a>
							<a class="btn btn-danger" href="<?= URL; ?>controller-servico/apagar/<?= $idServico;?>" role="button">Apagar</a>
						</td>
						</tr><?php
					}
				}else{
					?>
				</tbody>
			</table>
			<?php
			echo "<div class='alert alert-primary' role='alert'>
			Você não possui serviços agendados
			</div>";
		}
		?>
		<a class="btn btn-dark" href="<?=URL .'controller-servico/inserirServicoCli'?>" role="button">Agendar</a>

	</main>