<?php
require_once '../persistance/dialogueBD.php';
$undlg = new DialogueBD();

$info = $undlg->getContinent();
foreach ($info as $ligne) {
	$id = $ligne['IDCONTINENT'];
	$lib = $ligne['LIBCONTINENT'];
	$population = $ligne['POPULATIONCONTINENT'];
	$superficie = $ligne['SUPERFICIECONTINENT'];
	$description = $ligne['DESCCONTINENT'];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>Continent - Fujin</title>
	<link rel="stylesheet" href="../lib/css/continent.css">
</head>

<body>
	<?php require_once('menu.php'); ?>
	<div class="parent-container">
		<div class="info-container">
			<div class="img-container">
				<img id="img-desc" src="../images/continent.png" alt="">
			</div>
			<div class="desc-container">
				<div class="title-text">
					<p>Le continent Asiatique</p>
				</div>
				<div class="desc-text">
					<div class="info-desc">
						<div class="info-item">
							<?php
							$formatted_population = number_format($population, 0, ',', '.');
							echo $formatted_population . ' hab.';
							?>
						</div>
						<div class="info-item">
							<?php 
							$formatted_superficie = number_format($superficie, 0, ',', '.');
							echo $formatted_superficie . ' km²';
							?>
						</div>
					</div>
					<div class="descContent">
						<?php echo $description ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>