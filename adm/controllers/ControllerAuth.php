<?php

class ControllerAuth{

	private $dados;

	public function auth(){
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (isset($this->dados['sendLogin'])){
			//var_dump($this->dados);
			unset($this->dados['sendLogin']);
			if (($this->dados['email'] != null) && ($this->dados['senha'] != null)){
				$login = new ModelsAuth();
				$login->autenticar($this->dados);
				//verifico se o resultado foi negativo
				if (!$login->getResult()){
					$_SESSION['msg'] = $login->getMsg();
				}else{
					$this->dados = $login->getResult();
					$this->dados = $this->dados[0];
					//coloco na sessao os dados do usuario logado

					$_SESSION['idPessoa'] = $this->dados['idPessoa'];
					$_SESSION['email'] = $this->dados['email'];
					$_SESSION['tipo'] = intval($this->dados['tipo']);
					
					//crio a url de redirecionamento
					$urlDestino = URL .'ControllerHome/index';
					//redireciono o usuario
					header("location: {$urlDestino}");
				}
			}else{
				$_SESSION['msg'] = "
				<div class=\"alert alert-danger\" role=\"alert\">
				Login e senha devem ser preenchidos!
				</div>";
			}
		}else{
			$this->dados = null;
		}

		$carregar = new ConfigView('auth/login');
		$carregar->renderizarAuth();
	}

	public function logout(){
		$_SESSION['msg'] = "
		<div class=\"alert alert-success\" role=\"alert\">
		Usuário {$_SESSION['nome']} foi deslogado com successo!
		</div>";

		unset($_SESSION['idPessoa'],
			$_SESSION['senha'],
			$_SESSION['email'],
			$_SESSION['tipo']);
		//unset($_SESSION);

		$urlDestino = URL .'ControllerHome/index';
		header("location: {$urlDestino}");
	}
}