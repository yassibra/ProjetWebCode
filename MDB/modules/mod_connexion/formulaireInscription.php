<?php
	
	include_once 'connexion.php';
	Connexion::init_connexion();

	if (!defined('CONST_INCLUDE'))
		die('Accès direct interdit');

	class Inscription extends Connexion{

		public function __construct(){			
		}

		function inserer_BD($id,$mdp,$mailo){
				if(!self::verif_unicite_identifiant($id)){
					
					if(self::verif_mail_valide($mailo)){

						if( !self::verif_unicite_mail($mailo)){

					
							$sql = 'INSERT INTO utilisateur (idUtilisateur, pseudo, mail, motdepasse, estModerateur, Etat) VALUES (default, :login, :maila, :mdp, default, default)';
							$req = self::$bdd -> prepare($sql);
							$req -> bindParam(':login', $id);
							$req -> bindParam(':mdp', $mdp);
							$req -> bindParam(':maila',$mailo);
							$req -> execute();
						}
						else {
							echo "Un compte est déjà attribué pour cette adresse" ;
						}
					} 
					else {
						echo "Le mail n'est pas valide ! " ;
					}
				}
				else {
					echo "identifiant déjà pris";
				}
		}

		function verif_connexion($id,$mdp){
			$sql = 'SELECT idUtilisateur from utilisateur where pseudo like :login and motdepasse like :mdp';
			$req = self::$bdd -> prepare($sql);
			$req -> bindParam(':login', $id);
			$req -> bindParam(':mdp', $mdp);
			$req -> execute();
			$res = $req -> fetch();
			if(!isset($res[0])) {
				echo"identifiant ou mot de passe incorrect";
				return 0;
			}
			else {
				
				$_SESSION["login"]=$id;
				return 1;
			}
			
		}
		function verif_mail_valide($mailo){
			if(filter_var($mailo, FILTER_VALIDATE_EMAIL)) {
   				list($userName, $domaineMail) = explode("@", $mailo);
    			if (!checkdnsrr($domaineMail, "MX")){
				// Email is unreachable.
				return false;
				}
				return true;
			}
			else{
				// Email is bad.
				return false;
			}
		}
		function verif_unicite_mail($mailo){
			$sql = 'SELECT idUtilisateur from utilisateur where mail like :maila';
			$req = self::$bdd -> prepare($sql);
			$req -> bindParam(':maila', $mailo);
			$req -> execute();
			$res = $req -> fetch();
			if(isset($res[0])){
				return true;
			}
			else{
				return false;
			}
			
		}
		function verif_unicite_identifiant($id){
			$sql = 'SELECT idUtilisateur from utilisateur where pseudo like :login';
			$req = self::$bdd -> prepare($sql);
			$req -> bindParam(':login', $id);
			$req -> execute();
			$res = $req -> fetch();
			if(isset($res[0])){
				return true;
			}
			else{
				return false;
			}
		}
	}
?>