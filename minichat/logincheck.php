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

// Préparer la requète pour que ce soit sûr
// On sélectionne tous les champs dont le login vaut la valeur entrée dans le champ "pseudo" à la page précédente

$req = $bdd->prepare('SELECT * FROM logins WHERE login = ?');

// à l'exécution, faut mettre un array même s'il y a une seule valeur. Le code part du principe qu'il pourrait y en avoir plein.
$req->execute(array($_POST['pseudo']));

// Dans ce cas qu'il ne faut pas faire, il faut d'abord mettre \' pour garantir un appostrophe entourant la chaîne de caractères,
// puis un appostrophe simple pour fermer le bordel du query temporairement, puis un . pour concaténer avec ce qu'on va mettre.
// Là on peut appeler la variable, on est hors-query, on peut aller la chercher. Après faut tout refermer.
// $req = $bdd->query('SELECT * FROM logins WHERE login = \'' . $_POST['pseudo'] . '\' ');

// On itère sur le tableau obtenu 
while ($data = $req->fetch()) {

// pour voir si le mot de passe de l'un de ces login est bien celui entré 
	if ($_POST['password'] == $data['password'])
	{
		$_SESSION['name'] = $data['login'];
		header('Location: chat.php');
	}

	else
	{
		echo "<div class=\"loginPage\">Mot de passe erroné. Accès au chat refusé. <br /> <br />Contactez <a href=\"mailto:thomas.cibils@gmail.com\">l'administrateur</a> pour recevoir un accès ou si vous avez oublié votre mot de passe.<br /><br /><a href=\"login.php\">Retour</a></div>";	
	}
}

?>

</body>
</html>