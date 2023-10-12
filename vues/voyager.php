<?php require_once("config.php"); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../lib/css/voyager.css">
	<title>Voyager - Fujin</title>
</head>

<body>
	<?php require_once("menu.php"); ?>
	<div class="image-container" id="image1">
		<p class="text-content">Continent</p>
		<a href="<?php echo $baseURL?>/vues/continent.php"><p class="right-box">En savoir<br>plus</p></a>
	</div>
	<div class="image-container" id="image2">
		<p class="text-content">Pays</p>
		<a href="<?php echo $baseURL?>/vues/listInfo.php?type=pays"><p class="left-box">En savoir<br>plus</p></a>
	</div>
	<div class="image-container" id="image3">
		<p class="text-content">Lieux</p>
		<a href="<?php echo $baseURL?>/vues/listInfo.php?type=lieux"><p class="right-box">En savoir<br>plus</p></a>
	</div>
	<div class="image-container" id="image4">
		<p class="text-content dark-text">Gastronomie</p>
		<a href="<?php echo $baseURL?>/vues/listInfo.php?type=gastronomie"><p class="left-box dark-text">En savoir<br>plus</p></a>
	</div>
</body>

</html>