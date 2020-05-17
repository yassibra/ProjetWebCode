<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> <?php $title ?></title>
       <!-- <link href="style.css" rel="stylesheet" /> --> 
        <script src="monfichier.js"></script>
          <a href="index.php"> <h1 style='text-align: center;'> Site du code de la route  </h1></a>
         
          
    <link rel='icon' href="img/mdb-favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    
        
    </head>

    <nav>
        <?php
            if(!isset($_SESSION['login'])){
                echo'<a href="index.php?modules=connexion&action=FormConnexion"> Connexion </a>'; 
                
            }
            else {
                echo '<a href="index.php?modules=connexion&action=Deconnexion" >Deconnexion</a>';
                echo '<a href="index.php?modules=questionnaire&action=Questionnaire" > Entraînement </a>';
                require_once 'modules/mod_administration/controleurAdministration.php';
		   		$controleuradmin = new ControleurAdministration();
		        $boolean = $controleuradmin->cverifsiadmin($_SESSION["login"]); 
                if($boolean == true) {
                    echo '<a href="index.php?modules=administration&action=default" id="administration">Adminstration</a>' ;
                }
            }
        ?>

    </nav>

    <body>
    <section>
        <article> 
            <?= $menu ?>
        </article>
        <article>
            <?= $module ?>
        </article>
    </section>
      <!-- jQuery -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Your custom scripts (optional) -->
  <script type="text/javascript"></script>
    </body>
    <footer> </footer>
</html>