<?php
require_once '../persistance/DialogueBD.php';
session_start();
if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'editeur'){
    header('Location: gestion.php');
    exit;
}

try {
	$undlg = new DialogueBD();
	$mesContinents = $undlg->getContinent();
	$mesPays = $undlg->getPays();
	if (isset($_POST['idPays'])) {
		$idPays = $_POST['idPays'];
		$unPays = $undlg->getPaysById($idPays);
		foreach ($unPays as $pays) {
			$nom = $pays['LIBPAYS'];
			$continent = $pays['IDCONTINENT'];
			$capitale = $pays['CAPITALEPAYS'];
			$fuseau = $pays['FUSEAUHORAIRE'];
			$langue = $pays['LANGUEPAYS'];
			$monnaie = $pays['MONNAIEPAYS'];
			$superficie = $pays['SUPERFICIEPAYS'];
			$nbHabitants = $pays['NBHABITANTS'];
			$imgPays = $pays['IMGPAYS'];
			$drapeau = $pays['DRAPEAUPAYS'];
			$description = $pays['DESCPAYS'];
			$histoire = $pays['HISTOIREPAYS'];
			$climat = $pays['CLIMATPAYS'];
			$culture = $pays['CULTUREPAYS'];
			$formalites = $pays['FORMATLITESPAYS'];
		}
	} else if (isset($_POST['idLieu'])) {
		$idLieu = $_POST['idLieu'];
		$unLieu = $undlg->getLieuById($idLieu);
		foreach ($unLieu as $lieu) {
			$nom = $lieu['LIBLIEU'];
			$pays = $lieu['IDPAYS'];
			$imgLieu = $lieu['IMGLIEU'];
			$description = $lieu['DESCLIEU'];
		}
	} else if (isset($_POST['idPlat'])) {
		$idPlat = $_POST['idPlat'];
		$unPlat = $undlg->getPlatById($idPlat);
		foreach ($unPlat as $plat) {
			$intitule = $plat['LIBPLAT'];
			$pays = $plat['IDPAYS'];
			$imgPlat = $plat['IMGPLAT'];
			$description = $plat['DESCPLAT'];
		}
	}else{
		header('Location: editInfo.php');
		exit;
	}
	if (isset($_POST['editPays'])) {
		$NumPays = $_POST['editPays'];
		$nom = $_POST['libPays'];
		$capitale = $_POST['capitale'];
		$fuseau = $_POST['fuseauHoraire'];
		$langue = $_POST['languePays'];
		$monnaie = $_POST['monnaie'];
		$superficie = $_POST['superficie'];
		$nbHabitants = $_POST['nbHabitants'];
		if (!empty($_FILES['imagePays']['name'])) {
			$couverturePays = basename($_FILES['imagePays']['name']);
			$uploadOk = move_uploaded_file($_FILES['imagePays']['tmp_name'], "../images/" . $couverturePays);
		} else {
			$couverturePays = $_POST['imgPays'];
		}
		if (!empty($_FILES['drapeauPays']['name'])) {
			$drapeauPays = basename($_FILES['drapeauPays']['name']);
			$uploadOk2 = move_uploaded_file($_FILES['drapeauPays']['tmp_name'], "../images/" . $drapeauPays);
		} else {
			$drapeauPays = $_POST['drapPays'];
		}
		$description = $_POST['descPays'];
		$histoire = $_POST['histoirePays'];
		$climat = $_POST['climatPays'];
		$culture = $_POST['culturePays'];
		$formalite = $_POST['formalitePays'];
		$editPays = $undlg->modifPays($nom, $capitale, $fuseau, $langue, $monnaie, $superficie, $nbHabitants, $couverturePays, $drapeauPays, $description, $histoire, $climat, $culture, $formalite, $NumPays);
		header("Location: editInfo.php");
	}
	if (isset($_POST['editLieu'])) {
		$NumLieu = $_POST['editLieu'];
		$nom = $_POST['libLieu'];
		$LieuPays = $_POST['idPays'];
		if (!empty($_FILES['imageLieu']['name'])) {
			$couvertureLieu = basename($_FILES['imageLieu']['name']);
			$uploadOk = move_uploaded_file($_FILES['imageLieu']['tmp_name'], "../images/" . $couvertureLieu);
		} else {
			$couvertureLieu = $_POST['imgLieu'];
		}
		$description = $_POST['descLieu'];
		$editLieu = $undlg->modifLieu($nom, $LieuPays, $couvertureLieu, $description, $NumLieu);
		header("Location: editInfo.php");
	}
	if (isset($_POST['editPlat'])) {
		$NumPlat = $_POST['editPlat'];
		$nom = $_POST['libPlat'];
		$PlatPays = $_POST['idPays'];
		if (!empty($_FILES['imagePlat']['name'])) {
			$couverturePlat = basename($_FILES['imagePlat']['name']);
			$uploadOk = move_uploaded_file($_FILES['imagePlat']['tmp_name'], "../images/" . $couverturePlat);
		} else {
			$couverturePlat = $_POST['imgPlat'];
		}
		$description = $_POST['descPlat'];
		$editPlat = $undlg->modifPlat($nom, $PlatPays, $couverturePlat, $description, $NumPlat);
		header("Location: editInfo.php");
	}

} catch (Exception $e) {
	$erreur = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>Modification d'informations - Fujin</title>
	<link rel="stylesheet" href="../lib/css/modifier.css">
</head>

<body>
	<?php require_once('menu.php'); ?>
	<div class="edit-form-container">
		<?php
		if (isset($_POST['idPays'])) {
			echo "<form enctype='multipart/form-data' role='form' name='paysForm' action='editInfo2.php' method='POST'>";
			if (!empty($nom)) {
				echo "<label for='libPays'>Nom : </label>";
				echo "<input type='text' id='libPays' name='libPays' value='$nom' required autofocus><br>";
			}
			if (!empty($continent)) {
				echo "<label for='idContinent'>Continent :</label>";
				echo "<select name='idContinent' id='idContinent' required>";
				foreach ($mesContinents as $ligne) {
					$id = $ligne['IDCONTINENT'];
					$lib = $ligne['LIBCONTINENT'];
					echo "<option value='$id'>$lib - $id</option>";
				}
				echo "</select><br>";
			}
			if (!empty($capitale)) {
				echo "<label for='capitale'>Capitale : </label>";
				echo "<input type='text' id='capitale' name='capitale' value='$capitale' required><br>";
			}
			if (!empty($fuseau)) {
				echo "<label for='fuseauHoraire'>Fuseau Horaire : </label>";
				echo "<input type='text' id='fuseauHoraire' name='fuseauHoraire' required value='$fuseau'><br>";
			}
			if (!empty($langue)) {
				echo "<label for='languePays'>Langue nationale : </label>";
				echo "<input type='text' id='languePays' name='languePays' value='$langue' required><br>";
			}
			if (!empty($monnaie)) {
				echo "<label for='monnaie'>Monnaie nationale : </label>";
				echo "<input type='text' id='monnaie' name='monnaie' value='$monnaie' required><br>";
			}
			if (!empty($superficie)) {
				echo "<label for='superficie'>Superficie : </label>";
				echo "<input type='number' id='superficie' name='superficie' min='1' value='$superficie' required><br>";
			}
			if (!empty($nbHabitants)) {
				echo "<label for='nbHabitants'>Nombre d'habitants : </label>";
				echo "<input type='number' id='nbHabitants' name='nbHabitants' min='1' value='$nbHabitants' required><br>";
			}
			echo "<label for='imagePays'>Image de couverture : </label>";
			echo "<input type='file' name='imagePays' accept='image/*'></input>";
			echo "<input hidden type='text' value='$imgPays' name='imgPays' id='imgPays'></input><br>";
			echo "<label for='drapeauPays'>Drapeau : </label>";
			echo "<input type='file' name='drapeauPays' accept='image/*'></input>";
			echo "<input hidden type='text' value='$drapeau' name='drapPays' id='drapPays'></input><br>";
			if (!empty($description)) {
				echo "<label for='descPays'>Description du Pays : </label><br>";
				echo "<textarea name='descPays' id='descPays' cols='100' rows='10' required>$description</textarea><br>";
			}
			if (!empty($histoire)) {
				echo "<label for='histoirePays'>Histoire du Pays : </label><br>";
				echo "<textarea name='histoirePays' id='histoirePays' cols='80' rows='6' required>$histoire</textarea><br>";
			}
			if (!empty($climat)) {
				echo "<label for='climatPays'>Climat du Pays :</label><br>";
				echo "<textarea name='climatPays' id='climatPays' cols='80' rows='6' required>$climat</textarea><br>";
			}
			if (!empty($culture)) {
				echo "<label for='culturePays'>Culture du Pays :</label><br>";
				echo "<textarea name='culturePays' id='culturePays' cols='80' rows='6' required>$culture</textarea><br>";
			}
			if (!empty($formalites)) {
				echo "<label for='formalitePays'>Formalités d'accès au pays :</label><br>";
				echo "<textarea name='formalitePays' id='formalitePays' cols='80' rows='6' required>$formalites</textarea><br>";
			}
			echo "<input hidden type='text' value='$idPays' name='editPays'></input>";
			echo "</fieldset><input type='submit' class='editButton2' value='Modifier le pays'></form>";
		} else if (isset($_POST['idLieu'])) {
			echo "<form enctype='multipart/form-data' role='form' name='lieuForm' action='editInfo2.php' method='POST'><fieldset>";
			echo "<legend>Lieu touristique</legend>";
			if (!empty($nom)) {
				echo "<label for='libLieu'>Nom : </label>";
				echo "<input type='text' id='libLieu' name='libLieu' value='$nom' required autofocus><br>";
			}
			if (!empty($pays)) {
				echo "<label for='idPays'>Pays :</label>";
				echo "<select name='idPays' id='idPays'>";
				foreach ($mesPays as $ligne) {
					$id = $ligne['idpays'];
					$lib = $ligne['libpays'];
					if ($id == $pays) {
						echo "<option value='$id' selected>$lib - $id</option>";
					}
					echo "<option value='$id'>$lib - $id</option>";
				}
				echo "</select><br>";
			}
			echo "<label for='imageLieu'>Image de couverture :</label>";
			echo "<input type='file' name='imageLieu' accept='image/*'/><br>";
			echo "<input hidden type='text' value='$imgLieu' name='imgLieu' id='imgLieu'></input>";
			if (!empty($description)) {
				echo "<label for='descLieu'>Description du Lieu :</label><br>";
				echo "<textarea name='descLieu' id='descLieu' cols='100' rows='10' required>$description</textarea><br>";
			}
			echo "<input hidden type='text' value='$idLieu' name='editLieu'></input>";
			echo "</fieldset><input type='submit' class='editButton2' value='Modifier le Lieu'></form>";
		} else if (isset($_POST['idPlat'])) {
			echo "<form enctype='multipart/form-data' role='form' name='gastronomieForm' action='editInfo2.php' method='POST'><fieldset>";
			echo "<legend>Gastronomie</legend>";
			if (!empty($intitule)) {
				echo "<label for='libPlat'>Intitulé : </label>";
				echo "<input type='text' id='libPlat' name='libPlat' value='$intitule' required autofocus><br>";
			}
			if (!empty($pays)) {
				echo "<label for='idPays'>Pays :</label>";
				echo "<select name='idPays' id='idPays' required>";
				foreach ($mesPays as $ligne) {
					$id = $ligne['idpays'];
					$lib = $ligne['libpays'];
					if ($id == $pays) {
						echo "<option value='$id' selected>$lib - $id</option>";
					}
					echo "<option value='$id'>$lib - $id</option>";
				}
				echo "</select><br>";
			}
			echo "<label for='imagePlat'>Image de couverture :</label>";
			echo "<input type='file' name='imagePlat' accept='image/*'/><br>";
			echo "<input hidden type='text' value='$imgPlat' name='imgPlat' id='imgPlat'></input>";
			if (!empty($description)) {
				echo "<label for='descPlat'>Description du plat :</label><br>";
				echo "<textarea name='descPlat' id='descPlat' cols='100' rows='10' required>$description</textarea><br>";
			}
			echo "<input hidden type='text' value='$idPlat' name='editPlat'></input>";
			echo "</fieldset><input type='submit' class='editButton2' value='Modifier le plat'></form>";
		}
		?>
	</div>
</body>

</html>