<?php

class ModelsUpdate extends ModelsConn{
	private $tabelas;
	private $dados;
	private $termos;
	private $query;
	private $msg;
	private $result;
	private $conn;
	private $values;

	public function exeUpdate($tabela, array $dados, $termos, $parseString) {
		$this->tabela = (string) $tabela;
		$this->dados = $dados;
		$this->termos = (string) $termos;

		//separo os valores passados e crio um array this->values
		parse_str($parseString, $this->values);

		$this->getInsrucao();
		$this->executarInstrucao();
	}

	public function getMsg(){
		return $this->msg;
	}

	public function getResult(){
		return $this->result;
	}

	private function getInsrucao(){
		foreach ($this->dados as $key => $value){
			$values[] = $key ." = :" .$key;
		}
		$values = implode(", ", $values);
		$this->query = "UPDATE {$this->tabela} SET {$values} {$this->termos}"; 
	}

	public function conexao(){
		$this->conn = parent::getConn();
		$this->query = $this->conn->prepare($this->query);
	}

	public function getRowCount(){
		return $this->query->rowCount;
	}

	public function executarInstrucao(){
		$this->conexao();
		try{
			$this->query->execute(array_merge($this->dados, $this->values));
			$this->result = true;
			$this->msg="<div class=\"alert alert-success\" role=\"alert\">
			Usuário editado com sucesso!
			</div>";
		}catch (Exception $e) {
			$this->result = null;
			$this->msg="<div class=\"alert alert-danger\" role=\"alert\">
			Erro ao editar o usuário {$this->dados['userId']}!
			Erro: {$e->getMessage()}
			</div>";
		}
	}
}