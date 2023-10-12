<?php require_once("vues/config.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="lib/css/style.css">
	<title>Accueil - Fujin</title>
</head>

<body>
	<?php require_once("vues/menu.php"); ?>
	<div class="mainInfo">
		<p>Mont Fuji</p>
	</div>
	<div class="botInfo">
		<a href="<?php echo $baseURL?>/vues/voyager.php"><p>Voyager dès maintenant</p></a>
	</div>
</body>
</html>