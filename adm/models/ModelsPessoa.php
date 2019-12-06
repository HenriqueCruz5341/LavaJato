<?php

class ModelsPessoa{
	private $result;
	private $msg;
	private $userId;
	private $userEmail;

	const ENTITY = 'pessoa';

	public function listar(){
		$listar = new ModelsRead();
		$listar->exeRead(self::ENTITY);
		$this->result = $listar->getResult();
		//return $this->result;
	}

	public function listarRua(){
		$listar = new ModelsRead();
		$listar->exeRead('rua');
		$this->result = $listar->getResult();
		//return $this->result;
	}

	public function visualizar($userId){
		$this->userId = (int) $userId;
		$visualizarUser = new ModelsRead();
		$visualizarUser->exeRead(self::ENTITY, "WHERE idPessoa = :idPessoa LIMIT :limit", "idPessoa={$this->userId}&limit=1");
		$this->result = $visualizarUser->getResult();
		
	}

	public function buscarEmail($userEmail){
		$this->userEmail = $userEmail;
		$visualizarUser = new ModelsRead();
		$visualizarUser->exeRead(self::ENTITY, "WHERE email LIKE :email", "email=%{$this->userEmail}%");
		$this->result = $visualizarUser->getResult();
	}

	public function visualizarComFisica($userId){
		$this->userId = (int) $userId;
		$visualizarUser = new ModelsRead();
		$visualizarUser->exeRead(self::ENTITY, "WHERE idPessoaFis = :idPessoaFis LIMIT :limit", "idPessoaFis={$this->userId}&limit=1");
		$this->result = $visualizarUser->getResult();
		
	}

	public function visualizarComJuridica($userId){
		$this->IdCar = (int) $IdCar;
		$visualizarCarro = new ModelsRead();
		$visualizarCarro->exeRead(self::ENTITY, "car join pessoa f on f.idPessoa = car.pessoa WHERE idCarro = :idCarro LIMIT :limit", "idCarro={$this->IdCar}&limit=1");
		$this->result = $visualizarCarro->getResult();
		
	}

	public function inserir(array $dados)
	{
		$this->dados = $dados;
		$this->validarDados();
		if ($this->result){
			$create = new ModelsCreate();
			$create->exeCreate(self::ENTITY, $this->dados);
			if ($create->getResult()) {
				$this->result = $create->getResult();
				$this->msg="<div class=\"alert alert-success\" role=\"alert\">
				Usuário cadastrado com sucesso!
				</div>";
			}
		}
	}

	public function editar($userId, array $dados){
		$this->userId = (int) $userId;
		$this->dados = $dados;

		$this->validarDados();
		if ($this->result) {
			//método que vai efetivar a edição dos dados
			$this->procEditar();
		}
	}

	public function procEditar(){
		$update = new modelsUpdate();
		$update->exeUpdate(self::ENTITY, $this->dados, "WHERE idPessoa = :idPessoa", "idPessoa={$this->userId}");
		//var_dump($this->dados);
		//var_dump($update);
		if ($update->getResult()) {
			$this->msg="<div class=\"alert alert-success\" role=\"alert\">
			Usuário {$this->userId} editado com sucesso!<div>";
			$this->result = true;
		}else{
			$this->msg="<div class=\"alert alert-danger\" role=\"alert\">
			Usuário {$this->userId} não foi encontrado!<div>";
		}
	}

	public function validarDados()
	{
		$this->dados = array_map('strip_tags', $this->dados);
		$this->dados = array_map('trim', $this->dados);
		if(in_array('',$this->dados)) {
			$this->result = false;
			$this->msg="<div class=\"alert alert-warning\" role=\"alert\">
			Campos obrigatórios devem ser preenchidos!
			</div>";
		}else{
			$this->dados['senha'] = md5($this->dados['senha']);
			$this->result = true;
		}
	}

	public function getMsg()
	{
		return $this->msg; 
	}

	public function getResult(){
		return $this->result;
	}

	public function apagar ($userId)	{
		//recebendo o id do usuário a excluir
		$this->userId = $userId;
		//recebendo dados do usuário que será excluído
		$this->visualizar($this->userId);
		$this->dados = $this->getResult();
		//verificando se achou o usuário
		if (count($this->dados) > 0){
			$delete = new ModelsDelete();
			$delete->exeDelete(self::ENTITY, "WHERE idPessoa = :idPessoa", "idPessoa={$this->userId}");
			$this->msg = "<div class=\"alert alert-success\" role=\"alert\">
			</div>";
			$this->result = true;
		}else{
			$this->msg = "<div class=\"alert alert-danger\" role=\"alert\">
			</div>";
			$this->result = false;
		}
	}
}
?>