<?php

Class ConfigController{

	private $url;
	private $urlConjunto;
	private $urlController;
	private $urlMetodo;
	private $urlParametro;
	private static $formatar;
	private $paginasPermissao;

	public function __construct(){

		if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
			$this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
			//echo $this->url;
			$this->clearUrl();
			$this->urlConjunto = explode("/", $this->url);
			$this->urlController = $this->validarController($this->urlConjunto[0]);
			
			if (isset($this->urlConjunto[0])) {
				$this->urlController = $this->validarController($this->urlConjunto[0]);
			}
			if (isset($this->urlConjunto[1])) {
				$this->urlMetodo = $this->validarMetodo($this->urlConjunto[1]);
			}
			if (isset($this->urlConjunto[2])) {
				$this->urlParametro = (int) $this->urlConjunto[2];
			}else{
				$this->urlParametro = "sem parametros!";
			}

			//echo "<br />Classe Controller: {$this->urlController}";
			//echo "<br />Método: {$this->urlMetodo}";
			//echo "<br />Parâmetro: {$this->urlParametro}";
		}
	}

	public function clearUrl()
	{
		$this->url = strip_tags($this->url);
		$this->url = trim($this->url);
		$this->url = rtrim($this->url, "/");
		self::$formatar = array();
		self::$formatar['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
		self::$formatar['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
		$this->url = strtr(utf8_decode($this->url),utf8_decode(self::$formatar['a']), self::$formatar['b']);
	}

	public function validarController($controller)
	{
		$controller = explode("-", strtolower($controller));
		$controller = implode(" ", $controller);
		$controller = ucwords($controller);
		$controller = str_replace(" ", "", $controller);

		return $controller;
	}

	public function validarMetodo($metodo)
	{
		$metodo = explode("-", strtolower($metodo));
		$metodo = implode(" ", $metodo);
		$metodo = ucwords($metodo);
		$metodo = lcfirst(str_replace( " ", "", $metodo));

		return $metodo;
	}

	public function carregar() {
        //Verifica se a classe que está na urlController existe
        //echo "Classe a ser carregada: {$this->urlController}";
		
		if (class_exists($this->urlController)) {
			try {
				$this->validarSessao();
                // peço para carregar o método
				$this->carregarMetodo();
			} catch (Exception $e) {
				//echo "Erro ao carregar a classe e o método: " . $e->getMessage() . "<br />";
				$this->urlController = $this->validarController(CONTROLLER);
				$this->urlMetodo = $this->validarMetodo(METHOD);
				$this->carregar();
			}
		}else {
			//echo "Erro ao carregar a classe {$this->urlController} <br />";
			$this->urlController = $this->validarController(CONTROLLER);
			$this->urlMetodo = $this->validarMetodo(METHOD);
			$this->carregar();
		}
	}

	public function carregarMetodo(){
		$classeCarregar = new $this->urlController();

        //Verificar se existe o método
		if (method_exists($classeCarregar, $this->urlMetodo)){
            //echo "<br />Método a ser carregador: {$this->urlMetodo}";
			if ($this->urlParametro !== null) {
				$classeCarregar->{$this->urlMetodo}($this->urlParametro);
			}else {
				$classeCarregar->{$this->urlMetodo}();
			}
		}else{
			//echo "<br />Erro ao carregar o método: {$this->urlMetodo}";
			$this->urlController = $this->validarController(CONTROLLER);
			$this->urlMetodo = $this->validarMetodo(METHOD);
			$this->carregar();
		}
	}
	public function validarSessao(){
		unset($_SESSION['msg']);

        // 0-público | 1-cliente | 2-funcionario | 

		$paginasPermissao["Controllerhome"]["index"] = array(0);
		$paginasPermissao["Controllerhome"]["perfil"] = array(1,2);

		$paginasPermissao["Controllerauth"]["auth"] = array(0);
		$paginasPermissao["Controllerauth"]["logout"] = array(1,2);

		$paginasPermissao["Controllerservico"]["exibirservicoscli"] = array(1);
		$paginasPermissao["Controllerservico"]["index"] = array(0);

		$paginasPermissao["Controllerpessoa"]["index"] = array(2);
		$paginasPermissao["Controllerpessoa"]["visualizar"] = array(1,2);
		$paginasPermissao["Controllerpessoa"]["inserir"] = array(0);
		$paginasPermissao["Controllerpessoa"]["buscar"] = array(2);
		$paginasPermissao["Controllerpessoa"]["editar"] = array(1,2);
		$paginasPermissao["Controllerpessoa"]["apagar"] = array(2);

		/*if(!isset($_SESSION['idPessoa'])){
			if(($this->urlController != "ControllerAuth") && ($this->urlMetodo != "auth")){
				$_SESSION['msg'] = "
				<div class=\"alert alert-danger\" role=\"alert\">
				Você não pode acessar esta página.
				Realize o login primeiro!</div>
				";
				$this->urlController = "ControllerAuth";
				$this->urlMetodo = "auth";
			}
		}*/

		if (isset($_SESSION['tipo']) && ($paginasPermissao[$this->urlController][$this->urlMetodo] != 0)){
			$_SESSION['tipo'] = intval($_SESSION['tipo']);
			if (!in_array($_SESSION['tipo'], $paginasPermissao[$this->urlController][$this->urlMetodo])){
				$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
				Você não pode acessar esta página. Permissão Negada!
				</div>";
				$this->urlController = "ControllerHome";
				$this->urlMetodo = "index";
			}

		}/*else{
			$this->urlController = "ControllerAuth";
            $this->urlMetodo = "auth";
        }*/

    }

}

?>