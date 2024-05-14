<?php
	// Il faut lancer ça avant même de commencer l'html, alors on anticipe.
	session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mon chat sécu</title>
<link href="Color Game - Colors Background.css" rel="stylesheet" type="text/css">
<link href="Color Game - Colors Text.css" rel="stylesheet" type="text/css">
<link href="swaggy.css" rel="stylesheet" type="text/css">
</head>

<body>
<form method="post" action="envoimessage.php" class="champMessage">
	<p class="tour1 backCarmin"> 
    	<textarea type="text" name="blabla"></textarea><br /><input type="submit">
	</p>
</form>

<div class = "champChat tour2 textCarmin">
<?php

// Faire la connexion à la base de données, crée dans PHPmyAdmin
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

	$reponse = $bdd->query('SELECT * FROM messages ORDER BY id DESC LIMIT 0,10');
	
	while($donnee = $reponse->fetch())
	{
		echo '<strong>' . $donnee['author'] . ' </strong> : ' . $donnee['message'] . '<br />';
		
	}
	
?>
 </div>
</body>
</html>