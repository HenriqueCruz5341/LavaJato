<?php

class ControllerProduto{
	private $IdProd;
	private $dados;

	public function index(){
		$listarProduto = new ModelsProduto();
		$listarProduto->listarComFornecedor();
		$this->dados = $listarProduto->getResult();
		//echo "<pre>"
		//var_dump($this->dados);
		//echo "<pre>"
		$carregar = new ConfigView("produto/listarProduto", $this->dados);
		$carregar->renderizar();
		
	}

	public function visualizar($IdProd){
		$this->IdProd = (int) $IdProd;
		$visualizarProduto = new ModelsProduto();
		$visualizarProduto->visualizarComFornecedor($this->IdProd);
		$this->dados = $visualizarProduto->getResult();
		$carregar = new ConfigView("produto/visualizarProduto", $this->dados);
		$carregar->renderizar();
	}

	public function inserir()
	{
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset ($this->dados['enviarInserirProduto'])){
			unset($this->dados['enviarInserirProduto']);
			$inserirProduto = new ModelsProduto();
			$inserirProduto->inserir($this->dados);
			$this->dados['msg'] = $inserirProduto->getMsg();
			if ($inserirProduto->getResult()){
				$urlDestino = URL .'ControllerProduto/index';
				header("location: {$urlDestino}");
			}
		}

		$carregarView = new ConfigView("produto/inserirProduto", $this->dados);
		$carregarView->renderizar();
	}

	public function editar($IdProd)	{
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset($this->dados['enviarEditarProduto'])){
			unset($this->dados['enviarEditarProduto']);
			$editarProduto = new ModelsProduto();
			$editarProduto->editar($IdProd, $this->dados);
			$this->dados['msg']=$editarProduto->getMsg();
			
			//se deu certo e o resultado é true
			if ($editarProduto->getResult()){
				//redireciono o usuário para a página com os dados alteados
				$urlDestino = URL .'controller-produto/index/';
				header("location: {$urlDestino}");
			}
		} else{ //se não veio do botão enviarEditarUser
			$visualizar = new ModelsProduto();
			//pego os dados do usuário para exibir no formulário
			$visualizar->visualizar($IdProd);			
			$this->dados = $visualizar->getResult();
			$this->dados = $this->dados[0];
		}

		$carregarView = new ConfigView("produto/editarProduto",$this->dados);
		$carregarView->renderizar();
	}

	public function apagar($IdProd)	{
		$this->IdProd = (int) $IdProd;
		if ($this->IdProd != null) {
			$apagarProduto = new ModelsProduto();
			//chamo a função que vai apagar o usuário do BD
			$apagarProduto->apagar($this->IdProd);
			//recebo a msg de sucesso ou erro
			
			//$_SESSION -> cria um arquivo temporário que é criado no servidor web para armazenar suas configurações de sessão.
			$_SESSION['msg'] = $apagarProduto->getMsg();

		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
			Usuário não foi informado!
			</div>";
		}

		$urlDestino = URL .'controller-produto/index';
		header("location: {$urlDestino}");
	}
}

?>

