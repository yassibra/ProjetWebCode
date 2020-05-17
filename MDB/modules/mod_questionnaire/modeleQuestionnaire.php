<?php
	//if (!defined('CONST_INCLUDE'))
	//	die('Accès direct interdit');

	include_once 'modules/mod_connexion/connexion.php';
	//include_once '/home/etudiants/info/nmezdari/local_html/ProjetWebCode/modules/connexion.php';
	Connexion::init_connexion();

	class ModeleQuestionnaire extends Connexion {

		public function __construct() {
			
		}
	
	/*  public function creationQuestionnaire() {
			if (isset($_SESSION['login'])) {
				echo "Vous etes connecté";
			}
		} */

		
		public function recupererThematiques() {
			$sql = 'SELECT libelleThematique from thematique';
			$req = self::$bdd->prepare($sql);
			$req->execute();
			return $req->fetchAll();
			
		}
		public function selectQuestion($id) {
    		$sql = 'SELECT Questions FROM question WHERE idQuestion=:id';
    		$req = self::$bdd->prepare($sql);
    		$req->bindParam(':id', $id);
    		$req->execute();
    		$res = $req->fetch();
    		return $res;
		}
		public function recupererTableauQuestions($thema,$nbquestions) {
			if($thema != "null") {
				
			//	var_dump($thema);
				
				$sql = 'SELECT idQuestion from question inner join thematique using(idThematique) where libelleThematique like "'.$thema.'" order by rand() limit '.$nbquestions.' ' ;	
				$req = self::$bdd->prepare($sql);
				//$req->bindParam(':t', $thematique);
				$req->bindValue(':nbq', stripslashes($nbquestions));
				$req->execute();
				//var_dump($req;
				//
			//	var_dump($req);
			//	echo 'thematique nest pas nulle';
				return $req->fetchAll();	
			} else {			
			$sql = 'SELECT idQuestion from question order by rand() limit '.$nbquestions.' ';
			$req = self::$bdd->prepare($sql);
			//$req->bindValue(':nbq', $nbquestions);
			//var_dump($sql);
			$req->execute();
			echo "thematique est nulle askip";
			//var_dump($thema);	
			}
			return $req->fetchAll();
		}
		public function QuestionnaireParJoueur($idlogin){  
			
			$sql = 'SELECT distinct count(idThematique) from question inner join questionnaire  where DateQuest like "'.$date.'"  and idUtilisateur like "'.$iduser.'" ' ;	
			$req = self::$bdd->prepare($sql);
			//$req->bindParam(':t0', $thematique);
			//$req->bindValue(':nbq', stripslashes($nbquestions));
			$req->execute();
			//var_dump($req;
			//
		//	var_dump($req);
		//	echo 'thematique nest pas nulle';
			return $req->fetchAll();	
			

		}
		public function recupscorebydate($d,$iduser,$nbq){
			$score = 0;
			$sqlfirst = 'SELECT distinct idQuestion from questionnaire where DateQuest like "'.$d.'" and idUtilisateur like "'.$iduser.'" ' ; 
			$reqfirst = self::$bdd->prepare($sqlfirst);
			$reqfirst->execute();
			$tabquestion = $reqfirst->fetchAll(); 
			//var_dump($tabquestion);
			for($i=0; $i < $nbq; $i++) {
				$sqlreponsesalaquest = 'SELECT distinct idReponse from questionnaire where idQuestion = "'.$tabquestion[$i][0].'" ' ;
				$reqrep = self::$bdd->prepare($sqlreponsesalaquest);
				$reqrep->execute();
				$reponses = $reqrep->fetchAll();
				//var_dump($reponses);
				$mauvaiserep=0;
				for($j = 0; $j < count($reponses); $j++) {
					$sql = 'SELECT ReponseDonnee from questionnaire where DateQuest like "'.$d.'" and idUtilisateur like "'.$iduser.'" and idQuestion = "'.$tabquestion[$i][0].'" and idReponse = "'.$reponses[$j][0].'" ' ;	
					$req = self::$bdd->prepare($sql);
					$req->execute();
					$sql2 = 'SELECT ReponseAttendue from theorie where idQuestion = "'.$tabquestion[$i][0].'" and idReponse = "'.$reponses[$j][0].'" ';
					$req2 = self::$bdd->prepare($sql2);
					$req2->execute();
					$res1 = $req->fetchAll();
					$res2 = $req2->fetchAll(); 
					//var_dump($res1[0][0]);
					//var_dump($res2[0][0]);
					if($res1[0][0] != $res2[0][0] ){
						$mauvaiserep++;
					}
					//var_dump($mauvaiserep);
				}
				if($mauvaiserep == 0){
					$score++;
				}				
			}	
			//var_dump($score);
			return $score;
		}
		public function nbquestions($d,$iduser) {
			$sql = 'SELECT distinct (idQuestion) from questionnaire where DateQuest like "'.$d.'" and idUtilisateur like "'.$iduser.'" ' ;	
			$req = self::$bdd->prepare($sql);
			$req->execute();
			//var_dump($sql);
			$res = $req->fetchAll();
			//var_dump(count($res));
			return count($res);	
			
		}
		public function themabydate($d,$nbquestion) {
			$sql = 'SELECT distinct idThematique from question inner join questionnaire using(idQuestion) where DateQuest like "'.$d.'"  ' ;
			//var_dump($sql);	
			$req = self::$bdd->prepare($sql);
			$req->execute();
			$res = count($req->fetchAll());
			if($res == 1){
			
				$sql2 = 'SELECT libelleThematique from thematique inner join question using(idThematique) inner join questionnaire using(idQuestion) where DateQuest like "'.$d.'" ' ;	
				$req2 = self::$bdd->prepare($sql2);
				$req2->execute();
			//	var_dump($sql2);
				$res2 = $req2->fetchAll();
			//	var_dump($res2[0][0]);
				
				return $res2[0][0];
			}else{
				return "Indifférent";
			}
			
		}

		public function recupererTableauQuestionsRecommencer($date,$nbquestions,$iduser) {
			$date = substr($date,0,19);
			$sql = 'SELECT distinct idQuestion from questionnaire  where DateQuest like "'.$date.'"  and idUtilisateur like "'.$iduser.'" order by rand() limit '.$nbquestions.' ' ;	
			$req = self::$bdd->prepare($sql);
			//$req->bindParam(':t', $thematique);
			//$req->bindValue(':nbq', stripslashes($nbquestions));
			$req->execute();
			//var_dump($req;
			//
			//var_dump($req);
			//echo 'thematique nest pas nulle';
			return $req->fetchAll();	
			
			
		}
			
		
		public function recupAlldatebyiduser($iduser){

		
			$sql = 'SELECT distinct DateQuest from questionnaire where  idUtilisateur like "'.$iduser.'" order by DateQuest ' ;	
			$req = self::$bdd->prepare($sql);
			//$req->bindParam(':t', $thematique);
			//$req->bindValue(':nbq', stripslashes($nbquestions));
			$req->execute();
			//var_dump($req;
			//
			//var_dump($req);
			//echo 'thematique nest pas nulle';
			return $req->fetchAll();	
			
		}
		public function selectReponse($id) {
    		$sql = 'SELECT Reponse FROM reponse WHERE idQuestion = :id ';
    		$req = self::$bdd->prepare($sql);
    		$req->bindParam(':id', $id);
    		$req->execute();
    		$res = $req->fetch();
    		shuffle($res);
    		return $res;
		}

		public function selectVrai($i) {
    		$sql = 'SELECT Vrai FROM reponse WHERE idQuestion = :id ';
    		$req = self::$bdd->prepare($sql);
    		$req->bindParam(':id', $i);
    		$req->execute();
    		$res = $req->fetch();
    		shuffle($res);
    		return $res;
		}



		public function selectBonnesReponses(){
			$sql = 'SELECT Reponse FROM reponse WHERE vrai = 1';
			$req = self::$bdd->prepare($sql);
			$req = execute();
			$res = $req->fetch();
			return $res;
		}

		public function showTheImage($image){
        	$nom = self::recupnomImg($image);
        	$var = 'DossierImg/'.$nom;
        	return $var;
        }


		public function recupnomImg($idquestion) {
        	$sql = 'SELECT Image from image inner join question using(idImage) where idQuestion = "'.$idquestion.'" ';
        	$req = self::$bdd->prepare($sql);
        	//$req->bindValue(':id', $idquestion);
        	$req->execute();
        	$res = $req->fetch();
        	return $res[0];
		}
		public function recupQuestion($idquestion){
			$sql = 'SELECT libelleQuestion from question where idQuestion = "'.$idquestion.'" ';
        	$req = self::$bdd->prepare($sql);
        	//$req->bindParam(':id', $idquestion);
        	$req->execute();
			$res = $req->fetch();
			//var_dump($req);
			//var_dump($res);
        	return $res[0];
		}
		public function recupreps($idquestion){
			$sql = 'SELECT LibelleRep from reponse inner join theorie using(idReponse) where idQuestion like :id';
			$req = self::$bdd->prepare($sql);
			$req->bindValue(':id', $idquestion);
			$req->execute();
			$res =$req->fetchAll();
			return $res;
			
		}
		public function recupidUtilisateur($login){
			$sql = 'SELECT idUtilisateur from utilisateur where pseudo = :l ';
        	$req = self::$bdd->prepare($sql);
        	$req->bindParam(':l', $login);
        	$req->execute();
			$res = $req->fetch();
        	return $res[0];
		}
		public function recupidr($librep){
			$sql = 'SELECT idReponse from reponse where LibelleRep = :l ';
        	$req = self::$bdd->prepare($sql);
        	$req->bindParam(':l', $librep);
        	$req->execute();
			$res = $req->fetch();
        	return $res[0];
		}
		public function inserer_ResultatduJoueur($idquestion,$i, $idlogin, $current_date_num,$boolean){
			//var_dump($i);
			//var_dump($current_date_num);
			if($boolean == true){
				$val = 1;
			}else{
				$val = 0;
			}
			$sql = 'INSERT INTO questionnaire (ReponseDonnee, DelaiReponse, idQuestion, idUtilisateur, idReponse, DateQuest) VALUES ("'.$val.'","'.$current_date_num.'" ,"'.$idquestion.'" ,"'.$idlogin.'","'.$i.'","'.$current_date_num.'")';		
			//var_dump($sql);
			$req = self::$bdd->prepare($sql);
			$req->execute();
			/*
							$req->bindValue(':loginn', $idlogin);
							$req->bindValue(':idq', $idquestion);
							$req->bindValue(':bool',$val);
							$req->bindValue(':idrep',$i);
							$req->bindValue(':daate',$current_date_num);
							$req->execute();
	*/
				}
			public function	recupbooltheorie($idrepi){
				$sql = 'SELECT ReponseAttendue from theorie where idReponse = :l ';
				$req = self::$bdd->prepare($sql);
				$req->bindParam(':l', $idrepi);
				$req->execute();
				$res = $req->fetch();
				return $res[0];
			}
			public function recupreponsedonne($idrepi,$date){
				//var_dump($date);
				$sql = 'SELECT ReponseDonnee from questionnaire where idReponse = :l and DateQuest = :d ';
				$req = self::$bdd->prepare($sql);
				$req->bindParam(':l', $idrepi);
				$req->bindParam(':d', $date);
				$req->execute();
				$res = $req->fetch();
				return $res;
			}
		/*public function recuprepslibelle($reponsesid) {
			$newarray = array();
			for($i=0; $i < count($reponsesid); $i++){
				$sql = 'SELECT libelleReponse from reponse where idReponse like :id';
				$req = self::$bdd->prepare($sql);
			}
		}
		*//*public function recuplibelleviaidquestion($idquestion){
			$sql = 'SELECT libelleQuestion from question where idQuestion like :id';
        	$req = self::$bdd->prepare($sql);
        	$req->bindParam(':id', $idquestion);
        	$req->execute();
        	$res = $req->fetch();
        	return $res;

		}*/
	}
	
?>





