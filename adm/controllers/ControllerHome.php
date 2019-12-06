<?php

class ControllerHome {
	
	public function index()
	{
		$carregar = new ConfigView('home/index');
		$carregar->renderizar();
	}

	public function perfil()
	{
		$carregar = new ConfigView('home/perfil');
		$carregar->renderizar();
	}
}