
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo htmlspecialchars($vue['titrePage']); ?></title>
	<link rel="stylesheet" media="screen" type="text/css" href="styles/style.css" />
</head>
<body>
<div class="personneconnecte">
	<?php
	if (isset($_SESSION['Personne'])) {
		echo "Nom Connecté : " . htmlspecialchars($_SESSION['Personne']->nom);
	} else {
		echo "Pas connecté";
	}
	?>
</div>	