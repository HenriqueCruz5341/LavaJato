<?php

class ControllerTipoServico{
	private $idTS;
	private $dados;

	public function index(){
		$listarTipoServico = new ModelsTipoServico();
		$listarTipoServico->listar();
		$this->dados = $listarTipoServico->getResult();
		//echo "<pre>"
		//var_dump($this->dados);
		//echo "<pre>"
		$carregar = new ConfigView("tipoServico/listarTipoServico", $this->dados);
		$carregar->renderizar();
		
	}

	public function visualizar($idTS){
		$this->idTS = (int) $idTS;
		$visualizarTipoServico = new ModelsTipoServico();
		$visualizarTipoServico->visualizar($this->idTS);
		$this->dados = $visualizarTipoServico->getResult();
		$carregar = new ConfigView("tiposervico/visualizarTipoServico", $this->dados);
		$carregar->renderizar();
	}

	public function inserir()
	{
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset ($this->dados['enviarInserirTipoServico'])){
			unset($this->dados['enviarInserirTipoServico']);
			$inserirTipoServico = new ModelsTipoServico();
			//var_dump($this->dados);
			$inserirTipoServico->inserir($this->dados);

			$this->dados['msg'] = $inserirTipoServico->getMsg();
			
			if ($inserirTipoServico->getResult()){
				$urlDestino = URL .'controller-tipo-servico/index';
				header("location: {$urlDestino}");
			}
		}

		$carregarView = new ConfigView("tiposervico/inserirTipoServico", $this->dados);
		$carregarView->renderizar();
	}

	public function editar($idTS)	{
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset($this->dados['enviarEditarTipoServico'])){
			unset($this->dados['enviarEditarTipoServico']);
			$editarTipoServico = new ModelsTipoServico();
			$editarTipoServico->editar($idTS, $this->dados);
			$this->dados['msg']=$editarTipoServico->getMsg();
			
			//se deu certo e o resultado é true
			if ($editarTipoServico->getResult()){
				//redireciono o usuário para a página com os dados alteados
				$urlDestino = URL .'controller-tipo-servico/index/';
				header("location: {$urlDestino}");
			}
		} else{ //se não veio do botão enviarEditarUser
			$visualizar = new ModelsTipoServico();
			//pego os dados do usuário para exibir no formulário
			$visualizar->visualizar($idTS);			
			$this->dados = $visualizar->getResult();
			$this->dados = $this->dados[0];
		}

		$carregarView = new ConfigView("tiposervico/editarTipoServico",$this->dados);
		$carregarView->renderizar();
	}

	public function apagar($idTS)	{
		$this->idTS = (int) $idTS;
		if ($this->idTS != null) {
			$apagarTipoServico = new ModelsTipoServico();
			//chamo a função que vai apagar o usuário do BD
			$apagarTipoServico->apagar($this->idTS);
			//recebo a msg de sucesso ou erro
			
			//$_SESSION -> cria um arquivo temporário que é criado no servidor web para armazenar suas configurações de sessão.
			$_SESSION['msg'] = $apagarTipoServico->getMsg();

		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
			Tipo serviço não foi informado!
			</div>";
		}

		$urlDestino = URL .'controller-tipo-servico/index';
		header("location: {$urlDestino}");
	}
}

?>

