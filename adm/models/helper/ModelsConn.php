<?php
abstract class ModelsConn{
	public static $HOST = HOST;
	public static $USER = USER;
	public static $DBNAME = DBNAME;
	public static $PASS = PASS;
	private static $CONNECT = null;

	public static function conectar(){
		try{
			if (self::$CONNECT == null) {
				self::$CONNECT = NEW PDO('mysql:host=' .self::$HOST.';dbname=' .self::$DBNAME .';charset=utf8',self::$USER, self::$PASS);
				/*
				echo"
				<div class=\"alert alert-success\" role=\"alert\">
				Conectado com sucesso
				</div>
				";
				*/
			}
		}catch (Exception $e){
			echo "
			<div class=\"alert alert-danger\" role=\"alert\">
			Erro: {$e->getMessage()}
			</div>
			";

			die;
		}

		self::$CONNECT->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return self::$CONNECT;
	}

	protected static function getConn(){
		return self::conectar();
	}

}

?>