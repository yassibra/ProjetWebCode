<?php 



Class VueQuestionnaire {

	public function __construct() {
	}

	public function afficherchoixThematique($mesthematiques){
		?>
		<form class="text-center btn btn-rounded peach-gradient float-middle " style="color: #757575; align=center;  margin-left: 40%; margin-right: 40%  ;" action="index.php?modules=questionnaire&action=QetR" method="post">
		
		<div class="md-form">
		<input type="number" id="materialLoginFormEmail" Placeholder="Nombre de questions dans ce questionnaire" name="nombredequestions" class="form-control">
		<label for="materialLoginFormEmail"></label>
		</div>

		<select class="mdb-select md-form colorful-select dropwdown-danger" id="themechoisi" name="themechoisi" width="500">
							<option value="null" > <?php echo "indifferent" ?> </option>
							<?php foreach ($mesthematiques as $o) {
							?>
								<option class="peach-gradient" value="<?php echo $o['libelleThematique'] ?>"> <?php echo $o['libelleThematique'] ?> </option>
							<?php 	 		
							}
							?>
							 
				<label class="mdb-main-label">Label example</label>
				<button class="btn-save btn btn-danger btn-sm">Save</button>
			</select>
			<button class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0 " type="submit"> Soumettre </button>
			<?php 
	}	
	//public function afficherTypeQuestionnaire(){}
	public function affichageQuestionetRep($libellequestion, $numeroquestion,$nomimg){
		$numq = $numeroquestion + 1;
		if($numq != $_SESSION["nbquestions"]) {
			$lien = "index.php?modules=questionnaire&action=QetR";
		}
		else {
			$lien = "index.php?modules=questionnaire&action=FinQuestionnaire";
		}
		?>
		<form class="text-center btn btn-rounded peach-gradient float-middle " style="color: #757575; margin-left: 20%; margin-right: 20% " action="<?php echo $lien ; ?>" method="post">
		
		<img src="DossierImg/<?php echo $nomimg ?> " width="380px">
		 
		 <h1>	Question n° <?php echo $numq ." ". $libellequestion ?> ! </h1>
	
		<?php
		shuffle($_SESSION["reponsesid"]);	
		//var_dump($_SESSION["reponsesid"][0][0]);
		//var_dump($_SESSION["reponsesid"][1][0]);
		?> <div style="width: 100%;">
		<?php
		for($i=0; $i < 4; $i++ ){
            if(!empty($_SESSION["reponsesid"][$i][0])){
				?>
				<input type="checkbox"  id="check$i" name="tabrep[]" value="<?php echo $_SESSION["reponsesid"][$i][0] ?>">
				<label> <?php echo $_SESSION["reponsesid"][$i][0] ?> </label>
			<?php 
			}
		}	
		?>
		</div>
		<?php 
			//on peut avoir $_SESSION["reponsesid"] comme étant les id des reponses lie a la questions aussi 
		
	 	?>
			<button class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0 " type="submit"> Valider la reponse </button>
		</form>
	<?php 
	
	}

	public function finQuestionnaire($score, $date) {    
   		?>
		<div style="width: 100%;">
			<form class="text-center btn btn-rounded peach-gradient float-middle " style="color: #757575; margin-left: 25%;" action="index.php?modules=questionnaire&action=QetR" method="post" class="form-group">
				<h2 style="<?php if(($score * 100)/$_SESSION["nbquestions"] >=87){ echo 'color:#00FFBF';} else{ echo 'color:red'; } ?>">Votre nombre de points est de <?php  echo $score  . "/ ". $_SESSION["nbquestions"] ; ?> </h2>
				<button type="submit" class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0 " name="recommencer">Recommencer </button>
			</form>';
			<form class="text-center btn btn-rounded peach-gradient float-middle " style="color: #757575; position: centered; display: inline-block; " action="index.php?modules=questionnaire&action=MesQuestionnaires" method="post" class="form-group">
				<button type="submit" class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0 " style="height: 90px;" name="mesquestionnaires ">Mes Questionnaires </button>
			</form>';
		</div>
		<?php 
		
		unset($_SESSION["questionencours"]);
	} 	
	public function affichageMesQuestionnaires($varf){
		$numeroquestionnaire = 0;
		foreach($varf as $v){
			$numeroquestionnaire++;
			?> <a href="Q&R" class="card border-info mb-3" style="max-width: 20rem; margin-top: 20px; margin-left: 12px; display: inline-block;">
				<div class="card-header peach-gradient" > Questionnaire numero <?php echo $numeroquestionnaire  ;?> </div>
					<div class="card-body text-info">
						<h3 class="" style="<?php if(($v[0] * 100)/$v[2] >=50){ echo 'color:#00FFBF';} else{ echo 'color:red'; } ?>" > Score  <?php echo  $v[0] ;?> / <?php echo  $v[2] ;?> </h3>
						<h5 class="card-title"> Thematique  <?php echo  $v[1] ;?>  </h5>
						<h10 class="card-title"> Réalisé le <?php echo  $v[3] ;?> .</h10>
					</div>
			</a>
			<?php
		}
	}
	public function afficherImage($string) {
		echo '<img src='.$string.' class="rounded" alt="Responsive image">';
	}

}?>






















