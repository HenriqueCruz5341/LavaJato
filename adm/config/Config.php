<?php

session_start();
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'LavaJato');
define('URL', 'http://127.0.0.1/LavaJato1/adm/');

//definindo controller e métodos padrao

define('CONTROLLER', 'controller-home');
define('METHOD', 'index');

function __autoload($class){
	$dirName = array(
		'Config',
		'controllers',
		'models',
		'models/helper',
		'views',
		'views/pessoa',
		'views/tipoServico',
		'views/carro',
		'views/servico',
		'views/produto'
	);

	foreach ($dirName as $diretorios) {
		if (file_exists("{$diretorios}/{$class}.php")){
			require("{$diretorios}/{$class}.php");
		}
	}
}

