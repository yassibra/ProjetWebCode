<?php
if (!defined('CONST_INCLUDE')) {
	die('Accès direct interdit');
}
include_once 'formulaireAdministration.php';
include_once 'vue_administration.php';
Administration::init_connexion();

class ControleurAdministration {
	public $modele;
	public $vue;

	public function __construct() {
			$this->modele = new Administration();
			$this->vue = new VueAdministration();
	}
	public function cverifsiadmin($login){
		return $this->modele->verifsiAdmin($login);
	}
	public function menu() {
		$this->vue->afficherMenuAdmin();
		$choix = htmlspecialchars($_GET['action']);
		if(isset($choix)) {
			switch ($choix) {
				case 'FormQuestions':
	//	$booleanadmin = $this->modele->verifSiAdmin($_SESSION["login"]);
	//		if($booleanadmin == true){
							$listethematique = $this->modele->recupererThematiques();				
							$this->vue->afficherFormQuestions($listethematique);
							
			
	//					}
	//					else{
	//						echo ' tes boxe quitte la page' ;
	//					}
					

				break;
				case 'InsererQR':
					
					if (isset($_FILES['avatar'])) {
					$image = $_FILES['avatar'];
					
					}
					else {
						$image = null;
					
					}
					var_dump($_SESSION["login"]);
					$q = htmlspecialchars($_POST['question']);
					$theme = htmlspecialchars($_POST['valeurthema']);
					$r1 = htmlspecialchars($_POST['rep1']);
					//var_dump($r1);
					$r2 = htmlspecialchars($_POST['rep2']);
					//var_dump($r3);
					$r3 = htmlspecialchars($_POST['rep3']);
					$r4 = htmlspecialchars($_POST['rep4']);
					//var_dump($theme);
					$this->modele->inserer_QR($q,$theme,$r1, $r2, $r3,$r4,$image["name"]);
					break;
				case 'ModificationQuestions':
					/* $this->vue->afficherFormulaireInscription();*/
					$liste=$this->modele->retournerLibelleQuestion();
					$this->vue->afficherMenuModifQ($liste);
					break;
					break;
				case 'ModificationEtatUtilisateur':
			/*		$this->vue->afficherFormulaireConnexion(); 
			*/
					break;
				case 'ModificationEtatModerateur':
			/*	$login = htmlspecialchars($_POST['id']);
				$mdp = hash('sha256', $_POST['mdp']);
				$mailo = htmlspecialchars($_POST['mailo']);
				$this->modele->inserer_BD($login,$mdp,$mailo);
				*/
				
					break;
				case 'ModifQuestChoisie':
						$_SESSION["idq"] = $_GET['id'];
						$libelle=$this->modele->récuplibel(htmlspecialchars($_GET['id']));
						$rep=$this->modele->récuprep(htmlspecialchars($_GET['id']));
						$vraie=$this->modele->récuprepVraie(htmlspecialchars($_GET['id']));
						$img=$this->modele->récupImage(htmlspecialchars($_GET['id']));
						$them=$this->modele->récupThemActuelle(htmlspecialchars($_GET['id']));
						$listThem=$this->modele->recupererThematiques();
						$this->vue->afficherModifQuestionChoisie(htmlspecialchars($_GET['id']),$libelle,$rep,$vraie,$img,$them,$listThem);
						if (isset($_FILES['avatar'])) {
						$image = $_FILES['avatar'];
						
						}
						else {
							$image = null;
							echo 'image nulle ' ;
						}
						$q = htmlspecialchars($_POST['question']);
						$theme = htmlspecialchars($_POST['valeurthema']);
						$r1 = htmlspecialchars($_POST['rep1']);
						$r2 = htmlspecialchars($_POST['rep2']);
						$r3 = htmlspecialchars($_POST['rep3']);
						$r4 = htmlspecialchars($_POST['rep4']);
						//var_dump($theme);
						$this->modele->update_QR($_SESSION["idq"],$q,$theme,$r1, $r2, $r3,$r4,$image["name"]);
						break;
						case 'ModificationEtatUtilisateur':
							$liste=$this->modele->retournerUser();
							$this->vue->afficherListeUtilisateur($liste);
							break;
						case  'ModificationEtatUtilisateurChoisis':
							$pseudo=$this->modele->getPseudo(htmlspecialchars($_GET['id']));
							$mail=$this->modele->getMail(htmlspecialchars($_GET['id']));
							$this->vue->afficherModifUtilisateurChoisis(htmlspecialchars($_GET['id']), $pseudo, $mail);
							$p = htmlspecialchars($_POST['pseudo']);
							$m = htmlspecialchars($_POST['mail']);
							$this->modele->updateUser($p, $m, $_GET['id']);
							break;
						case 'PromotionUtilisateur':
							$liste=$this->modele->retournerUser();
							$this->vue->afficherListeUtilisateur($liste);
							break;
						case 'PromotionUtilisateurChoisis':
							$this->vue->afficherPromotionUtilisateurChoisis(htmlspecialchars($_GET['id']));
							$p = htmlspecialchars($_POST['upgrade']);
							if($p == 'upgrade') {
								$this->modele->updateAdmin(htmlspecialchars($_GET['id']));
							} else {
								echo "boxe";
							}
							break;
						case 'SupprimerUtilisateur':
							$liste=$this->modele->retournerUser();
							$this->vue->afficherListeUtilisateur($liste);
							break;
						case 'SupprimerUtilisateurChoisis':
							$this->vue->afficherSuppressionUtilisateurChoisis(htmlspecialchars($_GET['id']));
							$p = htmlspecialchars($_POST['delete']);
							if($p == 'delete') {
								$this->modele->deleteUser(htmlspecialchars($_GET['id']));
							} else {
								echo "boxe";
							}
							break;
				}
		}
	}
	
	public function afficherVue() {
		$this->vue->affichageBasique();
	}
	
}

?>