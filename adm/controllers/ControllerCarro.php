<?php

class ControllerCarro{
	private $IdCar;
	private $dados;
	private $listCarros;

	public function index(){
		$listarCarro = new ModelsCarro();
		$listarCarro->listarComPessoa();
		$this->dados = $listarCarro->getResult();
		//echo "<pre>"
		//var_dump($this->dados);
		//echo "<pre>"
		$carregar = new ConfigView("carro/listarCarro", $this->dados);
		$carregar->renderizar();
		
	}

	public function exibirCarrosCli($idPessoa){
		$listarCarro = new ModelsCarro();
		$listarCarro->listarComPessoa();
		$this->dados = $listarCarro->getResult();
		$qtd = 0;

		foreach ($this->dados as $carro) {
			if ($carro['idPessoa'] == $idPessoa) {
				$this->listCarros[$qtd] = $carro;
				$qtd++;
			}
		}

		$carregar = new ConfigView("carro/listarCarroCliente", $this->listCarros);
		$carregar->renderizar();
	}

	public function visualizar($IdCar){
		$this->IdCar = (int) $IdCar;
		$visualizarCarro = new ModelsCarro();
		$visualizarCarro->visualizarComPessoa($this->IdCar);
		$this->dados = $visualizarCarro->getResult();
		$carregar = new ConfigView("carro/visualizarCarro", $this->dados);
		$carregar->renderizar();
	}

	public function inserir()
	{
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset ($this->dados['enviarInserirCarro'])){
			unset($this->dados['enviarInserirCarro']);
			$inserirCarro = new ModelsCarro();
			$inserirCarro->inserir($this->dados);
			$this->dados['msg'] = $inserirCarro->getMsg();
			if ($inserirCarro->getResult()){
				$urlDestino = URL .'ControllerCarro/index';
				header("location: {$urlDestino}");
			}
		}

		$carregarView = new ConfigView("carro/inserirCarro", $this->dados);
		$carregarView->renderizar();
	}

	public function inserirCarroCli()
	{
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset ($this->dados['enviarInserirCarroCliente'])){
			unset($this->dados['enviarInserirCarroCliente']);
			$inserirCarro = new ModelsCarro();
			$inserirCarro->inserir($this->dados);
			$this->dados['msg'] = $inserirCarro->getMsg();
			if ($inserirCarro->getResult()){
				$urlDestino = URL .'ControllerCarro/exibirCarrosCli/'. $_SESSION['idPessoa'];
				header("location: {$urlDestino}");
			}
		}

		$carregarView = new ConfigView("carro/inserirCarroCliente", $this->dados);
		$carregarView->renderizar();
	}

	public function editar($IdCar)	{
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset($this->dados['enviarEditarCarro'])){
			unset($this->dados['enviarEditarCarro']);
			$editarCarro = new ModelsCarro();
			$editarCarro->editar($IdCar, $this->dados);
			$this->dados['msg']=$editarCarro->getMsg();

			//se deu certo e o resultado é true
			if ($editarCarro->getResult()){
				//redireciono o usuário para a página com os dados alteados
				$urlDestino = URL .'controller-carro/index/';
				header("location: {$urlDestino}");
			}
		} else{ //se não veio do botão enviarEditarUser
			$visualizar = new ModelsCarro();
			//pego os dados do usuário para exibir no formulário
			$visualizar->visualizar($IdCar);			
			$this->dados = $visualizar->getResult();
			$this->dados = $this->dados[0];
		}

		$carregarView = new ConfigView("carro/editarCarro",$this->dados);
		$carregarView->renderizar();
	}

	public function editarCarroCli($IdCar)	{
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset($this->dados['enviarEditarCarroCliente'])){
			unset($this->dados['enviarEditarCarroCliente']);
			$editarCarro = new ModelsCarro();
			$editarCarro->editar($IdCar, $this->dados);
			$this->dados['msg']=$editarCarro->getMsg();

			//se deu certo e o resultado é true
			if ($editarCarro->getResult()){
				//redireciono o usuário para a página com os dados alteados
				$urlDestino = URL .'controller-carro/exibirCarrosCli/'. $_SESSION['idPessoa'];
				header("location: {$urlDestino}");
			}
		} else{ //se não veio do botão enviarEditarUser
			$visualizar = new ModelsCarro();
			//pego os dados do usuário para exibir no formulário
			$visualizar->visualizar($IdCar);			
			$this->dados = $visualizar->getResult();
			$this->dados = $this->dados[0];
		}

		$carregarView = new ConfigView("carro/editarCarroCliente",$this->dados);
		$carregarView->renderizar();
	}

	public function apagar($IdCar)	{
		$this->IdCar = (int) $IdCar;
		if ($this->IdCar != null) {
			$apagarCarro = new ModelsCarro();
			//chamo a função que vai apagar o usuário do BD
			$apagarCarro->apagar($this->IdCar);
			//recebo a msg de sucesso ou erro
			
			//$_SESSION -> cria um arquivo temporário que é criado no servidor web para armazenar suas configurações de sessão.
			$_SESSION['msg'] = $apagarCarro->getMsg();

		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
			Usuário não foi informado!
			</div>";
		}

		$dominio= $_SERVER['HTTP_HOST'];
		$url = "http://" . $dominio. $_SERVER['REQUEST_URI'];
		
		if ($url != 'http://127.0.0.1/LavaJato1/adm/ControllerCarro/index') {
			$urlDestino = URL .'controller-carro/exibirCarrosCli/'. $_SESSION['idPessoa'];
			header("location: {$urlDestino}");
		}else{
			$urlDestino = URL .'controller-carro/index';
			header("location: {$urlDestino}");
		}
	}
}

?>