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
					<button class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0 " type="submit"> Inserer la question </button>
								
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
<!--<?php
		}
	}
?>


