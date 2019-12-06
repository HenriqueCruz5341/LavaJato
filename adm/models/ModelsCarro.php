<?php

class ModelsCarro{
	private $result;
	private $msg;
	private $IdCar;
	private $listaPessoa;

	const ENTITY = 'carro';

	public function listar(){
		$listar = new ModelsRead();
		$listar->exeRead(self::ENTITY);
		$this->result = $listar->getResult();
		//return $this->result;
	}

	public function listarComPessoa(){
		$listar = new ModelsRead();
		$listar->exeRead(self::ENTITY, "car join pessoa f on f.idPessoa = car.pessoa");
		$this->result = $listar->getResult();
	}

	public function listarPessoa(){
		$listar = new ModelsRead();
		$listar->exeRead('pessoa');
		$this->result = $listar->getResult();
		//return $this->listaPessoas;
	}

	public function visualizarComPessoa($IdCar){
		$this->IdCar = (int) $IdCar;
		$visualizarCarro = new ModelsRead();
		$visualizarCarro->exeRead(self::ENTITY, "car join pessoa f on f.idPessoa = car.pessoa WHERE idCarro = :idCarro LIMIT :limit", "idCarro={$this->IdCar}&limit=1");
		$this->result = $visualizarCarro->getResult();
		
	}

	public function visualizar($IdCar){
		$this->IdCar = (int) $IdCar;
		$visualizarCarro = new ModelsRead();
		$visualizarCarro->exeRead(self::ENTITY, "WHERE idCarro = :idCarro LIMIT :limit", "idCarro={$this->IdCar}&limit=1");
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
				Carro {$this->dados['modelo']} cadastrado com sucesso!
				</div>";
			}
		}
	}

	public function editar($IdCar, array $dados){
		$this->IdCar = (int) $IdCar;
		$this->dados = $dados;

		$this->validarDados();
		if ($this->result) {
			//método que vai efetivar a edição dos dados
			$this->procEditar();
		}
	}

	public function procEditar(){
		$update = new modelsUpdate();
		$update->exeUpdate(self::ENTITY, $this->dados, "WHERE idCarro = :idCarro", "idCarro={$this->IdCar}");
		//var_dump($this->dados);
		//var_dump($update);
		if ($update->getResult()) {
			$this->msg="<div class=\"alert alert-success\" role=\"alert\">
			Carro {$this->IdCar} editado com sucesso!<div>";
			$this->result = true;
		}else{
			$this->msg="<div class=\"alert alert-danger\" role=\"alert\">
			Carro {$this->IdCar} não foi encontrado!<div>";
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

	public function apagar ($IdCar)	{
		//recebendo o id do usuário a excluir
		$this->IdCar = $IdCar;
		//recebendo dados do usuário que será excluído
		$this->visualizar($this->IdCar);
		$this->dados = $this->getResult();
		//verificando se achou o usuário
		if (count($this->dados) > 0){
			$delete = new ModelsDelete();
			$delete->exeDelete(self::ENTITY, "WHERE idCarro = :idCarro", "idCarro={$this->IdCar}");
			$this->msg = "<div class=\"alert alert-success\" role=\"alert\">
			Carro {$this->dados[0]['modelo']} excluído com sucesso!
			</div>";
			$this->result = true;
		}else{
			$this->msg = "<div class=\"alert alert-danger\" role=\"alert\">
			Carro {$this->dados[0]['modelo']} não foi excluído com sucesso
			</div>";
			$this->result = false;
		}
	}
}
?>