<?php

class ModelsAuth{

	private $dados;
	private $result;
	private $msg;
	private $rowCount;

	const ENTITY = 'pessoa';

	public function autenticar(array $dados){
		$this->dados = $dados;
		$this->validar();
		if ($this->result){			
			$visualizar = new ModelsRead();
			$visualizar->exeRead(self::ENTITY, "WHERE email=:email AND senha=:senha LIMIT :limit", "email={$this->dados['email']}&senha={$this->dados['senha']}&limit=1");			
			if ($visualizar->getRowCount() == 1){
				//var_dump($this->dados);
				$this->result  = $visualizar->getResult();
			}else{
				$this->result = false;
				$_SESSION['msg'] = "
				<div class=\"alert alert-danger\" role=\"alert\">
				Login e/ou senha inválidos!
				</div>";
			}
		}
	}

	public function validar(){
		$this->dados = array_map('strip_tags', $this->dados);
		$this->dados = array_map('trim', $this->dados);
		if(in_array('', $this->dados)){
			$this->dados['senha'] = md5($this->dados['senha']);
			$this->result = false;
			$_SESSION['msg'] = "
			<div class=\"alert alert-danger\" role=\"alert\">
			Login e/ou senha inválidos!
			</div>";
		}else{
			$this->dados['senha'] = md5($this->dados['senha']);
			$this->result = true;
		}
	}

	public function getResult(){
		return $this->result;
	}

	public function getMsg(){
		return $this->msg;
	}

	public function getRowCount(){
		return $this->rowCount;
	}
}