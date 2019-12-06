<?php 

class ModelsCreate extends ModelsConn{
	private $tabela;
	private $dados;
	private $query;
	private $conn;
	private $msg;
	private $result;


	public function exeCreate($tabela, array $dados){
		$this->tabela = (string) $tabela;
		$this->dados = $dados;

		$this->getInstrucao();
		$this->executarInstrucao();

	}

	public function getInstrucao()
	{
		$keys = implode(', ', array_keys($this->dados));
		$values = ':' . implode(', :', array_keys($this->dados));

		$this->query = "INSERT INTO {$this->tabela} ({$keys}) VALUES ({$values})";
	}

	private function executarInstrucao() {
		$this->conexao();
		try{
			$this->query->execute($this->dados);			
			$this->result = $this->conn->lastInsertId();
		}catch (Exception $e) {
			$this->result = null;
			$_SESSION['msg'] = "<div class=\"alert alert-warning\" role=\"alert\">
			Erro ao cadastrar usuário! Erro: {$e->getMessage()}
			</div>";
		}
	}

	public function conexao()
	{
		$this->conn = parent::getConn();
		$this->query = $this->conn->prepare($this->query);
	}

	public function getMsg() {
		return $this->msg;
	}

	public function getResult() {
		return $this->result;
	}
}