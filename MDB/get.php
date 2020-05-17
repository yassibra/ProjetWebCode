<?php
	$bd=new PDO('mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw20165','dutinfopw20165','vuhedadu');
	$messages=array();
	$listMessages=$bd->query("SELECT * FROM commentaire ORDER BY idCom DESC");
	while($mule = $listMessages->fetch()){
		$messages[] = $mule; }
	foreach ($messages as $com) { ?>
		<h4><?php echo $com['nom'] ?></h4>
		<p><?php echo $com['com'] ?></p> <?php } ?>
