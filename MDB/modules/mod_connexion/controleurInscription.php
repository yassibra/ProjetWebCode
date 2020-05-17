<?php
if (!defined('CONST_INCLUDE'))
	die('Accès direct interdit');

include_once 'formulaireInscription.php';
include_once 'vue_inscription.php';
// Inscription::init_connexion();

class ControleurInscription {
	private $modele;
	private $vue;

	public function __construct () {
			$this -> modele = new Inscription();
			$this -> vue = new VueInscription();
	}
	
	public function menu() {
		$action = htmlspecialchars($_GET['action']);
		switch ($action) {
		case 'FormInscription':
			$this -> vue -> afficherFormulaireInscription();
		break;
		case 'FormConnexion':
			$this -> vue -> afficherFormulaireConnexion();
		break;
		case 'inscription':
			$login = htmlspecialchars($_POST['id']);
			$mdp = hash('sha256', $_POST['mdp']);
			$mailo = htmlspecialchars($_POST['mailo']);
			$this -> modele -> inserer_BD($login,$mdp,$mailo);
		break;
		case 'connexion' :
			$login = htmlspecialchars($_POST['id']);
			$mdp = hash('sha256', $_POST['mdp']);
			$newv = $this->modele->verif_connexion($login,$mdp);
			if($newv == 1) {
				$_SESSION["login"] = $login;
				//$this->vue-> affichageAdmin();
					
			}
			//$_SESSION["login"] = $login;
			//header('Location: index.php');
			break;
		case 'Deconnexion' :
			unset($_SESSION["id"]);
			unset($_SESSION["login"]);
			session_destroy();
			$this->vue->afficherFormulaireConnexion();
		default:
		break;
		}
	}

	public function afficherVue() {
		$this->vue->affichageBasique();
	}
}

?>