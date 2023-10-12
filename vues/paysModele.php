<?php
require_once '../persistance/dialogueBD.php';
try {
	$undlg = new DialogueBD();
	$id = isset($_GET['id']) ? $_GET['id'] : null;
	$info = $undlg->getPaysById($id);
	$deplacement = $undlg->getDeplacementByID($id);
	$mesTransports = $undlg->getTransports();
} catch (Exception $e) {
	$erreur = $e->getMessage();
}
foreach ($info as $pays) {
	$nom = $pays['LIBPAYS'];
	$nom = mb_strtoupper($nom);
	$capitale = $pays['CAPITALEPAYS'];
	$fuseau = $pays['FUSEAUHORAIRE'];
	$langue = $pays['LANGUEPAYS'];
	$monnaie = $pays['MONNAIEPAYS'];
	$superficie = $pays['SUPERFICIEPAYS'];
	$nbHabitants = $pays['NBHABITANTS'];
	$imgPays = $pays['IMGPAYS'];
	$description = $pays['DESCPAYS'];
	$histoire = $pays['HISTOIREPAYS'];
	$climat = $pays['CLIMATPAYS'];
	$culture = $pays['CULTUREPAYS'];
	$formalites = $pays['FORMATLITESPAYS'];
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>
		<?php echo $nom; ?> - Fujin
	</title>
	<link rel="stylesheet" href="../lib/css/pays.css">
</head>

<body>
	<?php require_once("menu.php"); ?>
	<div class="parent-container">
		<div class="infoContainer">
			<div id="bannerInfo">
				<div id="overlay"></div>
				<?php echo "<img src=\"../images/{$imgPays}\" alt=\"{$imgPays}\" id=\"img-container\">"; ?>
				<?php echo "<p id=\"mainTitle\">$nom</p>"; ?>
			</div>
			<div id="infoPays">
				<div id="infoPaysLeft">
					<p class="titleInfo">Capitale :
						<?php echo " <span class=\"containInfo\">$capitale</span>"; ?>
					</p>
					<p class="titleInfo">Fuseau Horaire :
						<?php echo " <span class=\"containInfo\">$fuseau</span>"; ?>
					</p>
					<p class="titleInfo">Langue(s) :
						<?php echo " <span class=\"containInfo\">$langue</span>"; ?>
					</p>
					<p class="titleInfo textDesc">Formalités : <br>
						<?php echo "<span class=\"containInfo\">$formalites</span>"; ?>
					</p>
				</div>
				<div id="infoPaysRight">
					<p class="titleInfo">Monnaie :
						<?php echo "<span class=\"containInfo\">$monnaie</span>"; ?>
					</p>
					<p class="titleInfo">Nombre d'habitants :
						<?php echo "<span class=\"containInfo\">$nbHabitants hab.</span>"; ?>
					</p>
					<p class="titleInfo">superficie :
						<?php echo "<span class=\"containInfo\">$superficie km²</span>"; ?>
					</p>
					<p class="titleInfo">Transports sur place :<br>
					<div class="columns">
						<?php
						$colors = [
							1 => "vert",
							2 => "orange",
							3 => "rouge",
						];
						$counter = 0;
						$column1 = '';
						$column2 = '';
						foreach ($deplacement as $lignes) {
							$idtransports = $lignes['IDTRANSPORTS'];
							$securite = $lignes['LVSECURITE'];
							$rapidite = $lignes['LVRAPIDITE'];
							$fiabilite = $lignes['LVFIABILITE'];
							foreach ($mesTransports as $ligne) {
								$id = $ligne['IDTRANSPORTS'];
								$lib = $ligne['LIBTRANSPORTS'];
								if ($idtransports == $id) {
									$counter++;
									$element = "<span class='containInfo'> $lib : </span>";
									$element .= "<span class='{$colors[$securite]}'>sûr</span> - ";
									$element .= "<span class='{$colors[$rapidite]}'>rapide</span> - ";
									$element .= "<span class='{$colors[$fiabilite]}'>fiable</span><br>";
									if ($counter <= 3) {
										$column1 .= $element;
									} else {
										$column2 .= $element;
									}
								}
							}
						}
						echo "<div class='column titleInfo'>$column1</div>";
						echo "<div class='column titleInfo'>$column2</div>";
						?>
					</div>
					</p>
				</div>
				<div id="descPaysImg">
					<?php echo "<p>$description</p>"; ?>
				</div>
			</div>
			<div id="textInfoBot">
				<div class="textContent1">
					<p class="title1">Histoire</p>
					<?php echo "<p class='mainInfo1'>$histoire</p>"; ?>
				</div>
				<div class="textContent2">
					<p class="title2">Climat</p>
					<?php echo "<p class='mainInfo2'>$climat</p>"; ?>
				</div>
				<div class="textContent1">
					<p class="title1">Culture</p>
					<?php echo "<p class='mainInfo1'>$culture</p>"; ?>
				</div>
			</div>
		</div>
	</div>
</body>

</html>