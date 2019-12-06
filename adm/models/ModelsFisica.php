<?php

class ModelsFisica{
	private $result;
	private $msg;
	private $IdPeFis;

	const ENTITY = 'fisica';

	public function listar(){
		$listar = new ModelsRead();
		$listar->exeRead(self::ENTITY);
		$this->result = $listar->getResult();
		//return $this->result;
	}


	public function visualizar($IdPeFis){
		$this->IdPeFis = (int) $IdPeFis;
		$visualizarFisica = new ModelsRead();
		$visualizarFisica->exeRead(self::ENTITY, "WHERE IdPessoaFis = :IdPessoaFis LIMIT :limit", "IdPessoaFis={$this->IdPeFis}&limit=1");
		$this->result = $visualizarFisica->getResult();
		
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
				Pessoa Física {$this->dados['nomeFisica']} cadastrado com sucesso!
				</div>";
			}
		}
	}

	public function editar($IdPeFis, array $dados){
		$this->IdPeFis = (int) $IdPeFis;
		$this->dados = $dados;

		$this->validarDados();
		if ($this->result) {
			//método que vai efetivar a edição dos dados
			$this->procEditar();
		}
	}

	public function procEditar(){
		$update = new modelsUpdate();
		$update->exeUpdate(self::ENTITY, $this->dados, "WHERE IdPessoaFis = :IdPessoaFis", "IdPessoaFis={$this->IdPeFis}");
		//var_dump($this->dados);
		//var_dump($update);
		if ($update->getResult()) {
			$this->msg="<div class=\"alert alert-success\" role=\"alert\">
			Pessoa Física {$this->IdPeFis} editado com sucesso!<div>";
			$this->result = true;
		}else{
			$this->msg="<div class=\"alert alert-danger\" role=\"alert\">
			Pessoa Física {$this->IdPeFis} não foi encontrado!<div>";
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

	public function apagar ($IdPeFis)	{
		//recebendo o id do usuário a excluir
		$this->IdPeFis = $IdPeFis;
		//recebendo dados do usuário que será excluído
		$this->visualizar($this->IdPeFis);
		$this->dados = $this->getResult();
		//verificando se achou o usuário
		if (count($this->dados) > 0){
			$delete = new ModelsDelete();
			$delete->exeDelete(self::ENTITY, "WHERE IdPessoaFis = :IdPessoaFis", "IdPessoaFis={$this->IdPeFis}");
			$this->msg = "<div class=\"alert alert-success\" role=\"alert\">
			Pessoa Física {$this->dados[0]['nomeFisica']} excluído com sucesso!
			</div>";
			$this->result = true;
		}else{
			$this->msg = "<div class=\"alert alert-danger\" role=\"alert\">
			Pessoa Física {$this->dados[0]['nomeFisica']} não foi excluído com sucesso
			</div>";
			$this->result = false;
		}
	}
}
?>