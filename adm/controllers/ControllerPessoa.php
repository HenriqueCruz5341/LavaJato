<?php

class ControllerPessoa{
	private $userId;
	private $dados;

	public function index(){
		$listarUsers = new ModelsPessoa();
		$listarUsers->listar();
		$this->dados = $listarUsers->getResult();
		$carregar = new ConfigView("pessoa/listarPessoa", $this->dados);
		$carregar->renderizar();
		
	}

	public function visualizar($userId){
		$this->userId = (int) $userId;
		$visualizarUser = new ModelsPessoa();
		$visualizarUser->visualizar($this->userId);
		$this->dados = $visualizarUser->getResult();
		$carregar = new ConfigView("pessoa/visualizarPessoa", $this->dados);
		$carregar->renderizar();
	}

	public function inserir()
	{
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset ($this->dados['enviarInserirPessoa'])){
			unset($this->dados['enviarInserirPessoa']);

			$pessoa['email'] = $this->dados['email'];
			$pessoa['senha'] = $this->dados['senha'];
			$pessoa['rua'] = $this->dados['rua'];
			$pessoa['numeroCasa'] = $this->dados['numeroCasa'];
			$pessoa['complemento'] = $this->dados['complemento'];
			$pessoa['ddd'] = $this->dados['ddd'];
			$pessoa['telefone'] = $this->dados['telefone'];
			$pessoa['tipo'] = $this->dados['tipo'];
			$inserirUsuario = new ModelsPessoa();
			$inserirUsuario->inserir($pessoa);			

			if ($pessoa['tipo'] == '1'){
				$fisica['nomeFisica'] = $this->dados['nomeFisica'];
				$fisica['cpf'] = $this->dados['cpf'];

				$fisica['idPessoaFis'] = $inserirUsuario->getResult();
				$inserirFisica = new ModelsFisica();
				$inserirFisica->inserir($fisica);
			} elseif ($pessoa['tipo'] == '2') {
				$juridica['nomeFantasia'] = $this->dados['nomeFantasia'];
				$juridica['razaoSocial'] = $this->dados['razaoSocial'];

				$juridica['idPessoaJur'] = $inserirUsuario->getResult();
				$juridica['cnpj'] = $this->dados['cnpj'];
				$inserirJuridica = new ModelsJuridica();
				$inserirJuridica->inserir($juridica);
			} 

			$this->dados['msg'] = $inserirUsuario->getMsg();
			if ($inserirUsuario->getResult()){
				$urlDestino = URL .'ControllerPessoa/index';
				header("location: {$urlDestino}");
			}
		}

