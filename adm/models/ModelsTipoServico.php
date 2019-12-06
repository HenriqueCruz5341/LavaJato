<?php

class ModelsTipoServico{
	private $result;
	private $msg;
	private $idTS;

	const ENTITY = 'tiposervico';

	public function listar(){
		$listar = new ModelsRead();
		$listar->exeRead(self::ENTITY, 'LIMIT :limit', 'limit=5');
		$this->result = $listar->getResult();
		//return $this->result;
	}

	public function visualizar($idTS){
		$this->idTS = (int) $idTS;
		$visualizarTipoServico = new ModelsRead();
		$visualizarTipoServico->exeRead(self::ENTITY, "WHERE idTipoServico = :idTipoServico LIMIT :limit", "idTipoServico={$this->idTS}&limit=1");
		$this->result = $visualizarTipoServico->getResult();
		
	}

	public function inserir(array $dados)
	{
		$this->dados = $dados;
		//var_dump($this->result);
		$this->validarDados();
		if ($this->result){
			$create = new ModelsCreate();
			$create->exeCreate(self::ENTITY, $this->dados);
			if ($create->getResult()) {
				$this->result = $create->getResult();
				$this->msg="<div class=\"alert alert-success\" role=\"alert\">
				Tipo Serviço {$this->dados['nomeTs']} cadastrado com sucesso!
				</div>";
			}
		}
	}

	public function editar($idTS, array $dados){
		$this->idTS = (int) $idTS;
		$this->dados = $dados;

		$this->validarDados();
		if ($this->result) {
			//método que vai efetivar a edição dos dados
			$this->procEditar();
		}
	}

	public function procEditar(){
		$update = new modelsUpdate();
		$update->exeUpdate(self::ENTITY, $this->dados, "WHERE idTipoServico = :idTipoServico", "idTipoServico={$this->idTS}");
		//var_dump($this->dados);
		//var_dump($update);
		if ($update->getResult()) {
			$this->msg="<div class=\"alert alert-success\" role=\"alert\">
			Tipo Serviço {$this->idTS} editado com sucesso!<div>";
			$this->result = true;
		}else{
			$this->msg="<div class=\"alert alert-danger\" role=\"alert\">
			Tipo Serviço {$this->idTS} não foi encontrado!<div>";
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
			//$this->dados['senha'] = md5($this->dados['senha']);
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

	public function apagar ($idTS)	{
		//recebendo o id do usuário a excluir
		$this->idTS = $idTS;
		//recebendo dados do usuário que será excluído
		$this->visualizar($this->idTS);
		$this->dados = $this->getResult();
		//verificando se achou o usuário
		if (count($this->dados) > 0){
			$delete = new ModelsDelete();
			$delete->exeDelete(self::ENTITY, "WHERE idTipoServico = :idTipoServico", "idTipoServico={$this->idTS}");
			$this->msg = "<div class=\"alert alert-success\" role=\"alert\">
			Tipo Serviço {$this->dados[0]['nomeTs']} excluído com sucesso!
			</div>";
			$this->result = true;
		}else{
			$this->msg = "<div class=\"alert alert-danger\" role=\"alert\">
			Tipo Serviço {$this->dados[0]['nomeTs']} não foi excluído com sucesso
			</div>";
			$this->result = false;
		}
	}
}
?>