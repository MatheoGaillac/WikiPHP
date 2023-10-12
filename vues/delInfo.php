<?php
require_once '../persistance/DialogueBD.php';
session_start();
if($_SESSION['role'] != 'admin'){
    header('Location: gestion.php');
    exit;
}

try {
    $undlg = new DialogueBD();
    $mesPays = $undlg->getPays();
    $mesLieux = $undlg->getLieu();
    $mesPlats = $undlg->getGastronomie();
} catch (Exception $e) {
    $erreur = $e->getMessage();
}
if (isset($_POST['idPays'])) {
    $idPays = $_POST['idPays'];
    try {
        $undlg = new DialogueBD();
        $success = $undlg->delPays($idPays);
        if ($success) {
            echo "<div id='notification' class='show'>Suppression réussie</div>";
        } else {
            echo "<div id='notification' class='show'>La suppression a échouée</div>";
        }
        $mesPays = $undlg->getPays();
    } catch (Exception $e) {
        $erreur = $e->getMessage();
    }
}
if (isset($_POST['idLieu'])) {
    $idLieu = $_POST['idLieu'];
    try {
        $undlg = new DialogueBD();
        $success = $undlg->delLieu($idLieu);
        if ($success) {
            echo "<div id='notification' class='show'>Suppression réussie</div>";
        } else {
            echo "<div id='notification' class='show'>La suppression a échouée</div>";
        }
        $mesLieux = $undlg->getLieu();
    } catch (Exception $e) {
        $erreur = $e->getMessage();
    }
}
if (isset($_POST['idPlat'])) {
    $idPlat = $_POST['idPlat'];
    try {
        $undlg = new DialogueBD();
        $success = $undlg->delPlat($idPlat);
        if ($success) {
            echo "<div id='notification' class='show'>Suppression réussie</div>";
        } else {
            echo "<div id='notification' class='show'>La suppression a échouée</div>";
        }
        $mesPlats = $undlg->getGastronomie();
    } catch (Exception $e) {
        $erreur = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Supprimer - Fujin</title>
    <link rel="stylesheet" href="../lib/css/suppression.css">
</head>

<body>
    <?php require_once('menu.php'); ?>
    <script>
        setTimeout(function () {
            var notification = document.getElementById('notification');
            if (notification) {
                notification.classList.remove('show');
            }
        }, 3000);
    </script>
    <div class="parent-container">
        <div class="left-container">
            <p class="main-title">Pays</p>
            <div class="desc">
                <p><svg width="99px" height="99px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        stroke="white">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path opacity="0.4"
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                fill="#1B7E8D"></path>
                            <path
                                d="M12.0002 15.0099C11.8102 15.0099 11.6202 14.9399 11.4702 14.7899L7.94016 11.2599C7.65016 10.9699 7.65016 10.4899 7.94016 10.1999C8.23016 9.90992 8.71016 9.90992 9.00016 10.1999L12.0002 13.1999L15.0002 10.1999C15.2902 9.90992 15.7702 9.90992 16.0602 10.1999C16.3502 10.4899 16.3502 10.9699 16.0602 11.2599L12.5302 14.7899C12.3802 14.9399 12.1902 15.0099 12.0002 15.0099Z"
                                fill="#1B7E8D"></path>
                        </g>
                    </svg>
                    Sélectionner un pays à supprimer :</p>
            </div>
            <div class="form-container">
                <form name="paysForm" action="delInfo.php" method="POST">
                    <select name="idPays" id="idPays" size="5" required>
                        <?php
                        foreach ($mesPays as $pays) {
                            $id = $pays['idpays'];
                            $lib = $pays['libpays'];
                            echo "<option value=$id>$lib - $id</option>";
                        }
                        ?>
                    </select>
                    <br><input type="submit" class="deleteButton" value="Supprimer">
                </form>
            </div>
        </div>
        <div class="mid-container">
            <p class="main-title">Lieux</p>
            <div class="desc">
                <p><svg width="99px" height="99px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        stroke="white">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path opacity="0.4"
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                fill="#1B7E8D"></path>
                            <path
                                d="M12.0002 15.0099C11.8102 15.0099 11.6202 14.9399 11.4702 14.7899L7.94016 11.2599C7.65016 10.9699 7.65016 10.4899 7.94016 10.1999C8.23016 9.90992 8.71016 9.90992 9.00016 10.1999L12.0002 13.1999L15.0002 10.1999C15.2902 9.90992 15.7702 9.90992 16.0602 10.1999C16.3502 10.4899 16.3502 10.9699 16.0602 11.2599L12.5302 14.7899C12.3802 14.9399 12.1902 15.0099 12.0002 15.0099Z"
                                fill="#1B7E8D"></path>
                        </g>
                    </svg>
                    Sélectionner un lieu à supprimer :</p>
            </div>
            <div class="form-container">
                <form name="lieuForm" action="delInfo.php" method="POST">
                    <select name="idLieu" id="idLieu" size="5" required>
                        <?php
                        foreach ($mesLieux as $lieux) {
                            $id = $lieux['idlieu'];
                            $lib = $lieux['liblieu'];
                            echo "<option value=$id>$lib - $id</option>";
                        }
                        ?>
                    </select><br>
                    <input type="submit" class="deleteButton" value="Supprimer">
                </form>
            </div>
        </div>
        <div class="right-container">
            <p class="main-title">Gastronomie</p>
            <div class="desc">
                <p><svg width="99px" height="99px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        stroke="white">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path opacity="0.4"
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                fill="#1B7E8D"></path>
                            <path
                                d="M12.0002 15.0099C11.8102 15.0099 11.6202 14.9399 11.4702 14.7899L7.94016 11.2599C7.65016 10.9699 7.65016 10.4899 7.94016 10.1999C8.23016 9.90992 8.71016 9.90992 9.00016 10.1999L12.0002 13.1999L15.0002 10.1999C15.2902 9.90992 15.7702 9.90992 16.0602 10.1999C16.3502 10.4899 16.3502 10.9699 16.0602 11.2599L12.5302 14.7899C12.3802 14.9399 12.1902 15.0099 12.0002 15.0099Z"
                                fill="#1B7E8D"></path>
                        </g>
                    </svg>
                    Sélectionner un plat à supprimer :</p>
            </div>
            <div class="form-container">
                <form name="gastroForm" action="delInfo.php" method="POST">
                    <select name="idPlat" id="idPlat" size="5" required>
                        <?php
                        foreach ($mesPlats as $plat) {
                            $id = $plat['idplats'];
                            $lib = $plat['libplat'];
                            echo "<option value=$id>$lib - $id</option>";
                        }
                        ?>
                    </select><br>
                    <input type="submit" class="deleteButton" value="Supprimer">
                </form>
            </div>
        </div>
    </div>
</body>

</html>