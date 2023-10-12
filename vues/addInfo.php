<?php
require_once '../persistance/DialogueBD.php';
session_start();
if($_SESSION['role'] != 'admin'){
    header('Location: gestion.php');
    exit;
}

try {
    $undlg = new DialogueBD();
    $mesContinents = $undlg->getContinent();
    $mesPays = $undlg->getPays();
    $mesPlats = $undlg->getGastronomie();
    $mesTransports = $undlg->getTransports();
    $mesAllergenes = $undlg->getAllergene();
} catch (Exception $e) {
    $erreur = $e->getMessage();
}
if (isset($_POST['createPays'])) {
    if (isset($_POST['libPays']) && isset($_POST['idContinent']) && isset($_POST['fuseauHoraire']) && isset($_POST['languePays']) && isset($_POST['monnaie']) && isset($_POST['superficie']) && isset($_POST['nbHabitants']) && isset($_POST['descPays']) && isset($_POST['histoirePays']) && isset($_POST['climatPays']) && isset($_POST['culturePays']) && isset($_POST['formalitePays']) && isset($_FILES['imagePays']) && isset($_FILES['drapeauPays'])) {
        $pays = $_POST['libPays'];
        $continent = $_POST['idContinent'];
        $capitale = $_POST["capitale"];
        $fuseau = $_POST['fuseauHoraire'];
        $langue = $_POST['languePays'];
        $monnaie = $_POST['monnaie'];
        $superficie = $_POST['superficie'];
        $nbHabitants = $_POST['nbHabitants'];
        $couverturePays = basename($_FILES['imagePays']['name']);
        $uploadOk = move_uploaded_file($_FILES['imagePays']['tmp_name'], "../images/" . $couverturePays);
        $drapeau = basename($_FILES['drapeauPays']['name']);
        $uploadOk2 = move_uploaded_file($_FILES['drapeauPays']['tmp_name'], "../images/" . $drapeau);
        $description = $_POST['descPays'];
        $histoire = $_POST['histoirePays'];
        $climat = $_POST['climatPays'];
        $culture = $_POST['culturePays'];
        $formalite = $_POST['formalitePays'];
        $ajoutOK = $undlg->addUnPays($pays, $continent, $capitale, $fuseau, $langue, $monnaie, $superficie, $nbHabitants, $couverturePays, $drapeau, $description, $histoire, $climat, $culture, $formalite);
        header("location: addInfo.php");
    }
}

if (isset($_POST['createLieu'])) {
    if (isset($_POST['libLieu']) && isset($_POST['idPays']) && isset($_FILES['imageLieu']) && isset($_POST['descLieu'])) {
        $lieu = $_POST['libLieu'];
        $pays = $_POST['idPays'];
        $couvertureLieu = basename($_FILES['imageLieu']['name']);
        $uploadOk = move_uploaded_file($_FILES['imageLieu']['tmp_name'], "../images/" . $couvertureLieu);
        $description = $_POST['descLieu'];
        $ajoutOK = $undlg->addUnLieu($lieu, $pays, $couvertureLieu, $description);
        header("location: addInfo.php");
    }
}

if (isset($_POST['createPlat'])) {
    if (isset($_POST['libPlat']) && isset($_POST['idPays']) && isset($_FILES['imagePlat']) && isset($_POST['descPlat'])) {
        $plat = $_POST['libPlat'];
        $pays = $_POST['idPays'];
        $couverturePlat = basename($_FILES['imagePlat']['name']);
        $uploadOk = move_uploaded_file($_FILES['imagePlat']['tmp_name'], "../images/" . $couverturePlat);
        $description = $_POST['descPlat'];
        $ajoutOK = $undlg->addUnPlat($plat, $pays, $couverturePlat, $description);
        header("location: addInfo.php");
    }
}

if (isset($_POST['createDeplacement'])) {
    if (isset($_POST['idPays']) && isset($_POST['idTransports']) && isset($_POST['lvSecurite']) && isset($_POST['lvRapidite']) && isset($_POST['lvFiabilite'])) {
        $pays = $_POST['idPays'];
        $transports = $_POST['idTransports'];
        $securite = $_POST['lvSecurite'];
        $rapidite = $_POST['lvRapidite'];
        $fiabilite = $_POST['lvFiabilite'];
        $ajoutOK = $undlg->addUnDeplacement($pays, $transports, $securite, $rapidite, $fiabilite);
        header("location: addInfo.php");
    }
}

