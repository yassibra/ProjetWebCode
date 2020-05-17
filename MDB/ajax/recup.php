<?php
	$bd=new PDO('mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw20165','dutinfopw20165','vuhedadu');
	$messages=array();
	$recup_messages=$bd->query("SELECT * FROM commentaire ORDER BY idCom DESC");
	while($all = $recup_messages->fetch()){
		$messages[] = $all;
	}

	foreach ($messages as $message) { ?>
		<h4><?php echo $message['nom'] ?></h4>
		<p><?php echo $message['com'] ?></p>
		<hr/> <?php
	}


?>
