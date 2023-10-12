<?php
session_start();
if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'editeur'){
    header('Location: connexion.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de la BDD - Fujin</title>
    <link rel="stylesheet" href="../lib/css/gestion.css">
</head>
<body>
<?php require_once('menu.php'); ?>
<div class="parent-container">
    <p id="main-title">Gestion de la base de données</p>
    <div class="button-container">
        <a href="addInfo.php" class="button">Ajouter</a>
        <a href="editInfo.php" class="button">Modifier</a>
        <a href="delInfo.php" class="button">Supprimer</a>
        <a href="deconnexion.php" class="disconnect-button"><svg fill="white" height="50px" width="50px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 198.715 198.715" xml:space="preserve" stroke="white"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M161.463,48.763c-2.929-2.929-7.677-2.929-10.607,0c-2.929,2.929-2.929,7.677,0,10.606 c13.763,13.763,21.342,32.062,21.342,51.526c0,19.463-7.579,37.761-21.342,51.523c-14.203,14.204-32.857,21.305-51.516,21.303 c-18.659-0.001-37.322-7.104-51.527-21.309c-28.405-28.405-28.402-74.625,0.005-103.032c2.929-2.929,2.929-7.678,0-10.606 c-2.929-2.929-7.677-2.929-10.607,0C2.956,83.029,2.953,138.766,37.206,173.019c17.132,17.132,39.632,25.697,62.135,25.696 c22.497-0.001,44.997-8.564,62.123-25.69c16.595-16.594,25.734-38.659,25.734-62.129C187.199,87.425,178.059,65.359,161.463,48.763 z"></path> <path d="M99.332,97.164c4.143,0,7.5-3.358,7.5-7.5V7.5c0-4.142-3.357-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v82.164 C91.832,93.807,95.189,97.164,99.332,97.164z"></path> </g> </g></svg></a>
    </div>
</div>
</body>
</html>