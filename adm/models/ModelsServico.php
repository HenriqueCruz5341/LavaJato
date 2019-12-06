<?php

class ModelsServico{
	private $result;
	private $msg;
	private $IdServ;

	const ENTITY = 'servico';

	public function listar(){
		$listar = new ModelsRead();
		$listar->exeRead(self::ENTITY);
		$this->result = $listar->getResult();
		//return $this->result;
	}


	public function buscarCarPes($idPessoa){
		$listaCarros = new ModelsRead();
		$listaCarros->exeRead('carro', "as car, pessoa as pes where pes.idPessoa = car.pessoa and pes.idPessoa = :idPessoa", "idPessoa={$idPessoa}");
		$this->result = $listaCarros->getResult();
	}

	public function visualizar($IdServ){
		$this->IdServ = (int) $IdServ;
		$visualizarServico = new ModelsRead();
		$visualizarServico->exeRead(self::ENTITY, "WHERE IdServico = :IdServico LIMIT :limit", "IdServico={$this->IdServ}&limit=1");
		$this->result = $visualizarServico->getResult();
		
	}

	public function listarTPagamento(){
		$listar = new ModelsRead();
		$listar->exeRead('tipopagamento');
		$this->result = $listar->getResult();
		//return $this->result;
	}

	public function listarCarro(){
		$listar = new ModelsRead();
		$listar->exeRead('carro');
		$this->result = $listar->getResult();
		//return $this->result;
	}

	public function listarTServico(){
		$listar = new ModelsRead();
		$listar->exeRead('tiposervico');
		$this->result = $listar->getResult();
		//return $this->result;
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
				Serviço cadastrado com sucesso!
				</div>";
			}
		}
	}

	public function editar($IdServ, array $dados){
		$this->IdServ = (int) $IdServ;
		$this->dados = $dados;

		$this->validarDados();
		if ($this->result) {
			//método que vai efetivar a edição dos dados
			$this->procEditar();
		}
	}

	public function procEditar(){
		$update = new modelsUpdate();
		$update->exeUpdate(self::ENTITY, $this->dados, "WHERE IdServico = :IdServico", "IdServico={$this->IdServ}");
		//var_dump($this->dados);
		//var_dump($update);
		if ($update->getResult()) {
			$this->msg="<div class=\"alert alert-success\" role=\"alert\">
			Serviço {$this->IdServ} editado com sucesso!<div>";
			$this->result = true;
		}else{
			$this->msg="<div class=\"alert alert-danger\" role=\"alert\">
			Serviço {$this->IdServ} não foi encontrado!<div>";
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

	public function apagar ($IdServ)	{
		//recebendo o id do usuário a excluir
		$this->IdServ = $IdServ;
		//recebendo dados do usuário que será excluído
		$this->visualizar($this->IdServ);
		$this->dados = $this->getResult();
		//verificando se achou o usuário
		if (count($this->dados) > 0){
			$delete = new ModelsDelete();
			$delete->exeDelete(self::ENTITY, "WHERE IdServico = :IdServico", "IdServico={$this->IdServ}");
			$this->msg = "<div class=\"alert alert-success\" role=\"alert\">
			Serviço {$this->dados[0]['IdServico']} excluído com sucesso!
			</div>";
			$this->result = true;
		}else{
			$this->msg = "<div class=\"alert alert-danger\" role=\"alert\">
			Serviço {$this->dados[0]['IdServico']} não foi excluído com sucesso
			</div>";
			$this->result = false;
		}
	}
}
?>