if (isset($_POST['createAllergene'])) {
    if (isset($_POST['idplats']) && isset($_POST['idAllergene'])) {
        $plat = $_POST['idplats'];
        $allergene = $_POST['idAllergene'];
        $ajoutOK = $undlg->addUnAllergene($plat, $allergene);
        header("location: addInfo.php");
    }
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter - Fujin</title>
    <link rel="stylesheet" href="../lib/css/ajouter.css">
</head>

<body>
    <?php require_once('menu.php'); ?>
    <script src="../lib/javascript/script.js"></script>
    <div class="parent-container">
        <div class="button-container">
            <button onclick="showPaysForm()">Pays</button>
            <button onclick="showLieuForm()">Lieu</button>
            <button onclick="showGastronomieForm()">Gastronomie</button>
            <button onclick="showTransportsForm()">Transports</button>
            <button onclick="showAllergeneForm()">Allergènes</button>
        </div>
    </div>
    <script>
        const buttons = document.querySelectorAll('.button-container button');
        function toggleActive() {
            buttons.forEach(button => button.classList.remove('active'));
            this.classList.add('active');
        }
        buttons.forEach(button => {
            button.addEventListener('click', toggleActive);
        });
    </script>
    <div class="form-container">
        <form enctype="multipart/form-data" role="form" name="paysForm" action="addInfo.php" method="POST">
            <div id="paysForm" style="display: none;">
                <label for="libPays">Nom : </label>
                <input type="text" id="libPays" name="libPays" required autofocus><br>
                <label for="idContinent">Continent :</label>
                <select name="idContinent" id="idContinent" required>
                    <?php
                    foreach ($mesContinents as $continent) {
                        $id = $continent['IDCONTINENT'];
                        $lib = $continent['LIBCONTINENT'];
                        echo "<option value='$id'>$lib - $id</option>";
                    }
                    ?>
                </select><br>
                <label for="capitale">Capitale : </label>
                <input type="text" id="capitale" name="capitale" required autofocus><br>
                <label for="fuseauHoraire">Fuseau Horaire :</label>
                <input type="text" id="fuseauHoraire" name="fuseauHoraire" required placeholder="UTC+8"><br>
                <label for="languePays">Langue nationale :</label>
                <input type="text" id="languePays" name="languePays" required><br>
                <label for="monnaie">Monnaie nationale :</label>
                <input type="text" id="monnaie" name="monnaie" required><br>
                <label for="nbHabitants">Superficie :</label>
                <input type="number" id="superficie" name="superficie" min="1" required><br>
                <label for="nbHabitants">Nombre d'habitants :</label>
                <input type="number" id="nbHabitants" name="nbHabitants" min="1" required><br>
                <label for="imagePays" class="custom-file">Image de couverture :</label>
                <input type="file" name="imagePays" accept="image/*" required /><br>
                <label for="imagePays">Drapeau :</label>
                <input type="file" name="drapeauPays" accept="image/*" required /><br>
                <label for="descPays">Description du Pays :</label><br>
                <textarea name="descPays" id="descPays" cols="100" rows="10" required></textarea><br>
                <label for="histoirePays">Histoire du Pays :</label><br>
                <textarea name="histoirePays" id="histoirePays" cols="80" rows="6" required></textarea><br>
                <label for="climatPays">Climat du Pays :</label><br>
                <textarea name="climatPays" id="climatPays" cols="80" rows="6" required></textarea><br>
                <label for="culturePays">Culture du Pays :</label><br>
                <textarea name="culturePays" id="culturePays" cols="80" rows="6" required></textarea><br>
                <label for="formalitePays">Formalités d'accès au pays :</label><br>
                <textarea name="formalitePays" id="formalitePays" cols="80" rows="6" maxlength="160"
                    required></textarea><br>
                <button type="submit" name="createPays" class="createButton">Créer le pays</button>
            </div>
        </form>
        <form enctype="multipart/form-data" role="form" name="lieuForm" action="addInfo.php" method="POST">
            <div id="lieuForm" style="display: none;">
                    <label for="libLieu">Nom : </label>
                    <input type="text" id="libLieu" name="libLieu" required autofocus><br>
                    <label for="idPays">Pays :</label>
                    <select name="idPays" id="idPays" required>
                        <?php
                        foreach ($mesPays as $pays) {
                            $id = $pays['idpays'];
                            $lib = $pays['libpays'];
                            echo "<option value='$id'>$lib - $id</option>";
                        }
                        ?>
                    </select><br>
                    <label for="imageLieu">Image de couverture :</label>
                    <input type="file" name="imageLieu" accept="image/*" required /><br>
                    <label for="descLieu">Description du Lieu :</label><br>
                    <textarea name="descLieu" id="descLieu" cols="100" rows="10" required></textarea><br>
                    <button type="submit" name="createLieu" class="createButton">Créer le lieu</button>
            </div>
        </form>
        <form enctype="multipart/form-data" role="form" name="gastronomieForm" action="addInfo.php" method="POST">
            <div id="gastronomieForm" style="display: none;">
                    <label for="libPlat">Intitulé : </label>
                    <input type="text" id="libPlat" name="libPlat" required autofocus><br>
                    <label for="idPays">Pays :</label>
                    <select name="idPays" id="idPays" required>
                        <?php
                        foreach ($mesPays as $pays) {
                            $id = $pays['idpays'];
                            $lib = $pays['libpays'];
                            echo "<option value='$id'>$lib - $id</option>";
                        }
                        ?>
                    </select><br>
                    <label for="imagePlat">Image de couverture :</label>
                    <input type="file" name="imagePlat" accept="image/*" required /><br>
                    <label for="descPlat">Description du plat :</label><br>
                    <textarea name="descPlat" id="descPlat" cols="100" rows="10" required></textarea><br>
                    <button type="submit" name="createPlat" class="createButton">Créer le plat</button>
            </div>
        </form>
        <form enctype="multipart/form-data" role="form" name="transportForm" action="addInfo.php" method="POST">
            <div id="transportForm" style="display: none;">
                    <label for="idPays">Pays :</label>
                    <select name="idPays" id="idPays" required>
                        <?php
                        foreach ($mesPays as $pays) {
                            $id = $pays['idpays'];
                            $lib = $pays['libpays'];
                            echo "<option value='$id'>$lib - $id</option>";
                        }
                        ?>
                    </select><br>
                    <label for="idTransports">Moyen de locomotion :</label>
                    <select name="idTransports" id="idTransports" required>
                        <?php
                        foreach ($mesTransports as $transport) {
                            $id = $transport['IDTRANSPORTS'];
                            $lib = $transport['LIBTRANSPORTS'];
                            echo "<option value='$id'>$lib - $id</option>";
                        }
                        ?>
                    </select><br>
                    <label for="lvSecurite">Niveau de sécurité :</label>
                    <select name="lvSecurite" id="lvSecurite" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select><br>
                    <label for="lvRapidite">Niveau de rapidité :</label>
                    <select name="lvRapidite" id="lvRapidite">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select><br>
                    <label for="lvFiabilite">Niveau de fiabilité :</label>
                    <select name="lvFiabilite" id="lvFiabilite">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select><br>
                    <button type="submit" name="createDeplacement" class="createButton">Créer le déplacement</button>
            </div>
        </form>
        <form enctype="multipart/form-data" role="form" name="allergeneForm" action="addInfo.php" method="POST">
            <div id="allergeneForm" style="display: none;">
                    <label for="idplats">Plat :</label>
                    <select name="idplats" id="idplats" required>
                        <?php
                        foreach ($mesPlats as $plat) {
                            $id = $plat['idplats'];
                            $lib = $plat['libplat'];
                            echo "<option value='$id'>$lib - $id</option>";
                        }
                        ?>
                    </select><br>
                    <label for="idAllergene">Allergènes possible :</label>
                    <select name="idAllergene" id="idAllergene" required>
                        <?php
                        foreach ($mesAllergenes as $allergene) {
                            $id = $allergene['IDALLERGENE'];
                            $lib = $allergene['LIBALLERGENE'];
                            echo "<option value='$id'>$lib - $id</option>";
                        }
                        ?>
                    </select><br>
                    <button type="submit" name="createAllergene" class="createButton">Créer l'allergène</button>
            </div>
        </form>
    </div>
</body>

</html>