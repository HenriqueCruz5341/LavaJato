<?php

class ModelsJuridica{
	private $result;
	private $msg;
	private $IdPeJur;

	const ENTITY = 'juridica';

	public function listar(){
		$listar = new ModelsRead();
		$listar->exeRead(self::ENTITY);
		$this->result = $listar->getResult();
		//return $this->result;
	}


	public function visualizar($IdPeJur){
		$this->IdPeJur = (int) $IdPeJur;
		$visualizarJuridica = new ModelsRead();
		$visualizarJuridica->exeRead(self::ENTITY, "WHERE IdPessoaJur = :IdPessoaJur LIMIT :limit", "IdPessoaJur={$this->IdPeJur}&limit=1");
		$this->result = $visualizarJuridica->getResult();
		
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
				Pessoa Jurídica {$this->dados['nomeFantasia']} cadastrado com sucesso!
				</div>";
			}
		}
	}

	public function editar($IdPeJur, array $dados){
		$this->IdPeJur = (int) $IdPeJur;
		$this->dados = $dados;

		$this->validarDados();
		if ($this->result) {
			//método que vai efetivar a edição dos dados
			$this->procEditar();
		}
	}

	public function procEditar(){
		$update = new modelsUpdate();
		$update->exeUpdate(self::ENTITY, $this->dados, "WHERE IdPessoaJur = :IdPessoaJur", "IdPessoaJur={$this->IdPeJur}");
		//var_dump($this->dados);
		//var_dump($update);
		if ($update->getResult()) {
			$this->msg="<div class=\"alert alert-success\" role=\"alert\">
			Pessoa Jurídica {$this->IdPeJur} editado com sucesso!<div>";
			$this->result = true;
		}else{
			$this->msg="<div class=\"alert alert-danger\" role=\"alert\">
			Pessoa Jurídica {$this->IdPeJur} não foi encontrado!<div>";
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

	public function apagar ($IdPeJur)	{
		//recebendo o id do usuário a excluir
		$this->IdPeJur = $IdPeJur;
		//recebendo dados do usuário que será excluído
		$this->visualizar($this->IdPeJur);
		$this->dados = $this->getResult();
		//verificando se achou o usuário
		if (count($this->dados) > 0){
			$delete = new ModelsDelete();
			$delete->exeDelete(self::ENTITY, "WHERE IdPessoaJur = :IdPessoaJur", "IdPessoaJur={$this->IdPeJur}");
			$this->msg = "<div class=\"alert alert-success\" role=\"alert\">
			Pessoa Jurídica {$this->dados[0]['nomeFantasia']} excluído com sucesso!
			</div>";
			$this->result = true;
		}else{
			$this->msg = "<div class=\"alert alert-danger\" role=\"alert\">
			Pessoa Jurídica {$this->dados[0]['nomeFantasia']} não foi excluído com sucesso
			</div>";
			$this->result = false;
		}
	}
}
?>