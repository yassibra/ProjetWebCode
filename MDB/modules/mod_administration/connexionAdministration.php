<?php
	class ConnexionAdministration {

		protected static $bdd2;

	   	public static function init_connexion(){
	   		$login = "root";
	   		$password= "";
	   		$dns="mysql:host=localhost;dbname=dutinfopw20165";
			self::$bdd2 = new PDO($dns,$login,$password);
	   	}
	}
?>
