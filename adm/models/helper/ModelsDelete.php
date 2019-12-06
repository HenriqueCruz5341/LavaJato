<?php

class ModelsDelete extends ModelsConn {
	private $tabela;
	private $result;
	private $termos;
	private $values;
	private $msg;
	private $conn;
	private $query;

	public function exeDelete($tabela, $termos, $parseString) {
		$this->tabela = (string) $tabela;
		$this->termos = (string) $termos;

		parse_str($parseString, $this->values);

		$this->getInstrucao();
		$this->executarInstrucao();

	}

	public function getInstrucao (){
		$this->query = "DELETE FROM {$this->tabela} {$this->termos}";
	}

	public function executarInstrucao (){
		$this->conexao();
		try{
			$this->query->execute($this->values);
			$this->result = true;
			$this->msg = "<div class=\"alert alert-success\" role=\"alert\">
			Usuário excluído com sucesso!
			</div>";
		}catch(Exception $e) {
			$this->result = false;
			$this->msg = "<div class=\"alert alert-danger\" role=\"alert\">
			Usuáio não foi excluído com sucesso!
			Erro: {$e->getMessage()}
			</div>";
		}
	}

	public function conexao () {
		$this->conn = parent::getConn();
		$this->query = $this->conn->prepare($this->query);
	}

	public function getResult (){
		return $this->result;
	}

	public function getMsg (){
		return $this->msg;
	}

}