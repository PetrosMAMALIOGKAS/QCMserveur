<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('ThemeLogique.php');

class ListerControle extends Controle  {

	function executer() {
		$logique = new \Code\Logique\ThemeLogique();
		$liste = $logique->listeThemes();
		global $vue;
		$vue['listeThemes'] = $liste;
	}
}

?>
