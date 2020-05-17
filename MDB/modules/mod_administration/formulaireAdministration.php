<?php 
    
    include_once 'modules/mod_connexion/connexion.php';

    Connexion::init_connexion();

    class Administration extends Connexion{

    public function __construct(){			
    }
    public function verifsiAdmin($login) {
            $sql = "SELECT estModerateur from utilisateur where pseudo like :id";
            $req = self::$bdd->prepare($sql);
            $req->bindParam(':id', $login);
            $req->execute();
            $res = $req->fetch();
            if ($res[0] == 1 ){
              return true;
            } else {              
                return false; 
            }
            
    }
    public function inserer_QR($q,$theme,$r1,$r2,$r3,$r4,$image){
        //if(theme_existe($theme)){ 
            self::insererI($image);
            $idimage = self::recuperer_idI($image);

            $idtheme = self::recuperer_idT($theme);
            var_dump($idimage);
            $sql = "INSERT INTO question (idQuestion, libelleQuestion, idImage, idThematique) VALUES (default,:quest,:idI,:idT)";

            $req = self::$bdd->prepare($sql);
            $req->bindParam(':quest', $q);
            $req->bindParam(':idT', $idtheme);
            $req->bindParam(':quest', $q);
            $req->bindParam(':idI', $idimage);
            $req->execute();
        
            $quest_id = self::recuperer_idQ($q);
        
            for($i=1; $i < 5; $i++ ){
            self::insererR(${"r".$i});
            if(self::verif_si_R_non_nulle(${"r".$i})){
               if(isset($_POST['choix'.$i])) {
                $valreponse = 1;
               } 
               else {
                $valreponse = 0;
               }
            //svar_dump($valreponse);
            $rep_id = self::recuperer_idR(${"r".$i});
            $sql2 = 'INSERT INTO theorie (ReponseAttendue, idReponse, idQuestion) VALUES (:valrep, :idrep, :idquest)'; 
            $req2 = self::$bdd->prepare($sql2);
            $req2->bindParam(':idrep', $rep_id);
            $req2->bindParam(':idquest', $quest_id);
            $req2->bindParam(':valrep', $valreponse);
            $req2->execute();
            }
        }           
    }   
    public function update_QR($idq, $q,$theme,$r1,$r2,$r3,$r4,$image){
            $sql = 'UPDATE question SET libelleQuestion = "'.$q.'", idImage = "'.$image.'", idThematique = "'.$theme.'" WHERE idQuestion = "'.$idq.'" '; 	
			$req = self::$bdd->prepare($sql);
			$req->execute();
			//var_dump($sql);
            $res = $req->fetchAll();
            $sqll = 'Select idReponse from theorie where idQuestion = "'.$idq.'" ';
            $reqrep = self::$bdd->prepare($sqll) ;
            $reqrep->execute();
            $reps = $reqrep->fetchAll(); 
            for($i=1; $i < 5; $i++ ){
                //self::insererR(${"r".$i});
                if(self::verif_si_R_non_nulle(${"r".$i})){
                   if(isset($_POST['choix'.$i])) {
                    $valreponse = 1;
                   } 
                   else {
                    $valreponse = 0;
                   }
                //svar_dump($valreponse);
                    $rep_id = self::recuperer_idR(${"r".$i});
                    $sql2 = 'UPDATE theorie SET ReponseAttendue = "'.$valreponse.'" WHERE idReponse = "'.$rep_id.'" '; 
                    $req2 = self::$bdd->prepare($sql2);
                    $req2->execute();
                    if(empty($req2->fetchAll())){
                        
                        for($i=1; $i < 5; $i++ ){
                            self::insererR(${"r".$i});
                            if(self::verif_si_R_non_nulle(${"r".$i})){
                                if(isset($_POST['choix'.$i])) {
                                    $valreponse = 1;
                                } 
                                else {
                                    $valreponse = 0;
                                }
                                //svar_dump($valreponse);
                                $rep_id = self::recuperer_idR(${"r".$i});
                                $sql3 = 'INSERT INTO theorie (ReponseAttendue, idReponse, idQuestion) VALUES (:valrep, :idrep, :idquest)'; 
                                $req3 = self::$bdd->prepare($sql3);
                                $req3->bindParam(':idrep', $rep_id);
                                $req3->bindParam(':idquest', $idq);
                                $req3->bindParam(':valrep', $valreponse);
                                $req3->execute();
                                
                            }
                        }
                    }     
            //$sql2 = update 
                }
            //var_dump(count($res));
            }
            		
          
    }
    public function insererI($image) {
        
        $sql = "INSERT INTO image (idImage, Image) VALUES (default, '$image')";
        $req = self::$bdd->prepare($sql);
        $req->execute();
        //echo 'cest censé sauvegarder limage dans la bd' ;
       /*
        $sql3 = "SELECT idImage from image where Image like '$image'";
        $req3 = self::$bdd->prepare($sql3);
        $req3->execute();
        $res3 = $req3->fetch();
        $idimg = $res3[0];
        var_dump($idimg);




         
        $sql2 = "SELECT Image from image where idImage like 18 ";
        $req2 = self::$bdd->prepare($sql2);
        //$req2->bindParam(':id', $idimg);
        $req2->execute();
        var_dump($req2);
       // $req2->fetch();
        $res2 = $req2->fecth();
        var_dump($res2[1]);
        echo 'simple';
        ?>
          <img height="300" width="300" src="data:image/jpeg;base64,<?php echo base64_encode($res2[0]); ?>"/>
         <?php 
        
        */
    }
    public function recuperer_idI($image) {
        $sql = "SELECT idImage from image where Image like :img ";
        $req = self::$bdd->prepare($sql);
        $req->bindParam(':img', $image);
        $req->execute();
        $res = $req->fetch();
        return $res[0];
    }  
    public function recuperer_idQ($q) {
        $sql = "SELECT idQuestion from question where LibelleQuestion like :quest";
        $req = self::$bdd->prepare($sql);
        $req->bindParam(':quest', $q);
        $req->execute();
        $res = $req->fetch();
        return $res[0];
    } 

    public function recuperer_idT($theme) {
        $sql = "SELECT idThematique from thematique where libelleThematique like :thema";
        $req = self::$bdd->prepare($sql);
        $req->bindParam(':thema', $theme);
        $req->execute();    
        $res = $req->fetch();
        return $res[0];
    }

    public function insererR($reponse){

        if(self::verif_si_R_non_nulle($reponse)){
            if(self::verif_si_R_existe_pas($reponse)){
                var_dump($reponse);
                $sql = 'INSERT INTO reponse (idReponse, LibelleRep) VALUES (default, :rep)';
                $req = self::$bdd->prepare($sql);
                $req->bindParam(':rep', $reponse);
                $req->execute();
            }
        }
    }

    public function verif_si_R_non_nulle($reponse){
        if($reponse == ""){
            return false ;
        }
        return true;

        
    }

    public function verif_si_R_existe_pas($reponse){
        $sql = 'SELECT idReponse from reponse where LibelleRep like :rep';
        $req = self::$bdd->prepare($sql);
        $req->bindParam(':rep', $reponse);
        $req->execute();
        $res = $req->fetch();
        if(isset($res[0])){

            return false;
        }
        else{
            return true;
        } 
    }
    public function recuperer_idR($reponse){
        $sql = 'SELECT idReponse from reponse where LibelleRep like :rep';
        $req = self::$bdd->prepare($sql);
        $req->bindParam(':rep', $reponse);
        $req->execute();
        $res = $req->fetch();
        return $res[0];
    }
    
    public function verif_unicite_identifiant($id){
        $sql = 'SELECT idUtilisateur from utilisateur where pseudo like :login';
        $req = self::$bdd->prepare($sql);
        $req->bindParam(':login', $id);
        $req->execute();
        $res = $req->fetch();
        if(isset($res[0])){
            return true;
        }
        else{
            return false;
        }
    }
    public function recupererThematiques() {
        $sql = 'SELECT libelleThematique from thematique';
        $req = self::$bdd->prepare($sql);
        $req->execute();
        return $req->fetchAll();
        
    }



public function retournerLibelleQuestion() {
    $sql = "SELECT idQuestion, libelleQuestion, idThematique from question";
    $req = self::$bdd->prepare($sql);
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}

public function updateQuestion($id, $value) {
    $sql = "UPDATE question SET libelleQuestion = $value WHERE idQuestion = :id";
    $req = self::$bdd->prepare($sql);
    $req->bindParam(':id', $id);
    $req->execute();
}

public function updateThemaique ($id, $value) {
    $sql1 = "SELECT idThematique FROM Question WHERE idQuestion=:id";
    $req1 = self::$bdd->prepare($sql1);
    $req1->bindParam(':id', $id);
    $req1->execute();
    $res1 = $req1->fetch();
    $sql = "UPDATE thematique SET libellleThematique = $value WHERE idThematique=$res1";
    $req = self::$bdd->prepare($sql);
    $req->execute();
}

public function updateReponse($id, $value) {
    $sql1 = "SELECT idReponse FROM Theorie WHERE idQuestion=:id";
    $req1 = self::$bdd->prepare($sql1);
    $req1->bindParam(':id', $id);
    $req1->execute();
    $res1 = $req1->fetch();
    $sql = "UPDATE reponse SET libelleReponse = $value WHERE idReponse = $res1";
    $req = self::$bdd->prepare($sql);
    $req->execute();
}

public function updateImage($id, $value) {
    $sql1 = "SELECT idImage FROM question WHERE idQuestion = :id";
    $req1 = self::$bdd->prepare($sql1);
    $req1->bindParam(':id', $id);
    $req1->execute();
    $res1 = $req1->fetch();
    $sql = "UPDATE image SET Image = $value WHERE idImage = $res1";
    $req = self::$bdd->prepare($sql);
    $req->execute();
}

public function récuplibel($id){
    $sql="SELECT LibelleQuestion FROM question WHERE idQuestion = :id";
    $req = self::$bdd->prepare($sql);
    $req->bindParam(':id', $id);
    $req->execute();
    $res= $req->fetch();
    return $res[0];
}

public function récuprep($id){
    $sql="SELECT LibelleRep FROM reponse inner join theorie on (reponse.idReponse = theorie.idReponse) WHERE idQuestion = :id";
    $req = self::$bdd->prepare($sql);
    $req->bindParam(':id', $id);
    $req->execute();
    $res= $req->fetchAll();
    return $res;
}

public function récuprepVraie($id){
    $sql="SELECT LibelleRep FROM reponse inner join theorie on (reponse.idReponse = theorie.idReponse) WHERE idQuestion = :id and ReponseAttendue=1";
    $req = self::$bdd->prepare($sql);
    $req->bindParam(':id', $id);
    $req->execute();
    $res= $req->fetch();
    return $res[0];
}

public function récupImage($id){
    $sql="SELECT Image FROM image inner join question on (image.idImage = question.idImage) WHERE idQuestion = :id";
    $req = self::$bdd->prepare($sql);
    $req->bindParam(':id', $id);
    $req->execute();
    $res= $req->fetch();
    return $res[0];
}

public function récupThemActuelle($id){
    $sql="SELECT libelleThematique FROM thematique inner join question on (thematique.idThematique = question.idThematique) WHERE idQuestion = :id";
    $req = self::$bdd->prepare($sql);
    $req->bindParam(':id', $id);
    $req->execute();
    $res= $req->fetch();
    return $res[0];
}
public function retournerUser() {
    $sql = "SELECT idUtilisateur, pseudo from utilisateur";
    $req = self::$bdd->prepare($sql);
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}

public function getPseudo($id) {
    $sql = "SELECT pseudo from utilisateur where idUtilisateur=:id";
    $req = self::$bdd->prepare($sql);
    $req->bindParam(':id', $id);
    $req->execute();
    $res= $req->fetch();
    return $res[0];
}

public function getMail($id) {
    $sql = "SELECT mail from utilisateur where idUtilisateur=:id";
    $req = self::$bdd->prepare($sql);
    $req->bindParam(':id', $id);
    $req->execute();
    $res= $req->fetch();
    return $res[0];
}

public function updateUser($npseudo, $nmail, $id) {
    $sql = "UPDATE utilisateur SET pseudo = :p, mail = :m where idUtilisateur=:id";
    $req = self::$bdd->prepare($sql);
    $req->bindParam(':id', $id);
    $req->bindParam(':p', $npseudo);
    $req->bindParam(':m', $nmail);
    $req->execute();
    $res= $req->fetch();
    return $res[0];
}

public function deleteUser($id) {
    $sql = "DELETE FROM utilisateur WHERE idUtilisateur=:id";
    $req = self::$bdd->prepare($sql);
    $req->bindParam(':id', $id);
    $req->execute();
    $res= $req->fetch();
    return $res[0];
}

public function getAllNotAdmin() {
    $sql = "SELECT idUtilisateur, pseudo FROM utilisateur WHERE estModerateur IS NULL";
    $req = self::$bdd->prepare($sql);
    $req->execute();
    $res= $req->fetch();
    return $res[0];
}
/*
public function getAllNotAdmin() {
    $sql = "SELECT idUtilisateur, pseudo FROM utilisateur WHERE estModerateur==1";
    $req = self::$bdd->prepare($sql);
    $req->execute();
    $res= $req->fetch();
    return $res[0];
} */

public function updateAdmin($id) {
    $sql = "UPDATE utilisateur SET estModerateur=1 where idUtilisateur=:id";
    $req = self::$bdd->prepare($sql);
    $req->bindParam(':id', $id);
    $req->execute();
    $res= $req->fetch();
    return $res[0];
}

}
?>