	<main>

		<div class="container" style="padding-top: 50px;">

			
			<h1 class="mt-4 mb-3">
				Meu Perfil
			</h1>

			<div style="padding-bottom: 50px;">
				<img width="10%" height="10%" class="img-fluid" src="<?=URL .'assets/img/perfil.png' ?>" alt="" align="left">
				<?php
				$pessoa = new ModelsPessoa();
				$pessoa->visualizar($_SESSION['idPessoa']);
				$dadosPessoa = $pessoa->getResult();

				$idPessoa = $_SESSION['idPessoa'];

				$pessoaFisica = new ModelsFisica();
				$pessoaFisica->visualizar($_SESSION['idPessoa']);
				$dadosPessoaFis = $pessoaFisica->getResult();

				$listaRua = new ModelsPessoa();
				$listaRua->listarRua();
				$ruas = $listaRua->getResult();

				foreach($ruas as $linha) {
					if($dadosPessoa[0]['rua'] == $linha['idRua']){
						$nameRua = $linha['nomeRua'];
						break;
					}
				}

				echo('<b>Nome: </b>' .$dadosPessoaFis[0]['nomeFisica'] .'<br/>');
				echo('<b>Telefone: </b>(' .$dadosPessoa[0]['ddd'].  ') '.$dadosPessoa[0]['telefone'] .'<br/>');
				echo('<b>Endereço: </b>' .$nameRua. ', ' .$dadosPessoa[0]['numeroCasa'] .'<br/>');
				?>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<a href="<?= URL; ?>controller-pessoa/editar/<?= $idPessoa;?>"><img class="img-fluid rounded mb-4" src="http://placehold.it/750x450" alt=""></a>
				</div>
				<div class="col-lg-6">
					<a href="<?= URL; ?>controller-carro/exibirCarrosCli/<?= $idPessoa;?>"><img class="img-fluid rounded mb-4" src="http://placehold.it/750x450" alt=""></a>
				</div>
			</div>



		</div>

	</main>