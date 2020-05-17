<?php
	$bd=new PDO('mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw20165','dutinfopw20165','vuhedadu');
	if (!empty($_POST['nom']) && !empty($_POST['message'])) {

		$nom = htmlspecialchars(trim($_POST['nom']));
		$message = htmlspecialchars(trim($_POST['message']));
		$bd->exec("INSERT INTO commentaire(idCom, nom, com) VALUES (default,'$nom','$message')");
		echo "<span class='success'>Vos données on été envoyées</span>";
	} else {
		echo "<span class='error'>Veuillez compléter tous les champs</span>";
	}

?>
