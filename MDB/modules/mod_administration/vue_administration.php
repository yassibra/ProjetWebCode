<?php
	Class VueAdministration {
		function afficherFormQuestions($liste){
				?>
				<div class="card">

<h5 class="card-header info-color white-text text-center py-4" style="margin-bottom: 2	0px;">
<strong>Insertion de Questions</strong>
</h5>

<!--Card content-->
<div class="card-body px-lg-5 pt-0">
	
	<!-- Form -->
	<form class="text-center btn btn-rounded aqua-gradient position-auto " style="color: #757575; width: 100%;"  action="index.php?modules=administration&action=InsererQR" method="post" enctype="multipart/form-data">

		<!-- File Input -->	
		<div class="file-field">
   		 <div class="btn btn-rounded peach-gradient btn-lg float-middle" >
      		<span>Saisir l'image de la question</span>
      		<input type="file" name="avatar">
		 </div>	
   	 	</div>

		<!--select -->	
			<select class="mdb-select md-form colorful-select dropwdown-danger" id="thema" name="valeurthema" width="500">
							
							<?php foreach ($liste as $o) {
							?>
								<option class="peach-gradient" value="<?php echo $o['libelleThematique'] ?>"> <?php echo $o['libelleThematique'] ?> </option>
							<?php 	 		
							}
							?>
				<label class="mdb-main-label">Label example</label>
				<button class="btn-save btn btn-danger btn-sm">Save</button>
			</select>	
		<!-- Question -->
		<div class="md-form">
			<input type="text" id="materialLoginFormEmail" Placeholder="Libelle de la question" name="question" class="form-control">
			<label for="materialLoginFormEmail"></label>
		</div>
		<!-- Reponse1 -->
		<div class="md-form">
			<input type="text" id="materialLoginFormEmail" onkeypress="functionrep1()" Placeholder="Reponse 1" name="rep1" class="form-control">
			<input class="btn-lg" type="checkbox"  id="check1" name="choix1" value="1" disabled=disabled >
		</div>
		
		<!-- Reponse2 -->
		<div class="md-form">
			<input type="text" id="materialLoginFormEmail" onkeypress="functionrep2()" Placeholder="Reponse 2" name="rep2" class="form-control">
			<input type="checkbox"  id="check2" name="choix2" value="2" disabled=disabled >
		</div>
		<!-- Reponse3 -->
		<div class="md-form">
			<input type="text" id="materialLoginFormEmail" onkeypress="functionrep3()" Placeholder="Reponse 3" name="rep3" class="form-control">
			<input type="checkbox"  id="check3" name="choix3" value="3" disabled=disabled >
		</div>
    
	<!-- Reponse4 -->
		<div class="md-form">
			<!-- <div class="custom-control custom-checkbox"> -->
			<input type="text" id="materialLoginFormEmail"  onkeypress="functionrep4()" Placeholder="Reponse 4" name="rep4" class="form-control">
			<input type="checkbox"  id="check4" name="choix4" value="4" disabled=disabled >
			<!--</div> -->
		</div>

		
							
		

		<!-- Sign in button -->
		<button class="btn btn-outline-info peach-gradient btn-rounded my-4 waves-effect z-depth-0 " type="submit"> Inserer la question </button>
					<script>
						function functionrep1() {
  							document.getElementById("check1").disabled = false;
						}
						function functionrep2() {
  							document.getElementById("check2").disabled = false;
						}
						function functionrep3() {
  							document.getElementById("check3").disabled = false;
						}
						function functionrep4() {
  							document.getElementById("check4").disabled = false;
						}
					</script>
						
		

	</form>
	<!-- Form -->

</div>

</div>
<?php
		}
		function afficherMenuAdmin(){
			echo '<a href="index.php?modules=administration&action=FormQuestions"><h3>Inserer une nouvelle question</h3></a>
                    <a href="index.php?modules=administration&action=ModificationQuestions"><h3>Modifier une question</h3></a>
                    <a href="index.php?modules=administration&action=ModificationEtatUtilisateur"><h3>Modifier un utilisateur</h3></a>
					<a href="index.php?modules=administration&action=PromotionUtilisateur"><h3>Promouvoir un utilisateur </h3></a>
					<a href="index.php?modules=administration&action=SupprimerUtilisateur"><h3>Supprimer un utilisateur </h3></a>';
		}
		
		function afficherMenuModifQ($liste){ ?>
			<div></div>
			<div class="container">     
  				<table class="table table-hover">
    			<thead>
      			<tr>
      			  <th>ID</th>
     			  <th>Question</th>
      			  <th>Thematique</th>
    			</tr>
  			  	</thead>
   			 	<tbody>
   			 	<?php
   			 	for($i=0;$i<count($liste);$i++){ ?>
  			    		<tr>
  			     		<td><a href="index.php?modules=administration&action=ModifQuestChoisie&id=<?php echo $liste[$i][0] ?>" style='display:block; padding:10px; '><?php echo $liste[$i][0] ?></a></td>
  			      		<td><a href="index.php?modules=administration&action=ModifQuestChoisie&id=<?php echo $liste[$i][0] ?>" style='display:block; padding:10px; '><?php echo $liste[$i][1] ?></a></td>
  			      		<td><a href="index.php?modules=administration&action=ModifQuestChoisie&id=<?php echo $liste[$i][0] ?>" style='display:block; padding:10px; '><?php echo $liste[$i][2] ?></a></td>
 			    		</tr>
 			    		<?php
 			   	}
 				?>
 			   	</tbody>
 				</table>
			</div> <?php
		}

		function afficherModifQuestionChoisie($i,$libelle,$rep,$vraie,$img,$them,$liste){
				?>
			<div class="card-body px-lg-5 pt-0">

				<h5 class="card-header info-color white-text text-center py-4" style="margin-bottom: 2	0px;">
				<strong>Modification de la question numéro <?php echo $i ?> </strong>
				</h5>
			</div>
			<!--Card content-->
			<div class="card-body px-lg-5 pt-0">
				
				<!-- Form -->
				<form class="text-center btn btn-rounded aqua-gradient float-middle  " style="color: #757575; width: 100%;" action="" method="post">

					<!-- File Input -->	
					<div class="file-field">
			   		 <div class="btn btn-rounded peach-gradient btn-lg float-middle" >
			      		<span>Saisir l'image de la question</span>
			      		<input type="file">
					 </div>	
			   	 	</div>

					<!--select -->	
					<select class="mdb-select md-form colorful-select dropwdown-danger" id="thema" name="valeurthema" width="500">
										
										<?php foreach ($liste as $o) {
										?>
											<option class="peach-gradient" value="<?php echo $o['libelleThematique'] ?>"> <?php echo $o['libelleThematique'] ?> </option>
										<?php 	 		
										}
										?>
							<label class="mdb-main-label">Label example</label>
							<button class="btn-save btn btn-danger btn-sm">Save</button>
						</select>	
					<!-- Question -->
					<div class="md-form">
					<input type="text" id="materialLoginFormEmail" value="<?php echo $libelle ?>" name="mailo" class="form-control">
					<label for="materialLoginFormEmail"></label>
					</div>
					
					<?php for($i=1;$i<5;$i++){
						if(isset($rep[$i-1][0])){
							if($rep[$i-1][0]==$vraie){
							?>
							<div class="md-form">
								<input type="text" id="materialLoginFormEmail" onkeypress='functionrep("check<?php echo $i ?>")' value="<?php echo $rep[$i-1][0] ?>" name="rep<?php echo $i ?>" class="form-control">
								<input type="checkbox"  id="check<?php echo $i ?>" name="choix<?php echo $i ?>"  value="<?php echo $i ?>" checked >
							</div>
							<?php
							}

							else {
							?>
							<div class="md-form">
								<input type="text" id="materialLoginFormEmail" onkeypress='functionrep("check<?php echo $i ?>")' value="<?php echo $rep[$i-1][0] ?>" name="rep<?php echo $i ?>" class="form-control">
								<input type="checkbox"  id="check<?php echo $i ?>" name="choix<?php echo $i ?>"  value="<?php echo $i ?>" >
							</div>
							<?php
							}

						}
						else {
						?>
						<div class="md-form">
							<input type="text" id="materialLoginFormEmail" onkeypress='functionrep("check<?php echo $i ?>")' Placeholder="Reponse <?php echo $i ?>" name="rep<?php echo $i ?>" class="form-control">
							<input type="checkbox"  id="check<?php echo $i ?>" name="choix<?php echo $i ?>" value="<?php echo $i ?>" disabled >
						</div>
						<?php
						}
					} ?>


					<div class="d-flex justify-content-around">
					
					</div>

					<!-- Sign in button -->
					<button class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0 peach-gradient " type="submit"> Modifier la question </button>
								
								<script>
									function functionrep(i) {
			  							if(document.getElementById(i).value.length==0){
			  								document.getElementById(i).disabled=true;
			  							}
			  							else{
			  								document.getElementById(i).disabled=false;
			  							}
									}
								</script>
									
					

				</form>
				<!-- Form -->

			</div>

			</div>
<?php
		
	
	
	function afficherListeUtilisateur($liste){ ?>
		<div class="container">
			  <table class="table table-hover">
				<thead>
					  <tr>
						   <th>ID</th>
						   <th>NOM</th>
					</tr>
					</thead>
					<tbody>
					<?php
					for($i=0;$i<count($liste);$i++){ ?>
					  <tr>
					   <td><a href="index.php?modules=administration&action=ModificationEtatUtilisateurChoisis&id=<?php echo $liste[$i][0] ?>" style='display:block; padding:10px; '><?php echo $liste[$i][0] ?></a></td>
						<td><a href="index.php?modules=administration&action=ModificationEtatUtilisateurChoisis&id=<?php echo $liste[$i][0] ?>" style='display:block; padding:10px; '><?php echo $liste[$i][1] ?></a></td>
					 </tr> <?php
					} ?>
				</tbody>
			 </table>
		</div> <?php

	}
	function afficherModifUtilisateurChoisis($id, $pseudo, $mail){ ?>
		<div class="card">
			<h5 class="card-header info-color white-text text-center py-4" style="margin-bottom: 2	0px;"><strong>Modification de L'Utilisateur n° <?php echo $id ?> </strong></h5>
			<!--Card content-->
			<div class="card-body px-lg-5 pt-0">
			<!-- Form -->
				<form class="text-center btn btn-rounded aqua-gradient float-middle " style="color: #757575; margin-left: 350px;" action="" method="post">
					<!-- Pseudo -->
					<div class="md-form">
						<input type="text" id="materialLoginFormEmail" value="<?php echo $pseudo ?>" name="pseudo" class="form-control">
						<label for="materialLoginFormEmail"></label>
					</div>
					<!-- Mail -->
					<div class="md-form">
						<input type="text" id="materialLoginFormEmail" value="<?php echo $mail ?>" name="mail" class="form-control">
						<label for="materialLoginFormEmail"></label>
					</div>
					<div class="d-flex justify-content-around"></div>

					<!-- Sign in button -->
					<button class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0 " type="submit"> Valider la modif </button>
				</form>
			</div>
		</div> <?php
	}

		function afficherListeNotAdmin($liste){ ?>
		<div class="container">
			  <table class="table table-hover">
				<thead>
					  <tr>
						   <th>ID</th>
						   <th>NOM</th>
					</tr>
					</thead>
					<tbody>
					<?php
					for($i=0;$i<count($liste);$i++){ ?>
					  <tr>
					   <td><a href="index.php?modules=administration&action=PromotionUtilisateurChoisis&id=<?php echo $liste[$i][0] ?>" style='display:block; padding:10px; '><?php echo $liste[$i][0] ?></a></td>
						<td><a href="index.php?modules=administration&action=PromotionUtilisateurChoisis&id=<?php echo $liste[$i][0] ?>" style='display:block; padding:10px; '><?php echo $liste[$i][1] ?></a></td>
					 </tr> <?php
					} ?>
				</tbody>
			 </table>
		</div> <?php

	}

	function afficherPromotionUtilisateurChoisis($id){ ?>
		<div class="card">
			<h5 class="card-header info-color white-text text-center py-4" style="margin-bottom: 2	0px;"><strong>Modification de L'Utilisateur n° <?php echo $id ?> </strong></h5>
			<!--Card content-->
			<div class="card-body px-lg-5 pt-0">
			<!-- Form -->
				<form class="text-center btn btn-rounded aqua-gradient float-middle " style="color: #757575; margin-left: 350px;" action="" method="post">
					<!-- Confirmation -->
					<div class="md-form">
						<input type="text" id="materialLoginFormEmail" name="upgrade" class="form-control">
						<label for="materialLoginFormEmail"></label>
					</div>
					<!-- Sign in button -->
					<button class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0 " type="submit"> Valider la Promotion </button>
				</form>
			</div>
		</div> <?php
	}

function afficherListeNotAdmin2($liste){ ?>
  <div class="container">
	  <table class="table table-hover">
		<thead>
			<tr>
			  <th>ID</th>
			  <th>NOM</th>
		  </tr>
		  </thead>
		<tbody>
		<?php
		for($i=0;$i<count($liste);$i++){ ?>
					  <tr>
					   <td><a href="index.php?modules=administration&action=SupprimerUtilisateurChoisis&id=<?php echo $liste[$i][0] ?>" style='display:block; padding:10px; '><?php echo $liste[$i][0] ?></a></td>
						<td><a href="index.php?modules=administration&action=SupprimerUtilisateurChoisis&id=<?php echo $liste[$i][0] ?>" style='display:block; padding:10px; '><?php echo $liste[$i][1] ?></a></td>
					 </tr> <?php
					} ?>
	  </tbody>
	</table>
  </div> <?php

}

	function afficherSuppressionUtilisateurChoisis($id){ ?>
		<div class="card">
			<h5 class="card-header info-color white-text text-center py-4" style="margin-bottom: 2	0px;"><strong>Suppression de L'Utilisateur n° <?php echo $id ?> </strong></h5>
			<!--Card content-->
			<div class="card-body px-lg-5 pt-0">
			<!-- Form -->
				<form class="text-center btn btn-rounded aqua-gradient float-middle " style="color: #757575; margin-left: 350px;" action="" method="post">
					<!-- Confirmation -->
					<div class="md-form">
						<input type="text" id="materialLoginFormEmail" name="delete" class="form-control">
						<label for="materialLoginFormEmail"></label>
					</div>
					<!-- Sign in button -->
					<button class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0 " type="submit"> Valider la Suppression </button>
				</form>
			</div>
		</div> <?php
	}
		}
	}
?>











