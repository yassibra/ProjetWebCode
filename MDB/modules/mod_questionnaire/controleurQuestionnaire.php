<?php

if (!defined('CONST_INCLUDE')) {
	die('Accès direct interdit');
}
include_once 'modeleQuestionnaire.php';
include_once 'vueQuestionnaire.php';


class ControleurQuestionnaire  {
	private $modele;
	private $vue;
	
	function __construct() {
		$this->modele = new ModeleQuestionnaire();
		$this->vue = new VueQuestionnaire();
	}
	public function menu(){
		$action = htmlspecialchars($_GET['action']);
		switch($action) {
			case 'Questionnaire': 
				unset($_SESSION["nombrequestions"]);
				unset($_SESSION["mesquestions"]);
				unset($_SESSION["idquestion"]);
				unset($_SESSION["currentdate"]);
				unset($_SESSION["reponsesid"]);
				unset($_SESSION["theme"]);
				$listethematique = $this->modele->recupererThematiques();
				$arraydequestions = $this->vue->afficherchoixThematique($listethematique);
				
			break;
			case 'MesQuestionnaires':
				$_SESSION["idlogin"] = $this->modele->recupidUtilisateur($_SESSION["login"]);	
				$datequestionnaires = $this->modele->recupAlldatebyiduser($_SESSION["idlogin"]);
				$compteurquestionnaire = 0;
				
				foreach($datequestionnaires as $d) {
					//var_dump($d);
					$compteurquestionnaire++;
					$varf[$compteurquestionnaire][2] = $this->modele->nbquestions($d[0],$_SESSION["idlogin"]);
					$varf[$compteurquestionnaire][0] = $this->modele->recupscorebydate($d[0],$_SESSION["idlogin"],$varf[$compteurquestionnaire][2]);
					
					$varf[$compteurquestionnaire][1] = $this->modele->themabydate($d[0],$varf[$compteurquestionnaire][2]);
					$varf[$compteurquestionnaire][3] = $d[0];
					//var_dump($varf[$compteurquestionnaire][1] = $this->modele->themabydate($d[0],$varf[$compteurquestionnaire][2]));
					
					//var_dump($varf[$compteurquestionnaire][2] = $this->modele->nbquestions($d[0],$_SESSION["idlogin"]));
				} 
				$this->vue->affichageMesQuestionnaires($varf);
				//var_dump($varf);
				//var_dump($allquestionnaires);

				//$this->vue->afficherAllQuestionnaires($allquestionnaires);
				//score + thematique + Date + nbQuestions
			break; 
			case 'RecupQuestions':
				/*$nombrequestions = htmlspecialchars($_POST['nombredequestions']);
				$theme = htmlspecialchars($_POST['themechoisi']);
				$mesquestions = $this->modele->recupererTableauQuestions($theme,$nombrequestions);
				*/
				/*
				TROIS TRUCS
				Questionnaire n'importe quels questions
				Questionnaire questions fausses
				Questionnaire questions reussies


				*/
			break;
			case 'finOuPasQuestionnaire';
				/*
				$q = htmlspecialchars($_POST['question']);
				$r1 = htmlspecialchars($_POST['rep1']);
				$r2 = htmlspecialchars($_POST['rep2']);
				$r3 = htmlspecialchars($_POST['rep3']);
				$r4 = htmlspecialchars($_POST['rep4']);
				//var_dump($theme);
				$this->modele->inserer_ResultatduJoueur($q,$theme,$r10, $r2, $r3,$r4);
				//arraySplice truc comme ca ici
				// if tableau vide
				*/ 
			break;
			case 'QetR':
				if (!isset($_SESSION["questionencours"])){
					if(isset($_SESSION["current_date"])) {
						$_SESSION["questionencours"] = 0;	
						$_SESSION["mesquestions"] = $this->modele->recupererTableauQuestionsRecommencer($_SESSION["current_date"],$_SESSION["nbquestions"],$_SESSION["idlogin"]);
						$_SESSION["current_date"]  = date("Y-m-d H:i:s.u", time());
						
					
					} else{

					
					$_SESSION["current_date"]  = date("Y-m-d H:i:s.u", time());
					
					$_SESSION["questionencours"] = 0;
					$_SESSION["nbquestions"] = htmlspecialchars($_POST['nombredequestions']);
					$_SESSION["idlogin"] = $this->modele->recupidUtilisateur($_SESSION["login"]);
					
					
					$_SESSION["theme"] = htmlspecialchars($_POST['themechoisi']);
					$_SESSION["mesquestions"] = $this->modele->recupererTableauQuestions($_SESSION["theme"],$_SESSION["nbquestions"]);
					}
				} else {
					//$q = htmlspecialchars($_POST['question']);
					//var_dump($_SESSION["reponsesid"]);
					//var_dump($_SESSION["idquestion"]);
					$reponsescoches = isset($_POST['tabrep']) ? $_POST['tabrep'] : array();
					//var_dump($reponsescoches);
					//var_dump($_SESSION["reponsesid"][0][])
					for( $i=0; $i < 4; $i++) {
						if(!empty($_SESSION["reponsesid"][$i])) {
							if(in_array($_SESSION["reponsesid"][$i][0],$reponsescoches)) {
								//${"r".$i} = htmlspecialchars($_POST[$_SESSION["reponsesid"][$i][0]]);
								//echo' issayt'; 
								$booool = true;
								$idr = $this->modele->recupidr($_SESSION["reponsesid"][$i][0]);
								$this->modele->inserer_ResultatduJoueur($_SESSION["idquestion"][0],$idr, $_SESSION["idlogin"], $_SESSION["current_date"],$booool);
					 
							}
							else {
								//${"r".$i} = 0;
								//echo ' else autrement dit 0';
								$booool = false;
								$idr = $this->modele->recupidr($_SESSION["reponsesid"][$i][0]);
								$this->modele->inserer_ResultatduJoueur($_SESSION["idquestion"][0],$idr, $_SESSION["idlogin"], $_SESSION["current_date"],$booool);
							}
						}
					}
					//$this->modele->inserer_ResultatduJoueur($_SESSION["idquestion"],$r1, $r2, $r3,$r4, $_SESSION["idlogin"], $_SESSION["current_date"]);
					
					//var_dump($theme);
					//$this->modele->inserer_ResultatduJoueur($_SESSION["idquestion"],$r1, $r2, $r3,$r4, $_SESSION["idlogin"], $_SESSION["current_date"]);
					$_SESSION["questionencours"]++;
					//var_dump($_SESSION["questionencours"]);
				}	
					//var_dump($_SESSION["mesquestions"]);
					
					if(isset($_SESSION["mesquestions"])){
					//	echo 'tesboxe';
					
						$_SESSION["idquestion"] = $_SESSION["mesquestions"][$_SESSION["questionencours"]];
						
						//var_dump($_SESSION["idquestion"][0]);
						
						$_SESSION["reponsesid"] = $this->modele->recupreps($_SESSION["idquestion"][0]);
						//var_dump($_SESSION["reponsesid"]);	
						//$reponseslibelle = $this->modele->recuprepslibelle($_SESSION["reponsesid"]);
						$libellequestion = $this->modele->recupQuestion($_SESSION["idquestion"][0]);
						$nomimg = $this->modele->recupnomImg($_SESSION["idquestion"][0]);
						//var_dump($nomimg);
						$this->vue->affichageQuestionetRep($libellequestion, $_SESSION["questionencours"],$nomimg);
					}
				
			break;
			case 'FinQuestionnaire':
				//var_dump($theme);
				$reponsescoches = isset($_POST['tabrep']) ? $_POST['tabrep'] : array();
					//var_dump($reponsescoches);
					//var_dump($_SESSION["reponsesid"][0][])
					for( $i=0; $i < 4; $i++) {
						if(!empty($_SESSION["reponsesid"][$i])) {
							if(in_array($_SESSION["reponsesid"][$i][0],$reponsescoches)) {
								//${"r".$i} = htmlspecialchars($_POST[$_SESSION["reponsesid"][$i][0]]);
								
								$booool = true;
								$idr = $this->modele->recupidr($_SESSION["reponsesid"][$i][0]);
								$this->modele->inserer_ResultatduJoueur($_SESSION["idquestion"][0],$idr, $_SESSION["idlogin"], $_SESSION["current_date"],$booool);
					 
							}
							else {
								//${"r".$i} = 0;
							
								$booool = false;
								$idr = $this->modele->recupidr($_SESSION["reponsesid"][$i][0]);
								$this->modele->inserer_ResultatduJoueur($_SESSION["idquestion"][0],$idr, $_SESSION["idlogin"], $_SESSION["current_date"],$booool);
							}
						}
					}
					$score = 0;
					$i = 0;
					
					foreach($_SESSION["mesquestions"] as $value){
						$_SESSION["idquestion"] = $_SESSION["mesquestions"][$i];
						$_SESSION["reponsesid"] = $this->modele->recupreps($_SESSION["idquestion"][0]);
						$point = true;
						$j = 0;
						foreach($_SESSION["reponsesid"] as $repi){
							//var_dump($repi);
							$idrepi = $this->modele->recupidr($repi[0]);
							//var_dump($idrepi);
							$boolquestionnaire = $this->modele->recupreponsedonne($idrepi,$_SESSION["current_date"]);
							//var_dump($boolquestionnaire);
							$booltheorie = $this->modele->recupbooltheorie($idrepi); 
							//var_dump($booltheorie);
							
							if($boolquestionnaire[0] != $booltheorie){
								$point = false;
							}
							$j++;
						}
						if($point == true){
							$score++;
						}
						$i++;
					}
					//var_dump($score);
					$this->vue->finQuestionnaire($score,$_SESSION["current_date"]);
					//$score = $this->modele->recupererScore($_SESSION["current_date"]);

				//session_destroy();
				//$this->vue->finQuestionnaire($score);
			break;
		}
	}
/*
	public function questionnaireStart($id) {
		$this->vue->hautDuQuestionnaire();
		$question = $this->modele->selectQuestion($id);
		$reponses = $this->modele->selectReponse($id);
		$vrai = $this->modele->selectVrai($id);
		$this->vue->afficherQuestions($reponses, $question, $vrai);	
	}
*/
	



	
}