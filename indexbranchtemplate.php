<!DOCTYPE html>
<html>
	<head>
		<title>Page Inscription</title>
		<link href="bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<meta charset="utf-8" />
		<link rel="icon" href="../../favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		 <!-- Bootstrap core CSS -->
		 

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="starter-template.css" rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="../../assets/js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

	</head>
	<header>
		<h1>Mon site du code de la route poto</h1>
	</header>
	<body>
		 <div id="connexion">
		 <?php if(!isset($_SESSION["login"])){

		 ?>
			<a href="index.php?modules=connexion&action=FormInscription"><h3>INSCRIPTION</h3></a>
			<a href="index.php?modules=connexion&action=FormConnexion"><h3>CONNEXION</h3></a>
		 <?php } else { ?>
			 <a href="index.php?modules=connexion&action=Deconnexion"><h3>Deconnexion</h3></a>
		 <?php } ?>
			</div>
		
		<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
		  
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>Bootstrap starter template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
		<form>
		
</form>
	      </div>

    </div><!-- /.container -->
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>	
</html>
<?php

define('CONST_INCLUDE', NULL);

if (isset($_GET['modules'])) {
	switch ($_GET['modules']) {
		
		case 'connexion':
			require_once 'modules/mod_connexion/controleurInscription.php';
			$contConnexion = new ControleurInscription();
			$contConnexion -> menu();
		break;

		case 'administration':

			
				require_once 'modules/mod_administration/controleurAdministration.php';
				$contAdministration = new ControleurAdministration();
				$contAdministration -> menu();
			
		break;
	}
}

if(isset($_SESSION["login"])) {
	//if(isset($contAdministration)){
		require_once 'modules/mod_administration/controleurAdministration.php';
				
		$controleuradmin = new ControleurAdministration();
		$boolean = $controleuradmin -> cverifsiadmin($_SESSION["login"]); 
		echo $boolean;
		if($boolean == true) {
			echo '<a href="index.php?modules=administration&action=FormQuestions" id="administration"><h3>Adminstration</h3></a>' ;
		}
	//}	 
	echo "Vous etes connecté, identifiant = ".$_SESSION["login"];
	echo '<a href="index.php?modules=connexion&action=deconnexion" id="connexion"><h3>DECONNEXION</h3></a>';

	//echo '<a href="index.php?modules=administration&action=FormQuestions" id="administration"><h3>Adminstration</h3></a>' ;
}

?>
