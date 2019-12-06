<?php
class ConfigView{
	private $nome;
	private $dados;

	public function __construct($nome, array $dados = null){
		$this->dados = $dados;
		$this->nome = (string) $nome;
	}

	public function renderizar(){
		include_once("views/header.php");
		//incluindo o menu
		//include_once("views/menu.php");
		if (file_exists("views/{$this->nome}.php")){
			include_once("views/{$this->nome}.php");
		}else{
			echo "<div class=\"alert alert-danger\" role=\"alert\">
			Erro: View {$this->nome} não encontrada!
			</div>";
		}
		include_once("views/footer.php");
	}

	public function renderizarAuth(){
		if (file_exists("views/{$this->nome}.php")){
			include_once("views/{$this->nome}.php");
		}else{
			echo "<div class=\"alert alert-danger\" role=\"alert\">
			Erro: View {$this->nome} não encontrada!
			</div>";
		}
	}

	public function getDados(){
		return $this->dados;
	}
}

?>