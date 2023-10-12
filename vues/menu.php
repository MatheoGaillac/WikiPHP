<?php require_once("config.php"); ?>
<link rel="stylesheet" href="<?php echo $baseURL; ?>../lib/css/navBar.css">
<nav>
	<div class="container">
		<a class="logoNavBar" href="<?php echo $baseURL?>/index.php">Fujin</a>
		<div class="containerMid">
			<ul>
				<li><a href="<?php echo $baseURL?>/vues/listInfo.php?type=pays">Pays</a></li>
				<li><a href="<?php echo $baseURL?>/vues/listInfo.php?type=gastronomie">Gastronomie</a></li>
				<li><a href="<?php echo $baseURL?>/vues/listInfo.php?type=lieux">Lieux</a></li>
				<a href="<?php echo $baseURL?>/vues/searchInfo.php"><svg xmlns="http://www.w3.org/2000/svg" fill="white" class="bi bi-search" viewBox="0 0 16 16">
					<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
				</svg></a>
			</ul>
		</div>
		<div class="containerEnd">
			<ul>
				<li><a href="<?php echo $baseURL?>/vues/gestion.php">Gestion</a></li>
				<li>|</li>
				<li><a href="<?php echo $baseURL?>/vues/contact.php">Contact</a></li>
				<li>|</li>
				<li><a href="<?php echo $baseURL?>/vues/connexion.php">Connexion</a></li>
			</ul>
		</div>
	</div>
</nav>