<?php

class ModelsProduto{
	private $result;
	private $msg;
	private $IdProd;

	const ENTITY = 'produto';

	public function listar(){
		$listar = new ModelsRead();
		$listar->exeRead(self::ENTITY);
		$this->result = $listar->getResult();
		//return $this->result;
	}

	public function listarPessoa(){
		$listar = new ModelsRead();
		$listar->exeRead('pessoa');
		$this->result = $listar->getResult();
		//return $this->listaPessoas;
	}
	
	public function listarComFornecedor(){
		$listar = new ModelsRead();
		$listar->exeRead(self::ENTITY, "pro join pessoa f on f.idPessoa = pro.pessoa");
		$this->result = $listar->getResult();
		
	}

	public function visualizarComFornecedor($IdProd){
		$this->IdProd = (int) $IdProd;
		$listar = new ModelsRead();
		$listar->exeRead(self::ENTITY, "pro join pessoa f on f.idPessoa = pro.pessoa WHERE IdProduto = :IdProduto LIMIT :limit", "IdProduto={$this->IdProd}&limit=1");
		$this->result = $listar->getResult();
		
	}

	public function visualizar($IdProd){
		$this->IdProd = (int) $IdProd;
		$visualizarProduto = new ModelsRead();
		$visualizarProduto->exeRead(self::ENTITY, "WHERE IdProduto = :IdProduto LIMIT :limit", "IdProduto={$this->IdProd}&limit=1");
		$this->result = $visualizarProduto->getResult();
		
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
				Produto {$this->dados['nomeProd']} cadastrado com sucesso!
				</div>";
			}
		}
	}

	public function editar($IdProd, array $dados){
		$this->IdProd = (int) $IdProd;
		$this->dados = $dados;

		$this->validarDados();
		if ($this->result) {
			//método que vai efetivar a edição dos dados
			$this->procEditar();
		}
	}

	public function procEditar(){
		$update = new modelsUpdate();
		$update->exeUpdate(self::ENTITY, $this->dados, "WHERE IdProduto = :IdProduto", "IdProduto={$this->IdProd}");
		//var_dump($this->dados);
		//var_dump($update);
		if ($update->getResult()) {
			$this->msg="<div class=\"alert alert-success\" role=\"alert\">
			Produto {$this->IdProd} editado com sucesso!<div>";
			$this->result = true;
		}else{
			$this->msg="<div class=\"alert alert-danger\" role=\"alert\">
			Produto {$this->IdProd} não foi encontrado!<div>";
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

	public function apagar ($IdProd)	{
		//recebendo o id do usuário a excluir
		$this->IdProd = $IdProd;
		//recebendo dados do usuário que será excluído
		$this->visualizar($this->IdProd);
		$this->dados = $this->getResult();
		//verificando se achou o usuário
		if (count($this->dados) > 0){
			$delete = new ModelsDelete();
			$delete->exeDelete(self::ENTITY, "WHERE IdProduto = :IdProduto", "IdProduto={$this->IdProd}");
			$this->msg = "<div class=\"alert alert-success\" role=\"alert\">
			Produto {$this->dados[0]['nomeProd']} excluído com sucesso!
			</div>";
			$this->result = true;
		}else{
			$this->msg = "<div class=\"alert alert-danger\" role=\"alert\">
			Produto {$this->dados[0]['nomeProd']} não foi excluído com sucesso
			</div>";
			$this->result = false;
		}
	}
}
?>