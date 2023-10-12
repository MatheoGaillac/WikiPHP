<?php
session_start();
$error_message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['username'] == 'adminsio' && $_POST['password'] == 'siosio') {
        $_SESSION['username'] = 'adminsio';
        $_SESSION['role'] = 'admin';
        header('Location: gestion.php');
        exit();
    } elseif ($_POST['username'] == 'editeursio' && $_POST['password'] == 'siosio') {
        $_SESSION['username'] = 'editeursio';
        $_SESSION['role'] = 'editeur';
        header('Location: gestion.php');
        exit();
    } else {
        $error_message = "Nom d'utilisateur ou mot de passe incorrect !";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion - Fujin</title>
    <link rel="stylesheet" href="../lib/css/connexion.css">
</head>

<body>
    <?php require_once('menu.php'); ?>
    <div class="parent-container">
        <p id="main-title">Connexion</p>
        <div class="input-container">
            <form method="post">
                <?php if ($error_message != "") { ?>
                    <div class="error-message">
                        <p>
                            <?php echo $error_message; ?>
                        </p>
                    </div>
                <?php } ?>
                <div class="usernameInput">
                    <label class="user" for="username">
                        <input type="text" name="username" id="username" placeholder="Nom d'utilisateur">
                    </label>
                </div>
                <div class="passwordInput">
                    <label class="password" for="password">
                        <input type="password" name="password" id="password" placeholder="Mot de passe">
                    </label>
                </div>
                <div class="buttonInput">
                    <button type="submit" id="connexionButton">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>