		$carregarView = new ConfigView("pessoa/inserirPessoa", $this->dados);
		$carregarView->renderizar();
	}

	public function buscar(){
		$carregarView = new ConfigView("pessoa/buscarPessoa", $this->dados);
		$carregarView->renderizar();

		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset ($this->dados['buscarPessoaId'])){
			unset($this->dados['buscarPessoaId']);
			$procurarId = new ModelsPessoa();
			$procurarId->listar();
			$listaPessoa = $procurarId->getResult();
			foreach ($listaPessoa as $pessoa) {
				if ($this->dados['pesquisa'] == $pessoa['idPessoa']) {
					$urlDestino = URL .'ControllerPessoa/visualizar/'.$this->dados['pesquisa'];
					header("location: {$urlDestino}");
				}
			}
			echo("<div class=\"alert alert-danger\" role=\"alert\">
				Usuário não encontrado!
				</div>");
		}

		if (isset ($this->dados['buscarPessoaEmail'])){
			unset($this->dados['buscarPessoaEmail']);

			$listarFiltro = new ModelsPessoa();
			$listarFiltro->buscarEmail($this->dados['pesquisa']);
			$bEmail = $listarFiltro->getResult();
			//var_dump($bEmail);

			
			if (!empty($bEmail)) {
					//var_dump($bEmail);
				$carregar = new ConfigView("pessoa/listarPessoa", $bEmail);
				$carregar->renderizar();
				
			}else {		
				echo("<div class=\"alert alert-danger\" role=\"alert\">
					Usuário não encontrado!
					</div>");
			}
			//$carregar = new ConfigView("pessoa/listarPessoa", $bEmail);
			//$carregar->renderizar();

		}
	}

	public function editar($userId)	{
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset($this->dados['enviarEditarPessoa'])){
			unset($this->dados['enviarEditarPessoa']);
			/*
			$editarUsuario = new ModelsPessoa();
			$editarUsuario->editar($userId, $this->dados);
			$this->dados['msg']=$editarUsuario->getMsg();
			*/			

			var_dump($this->dados);

			$pessoa['email'] = $this->dados['email'];
			$pessoa['senha'] = $this->dados['senha'];
			$pessoa['rua'] = $this->dados['rua'];
			$pessoa['numeroCasa'] = $this->dados['numeroCasa'];
			$pessoa['complemento'] = $this->dados['complemento'];
			$pessoa['ddd'] = $this->dados['ddd'];
			$pessoa['telefone'] = $this->dados['telefone'];
			$pessoa['tipo'] = $this->dados['tipo'];
			$editarUsuario = new ModelsPessoa();
			$editarUsuario->editar($userId, $pessoa);

			if ($pessoa['tipo'] == '1'){
				$fisica['nomeFisica'] = $this->dados['nomeFisica'];
				$fisica['cpf'] = $this->dados['cpf'];

				$editarFisica = new ModelsFisica();
				$editarFisica->editar($userId, $fisica);
			} elseif ($pessoa['tipo'] == '2') {
				$juridica['nomeFantasia'] = $this->dados['nomeFantasia'];
				$juridica['razaoSocial'] = $this->dados['razaoSocial'];
				$juridica['cnpj'] = $this->dados['cnpj'];

				$editarJuridica = new ModelsJuridica();
				$editarJuridica->editar($userId, $juridica);
			}

			$this->editarUsuario['msg']=$editarUsuario->getMsg();

			//se deu certo e o resultado é true
			if ($editarUsuario->getResult()){
				//redireciono o usuário para a página com os dados alteados
				$urlDestino = URL .'controller-pessoa/index/';
				header("location: {$urlDestino}");
			}
		} else{ //se não veio do botão enviarEditarUser
			$visualizar = new ModelsPessoa();
			//pego os dados do usuário para exibir no formulário
			$visualizar->visualizar($userId);			
			$this->dados = $visualizar->getResult();
			$this->dados = $this->dados[0];
		}

		$carregarView = new ConfigView("pessoa/editarPessoa",$this->dados);
		$carregarView->renderizar();
	}

	public function apagar($userId)	{
		$this->userId = (int) $userId;
		if ($this->userId != null) {
			$apagarUser = new ModelsPessoa();

			$ola = new ModelsPessoa();
			$ola->visualizar($this->userId);
			$oi = $ola->getResult();

			//var_dump($oi['tipo']);
			//chamo a função que vai apagar o usuário do BD
			//recebo a msg de sucesso ou erro

			//if ($oi['tipo'] == '1') {
			$apagarFisica = new ModelsFisica();
			$apagarFisica->apagar($this->userId);
			//}elseif ($oi['tipo'] == '2') {
			$apagarJuridica = new ModelsJuridica();
			$apagarJuridica->apagar($this->userId);
			//}

			$apagarUser->apagar($this->userId);

			
			//$_SESSION -> cria um arquivo temporário que é criado no servidor web para armazenar suas configurações de sessão.
			$_SESSION['msg'] = $apagarUser->getMsg();

		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
			Usuário não foi informado!
			</div>";
		}

		$urlDestino = URL .'controller-pessoa/index';
		header("location: {$urlDestino}");
	}
}

?>

