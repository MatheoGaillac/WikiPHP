<?php
require_once '../persistance/dialogueBD.php';
$undlg = new DialogueBD();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$info = $undlg->getLieuById($id);
$monPays = $undlg->getPays();
foreach ($info as $lieu) {
	$nom = $lieu['LIBLIEU'];
	$pays = $lieu['IDPAYS'];
	$imgLieu = $lieu['IMGLIEU'];
	$description = $lieu['DESCLIEU'];
}
$monDrapeau = $undlg->getUnDrapeau($pays);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>
		<?php echo $nom; ?> - Fujin
	</title>
	<link rel="stylesheet" href="../lib/css/lieux.css">
</head>

<body>
	<?php require_once("menu.php"); ?>
	<div class="parent-container">
		<div class="info-container">
			<div class="img-container">
				<?php echo "<img id='imgLieu' src=\"../images/{$imgLieu}\" alt=\"{$imgLieu}\">"; ?>
				<div class="descImg">
					<?php foreach ($monPays as $ligne) {
						$id = $ligne['idpays'];
						$lib = $ligne['libpays'];
						if ($id == $pays) {
							echo '<svg fill="#05445E" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100px" height="100px" viewBox="0 0 395.71 395.71" xml:space="preserve" stroke="#05445E"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M197.849,0C122.131,0,60.531,61.609,60.531,137.329c0,72.887,124.591,243.177,129.896,250.388l4.951,6.738 c0.579,0.792,1.501,1.255,2.471,1.255c0.985,0,1.901-0.463,2.486-1.255l4.948-6.738c5.308-7.211,129.896-177.501,129.896-250.388 C335.179,61.609,273.569,0,197.849,0z M197.849,88.138c27.13,0,49.191,22.062,49.191,49.191c0,27.115-22.062,49.191-49.191,49.191 c-27.114,0-49.191-22.076-49.191-49.191C148.658,110.2,170.734,88.138,197.849,88.138z"></path> </g> </g></svg>';
							echo "<span id='paysLieu'>$lib</span>";
						}
					} ?>
				</div>
			</div>
			<div class="desc-container">
				<div class="main-title">
					<?php $drapeauObj = $monDrapeau[0]; ?>
					<?php echo "<img id='drapLieu' src=\"../images/{$drapeauObj->DRAPEAUPAYS}\" alt=\"{$drapeauObj->DRAPEAUPAYS}\">"; ?>
					<?php echo "<span id='nameLieu'>$nom</span>"; ?>
				</div>
				<div class="descLieu">
					<?php echo "<p>$description</p>"; ?>
				</div>
			</div>
		</div>
	</div>
</body>

</html>