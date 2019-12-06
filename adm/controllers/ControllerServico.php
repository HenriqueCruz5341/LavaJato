<?php

class ControllerServico{
	private $IdServ;
	private $dados;

	public function index(){
		$listarServico = new ModelsServico();
		$listarServico->listar();
		$this->dados = $listarServico->getResult();
		//echo "<pre>"
		//var_dump($this->dados);
		//echo "<pre>"
		$carregar = new ConfigView("servico/listarServico", $this->dados);
		$carregar->renderizar();
		
	}

	public function exibirServicosCli($idPessoa){
		$listarServico = new ModelsServico();
		$listarServico->listar();
		$listaServicos = $listarServico->getResult();

		$listarServico->buscarCarPes($idPessoa);
		$listaCarros = $listarServico->getResult();

		$qtd = 0;

		foreach ($listaCarros as $carro) {
			foreach ($listaServicos as $servico) {
				if ($carro['idCarro'] == $servico['carro']) {
					$listaServCli[$qtd] = $servico;
					$qtd++;
				}
			}
		}

		$carregar = new ConfigView("servico/listarServicoCliente", $listaServCli);
		$carregar->renderizar();
	}

	public function visualizar($IdServ){
		$this->IdServ = (int) $IdServ;
		$visualizarServico = new ModelsServico();
		$visualizarServico->visualizar($this->IdServ);
		$this->dados = $visualizarServico->getResult();
		$carregar = new ConfigView("servico/visualizarServico", $this->dados);
		$carregar->renderizar();
	}

	public function inserir()
	{
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset ($this->dados['enviarInserirServico'])){
			unset($this->dados['enviarInserirServico']);

			$listaTServico = $this->dados['serv'];
			var_dump($listaTServico);

			$dadosServ['carro'] = $this->dados['carro'];
			$dadosServ['dataAgendada'] = $this->dados['dataAgendada'];
			$dadosServ['horaInicio'] = $this->dados['horaInicio'];
			$dadosServ['tipoPagamento'] = $this->dados['tipoPagamento'];
			$dadosServ['valorTotal'] = $this->dados['valorTotal'];
			$inserirServico = new ModelsServico();
			$inserirServico->inserir($dadosServ);

			foreach ($listaTServico as $idTipServico) {
				$tServServ['servico'] = $inserirServico->getResult();
				$tServServ['tipoServico'] = $idTipServico;
				$inserirTservServ = new ModelsTipoServico_has_Servico();
				$inserirTservServ->inserir($tServServ);
			}
			
			$this->dados['msg'] = $inserirServico->getMsg();
			if ($inserirServico->getResult()){
				$urlDestino = URL .'ControllerServico/index';
				header("location: {$urlDestino}");
			}
		}

		$carregarView = new ConfigView("servico/inserirServico", $this->dados);
		$carregarView->renderizar();
	}

	public function inserirServicoCli($idPessoa){

		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset ($this->dados['enviarInserirServicoCliente'])){
			unset($this->dados['enviarInserirServicoCliente']);

			$listaTServico = $this->dados['serv'];

			$dadosServ['carro'] = $this->dados['carro'];
			$dadosServ['dataAgendada'] = $this->dados['dataAgendada'];
			$dadosServ['horaInicio'] = $this->dados['horaInicio'];
			$dadosServ['tipoPagamento'] = $this->dados['tipoPagamento'];
			$dadosServ['valorTotal'] = $this->dados['valorTotal'];
			$inserirServico = new ModelsServico();
			$inserirServico->inserir($dadosServ);

			foreach ($listaTServico as $idTipServico) {
				$tServServ['servico'] = $inserirServico->getResult();
				$tServServ['tipoServico'] = $idTipServico;
				$inserirTservServ = new ModelsTipoServico_has_Servico();
				$inserirTservServ->inserir($tServServ);
			}
			
			$this->dados['msg'] = $inserirServico->getMsg();
			if ($inserirServico->getResult()){
				$urlDestino = URL .'ControllerServico/exibirServicosCli/'. $_SESSION['idPessoa'];
				header("location: {$urlDestino}");
			}
		}

		$carregarView = new ConfigView("servico/inserirServicoCliente", $this->dados);
		$carregarView->renderizar();
	}

	public function editar($IdServ)	{
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset($this->dados['enviarEditarServico'])){
			unset($this->dados['enviarEditarServico']);
			$editarServico = new ModelsServico();
			$editarServico->editar($IdServ, $this->dados);
			$this->dados['msg']=$editarServico->getMsg();

			//se deu certo e o resultado é true
			if ($editarServico->getResult()){
				//redireciono o usuário para a página com os dados alteados
				$urlDestino = URL .'controller-servico/index/';
				header("location: {$urlDestino}");
			}
		} else{ //se não veio do botão enviarEditarUser
			$visualizar = new ModelsServico();
			//pego os dados do usuário para exibir no formulário
			$visualizar->visualizar($IdServ);			
			$this->dados = $visualizar->getResult();
			$this->dados = $this->dados[0];
		}

		$carregarView = new ConfigView("servico/editarServico",$this->dados);
		$carregarView->renderizar();
	}

	public function apagar($IdServ)	{
		$this->IdServ = (int) $IdServ;
		if ($this->IdServ != null) {
			$apagarNota = new ModelsTipoServico_has_Servico();
			$apagarServico = new ModelsServico();
			//chamo a função que vai apagar o usuário do BD
			$apagarNota->apagar($this->IdServ);
			$apagarServico->apagar($this->IdServ);
			//recebo a msg de sucesso ou erro
			
			//$_SESSION -> cria um arquivo temporário que é criado no servidor web para armazenar suas configurações de sessão.
			$_SESSION['msg'] = $apagarServico->getMsg();

		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
			Usuário não foi informado!
			</div>";
		}

		$dominio= $_SERVER['HTTP_HOST'];
		$url = "http://" . $dominio. $_SERVER['REQUEST_URI'];
		
		if ($url != 'http://127.0.0.1/LavaJato1/adm/ControllerServico/index') {
			$urlDestino = URL .'controller-servico/exibirServicosCli/'. $_SESSION['idPessoa'];
			header("location: {$urlDestino}");
		}else{
			$urlDestino = URL .'controller-servico/index';
			header("location: {$urlDestino}");
		}
	}
}

?>