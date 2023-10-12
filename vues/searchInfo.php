<?php
require_once '../persistance/dialogueBD.php';
$undlg = new DialogueBD();

$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : null;
$mesInfo = $undlg->getInfosBySearch($recherche);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Recherche - Fujin</title>
    <link rel="stylesheet" href="../lib/css/search.css">
</head>

<body>
<?php require_once("menu.php");?>
<div class="parent-container">
    <div id="recherche-container">
        <input type="text" name="recherche" id="recherche" placeholder="Rechercher...">
        <svg xmlns="http://www.w3.org/2000/svg" fill="" class="bi bi-search" viewBox="0 0 16 16">
		    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
		</svg>
    </div>
    <div id="resultats">
        <div id="infoContainer">
        <?php
        if (empty($mesInfo)) {
            echo "<p id='errorSearch'>Aucune recherche correspondante</p>";
        } else {
            foreach ($mesInfo as $info) {
                switch ($info['type']) {
                    case 'pays':
                        $lien = "paysModele.php?id={$info['id']}";
                        break;
                    case 'lieu':
                        $lien = "lieuModele.php?id={$info['id']}";
                        break;
                    case 'plat':
                        $lien = "platModele.php?id={$info['id']}";
                        break;
                }
                echo '<div class="items">';
                echo '<div class=items-content>';
                echo "<img src=\"../images/{$info['img']}\" alt=\"{$info['lib']}\">";
                echo "<div class='items-info'><a href=\"$lien\"><p class='titleInfo'>{$info['lib']}</p>";
                if(strlen($info['description']) >= 400){
                    echo '<p class="descInfo">' . substr($info['description'], 0, strpos($info['description'], ' ', 400)) . '...</p></a></div>';
                }else{
                    echo '<p class="descInfo">' . $info['description'] . '</p></a></div>';
                }
                echo "</div>";
                echo "</div>";
            }
        }
        ?>
        </div>
    </div>
</div>
    <script>
        var inputRecherche = document.getElementById("recherche");
        var divResultats = document.getElementById("resultats");

        inputRecherche.addEventListener("input", function () {
            var valeurRecherche = inputRecherche.value;
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    divResultats.innerHTML = this.responseText.match(/<div id="resultats">[\s\S]*<\/div>/m)[0];
                }
            };

            xhr.open("GET", "searchInfo.php?recherche=" + encodeURIComponent(valeurRecherche), true);
            xhr.send();
        });
    </script>
</body>

</html>

