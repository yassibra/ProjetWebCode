<?php
	$login = "root";
	$password= "";
	$dns="mysql:host=localhost;dbname=dutinfopw20165;";
	$bd=new PDO($dns,$login,$password,array(pdo::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));
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
