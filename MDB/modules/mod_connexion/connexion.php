 <?php
	class Connexion {

		protected static $bdd;

	   	public static function init_connexion(){
	   		$login = "root";
	   		$password= "";
	   		$dns="mysql:host=localhost;dbname=dutinfopw20165;";
			   self::$bdd = new PDO($dns,$login,$password,array(pdo::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));
			
			// tester ca a liut	
			//$dns="mysql:host=localhost;dbname=dutinfopw20165";
			//self::$bdd2 = new PDO($dns,$login,$password);
	   	}
	}
?>

