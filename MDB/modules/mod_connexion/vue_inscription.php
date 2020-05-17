	<?php
	Class VueInscription {
		function afficherFormulaireInscription(){
			echo '<div class="card">

				<h5 class="card-header info-color white-text text-center py-4">
				<strong>Inscription</strong>
				</h5>

				<!--Card content-->
				<div class="card-body px-lg-5 pt-0">
					
					<!-- Form -->
					<form class="text-center" style="color: #757575;" action="index.php?modules=connexion&action=inscription" method="post">

					
						<!-- Email -->
						<div class="md-form">
						<input type="email" id="materialLoginFormEmail" Placeholder="E-mail" name="mailo" class="form-control">
						<label for="materialLoginFormEmail"></label>
						</div>
						<!-- Pseudo -->
						<div class="md-form">
						<input type="text" id="materialLoginFormEmail" Placeholder="Pseudo" name="id" class="form-control">
						<label for="materialLoginFormEmail"></label>
						</div>
						
						<!-- Password -->
						<div class="md-form">
						<input type="password" id="materialLoginPassword" Placeholder="Mot de passe" name="mdp" class="form-control">
						<label for="materialLoginFormPassword"></label>
						</div>

						<div class="d-flex justify-content-around">
						
						</div>

						<!-- Sign in button -->
						<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit"> S inscrire </button>

						<!-- Social login -->
						<p>ou inscrivez vous via vos reseaux. </p>
						<a type="button" class="btn-floating btn-fb btn-sm">
						<i class="fab fa-facebook-f"></i>
						</a>
						<a type="button" class="btn-floating btn-tw btn-sm">
						<i class="fab fa-twitter"></i>
						</a>
						<a type="button" class="btn-floating btn-li btn-sm">
						<i class="fab fa-linkedin-in"></i>
						</a>
						<a type="button" class="btn-floating btn-git btn-sm">
						<i class="fab fa-github"></i>
						</a>

					</form>
					<!-- Form -->

				</div>

			</div>';
		}
		function afficherFormulaireConnexion(){
			?>
			<div class="card plusgrosdiv">

				<h5 class="card-header info-color white-text text-center py-4">
				<strong>Connexion</strong>
				</h5>

				<!--Card content-->
				<div class="card-body px-lg-5 pt-0">
					
					<!-- Form -->
					<form class="text-center" style="color: #757575;" action="index.php?modules=connexion&action=connexion" method="post">

						<!-- Pseudo -->
						<div class="md-form">
						<input type="text" id="materialLoginFormEmail" Placeholder="Pseudo" name="id" class="form-control">
						<label for="materialLoginFormEmail"></label>
						</div>

						<!-- Password -->
						<div class="md-form">
						<input type="password" id="materialLoginPassword" Placeholder="Mot de passe" name="mdp" class="form-control">
						<label for="materialLoginFormPassword"></label>
						</div>

						<div class="d-flex justify-content-around">
						
						</div>

						<!-- Sign in button -->
						<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Se connecter </button>

						<!-- Register -->
						<p>Pas encore membre ? Rejoignez nous ! Bonne route !
						<a href="index.php?modules=connexion&action=FormInscription">Inscription</a>
						</p>

						<!-- Social login -->
						<p>ou inscrivez vous via vos reseaux.  </p>
						<a type="button" class="btn-floating btn-fb btn-sm">
						<i class="fab fa-facebook-f"></i>
						</a>
						<a type="button" class="btn-floating btn-tw btn-sm">
						<i class="fab fa-twitter"></i>
						</a>
						<a type="button" class="btn-floating btn-li btn-sm">
						<i class="fab fa-linkedin-in"></i>
						</a>
						<a type="button" class="btn-floating btn-git btn-sm">
						<i class="fab fa-github"></i>
						</a>

					</form>
					<!-- Form -->

				</div>

			</div>
		<?php  } 
		function affichageBasique() {
				echo '<a href="index.php?modules=connexion&action=FormInscription"><h3>INSCRIPTION</h3></a>
					<a href="index.php?modules=connexion&action=FormConnexion"><h3>CONNEXION</h3></a>';
		}
		function affichageAdmin(){
			echo '<a href="index.php?modules=administration&action=FormQuestions" id="administration"><h3>Adminstration</h3></a>' ;
		}
		function message_deconnexion() {
			echo ' <p> Vous etes bien déconnecté <p> ';
		}
	}
?>
