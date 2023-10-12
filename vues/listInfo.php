<?php
require_once("config.php");
require_once '../persistance/dialogueBD.php';
$undlg = new DialogueBD();

$type = $_GET["type"];
if($type == "pays"){
    $mesInfo = $undlg->getPays();
}elseif($type == "lieux"){
    $mesInfo = $undlg->getLieu();
}elseif($type == "gastronomie"){
    $mesInfo = $undlg->getGastronomie();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste - Fujin</title>
    <link rel="stylesheet" href="../lib/css/search.css">
</head>

<body>
<?php require_once("menu.php");?>
<div class="parent-container">
    <div id="resultats">
        <div id="infoContainer">
        <?php
        if (empty($mesInfo)) {
            echo "<p id='errorSearch'>Aucune recherche correspondante</p>";
        } else {
            foreach ($mesInfo as $info) {
                echo '<div class="items">';
                echo '<div class=items-content>';
                if($type == "pays"){
                    echo "<img src=\"../images/{$info['imgpays']}\" alt=\"{$info['libpays']}\">";
                    echo "<div class='items-info'><a href='$baseURL/vues/paysModele.php?id={$info['idpays']}'><p class='titleInfo'>{$info['libpays']}<p>";
                    echo '<p class="descInfo">' . substr($info['descpays'], 0, 400) . '...</p></a></div>';
                }elseif($type == "lieux"){
                    echo "<img src=\"../images/{$info['imglieu']}\" alt=\"{$info['liblieu']}\">";
                    echo "<div class='items-info'><a href='$baseURL/vues/lieuModele.php?id={$info['idlieu']}'><p class='titleInfo'>{$info['liblieu']}</p>";
                    if(strlen($info['desclieu']) >= 400){
                        echo '<p class="descInfo">' . substr($info['desclieu'], 0, strpos($info['desclieu'], ' ', 400)) . '...</p></a></div>';
                    }else{
                        echo '<p class="descInfo">' . $info['desclieu'] . '</p></a></div>';
                    }
                }elseif($type == "gastronomie"){
                    echo "<img src=\"../images/{$info['imgplat']}\" alt=\"{$info['libplat']}\">";
                    echo "<div class='items-info'><a href='$baseURL/vues/platModele.php?id={$info['idplats']}'><p class='titleInfo'>{$info['libplat']}</p>";
                    echo '<p class="descInfo">' . substr($info['descplat'], 0, 400) . '...</p></a></div>';
                }
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
        </div>
    </div>
</div>
</body>

</html>