<?php
	// Il faut lancer ça avant même de commencer l'html, alors on anticipe.
	session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
<link href="Color Game - Colors Background.css" rel="stylesheet" type="text/css">
<link href="Color Game - Colors Text.css" rel="stylesheet" type="text/css">
<link href="swaggy.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

		$req=$bdd->prepare('INSERT INTO messages(author, message, dateCreation) VALUES(:auteur, :message, NOW())');
		$req->execute(array(
		'auteur' => $_SESSION['name'],
		'message' => $_POST['blabla']
	));
	
header('Location: chat.php');
?>
</body>
</html>