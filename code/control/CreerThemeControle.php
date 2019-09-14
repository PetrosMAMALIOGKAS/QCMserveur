<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('CreerThemeLogique.php');

class CreerThemeControle extends Controle  {
	public $page= "formulaireCreerTheme.php";

	function executer() {
		global $vue;
		// Tester si la personne et professeur
		if ($this->testerProfesseurEtDiriger()) {

			if (!isset($_POST['designation'])) {
				// premier affichage
				$vue['designation'] = "";
			} else {
				$montrerFormulaire = true;
				// On teste si designation est complet
				if (!empty($_POST['designation'])) {
					$logique = new \Code\Logique\CreerThemeLogique();
					$logique->creerTheme($_POST['designation']);

					if ($logique->succes) {
						$montrerFormulaire = false;
						ajouteMessage("Theme creé");
						$this->redirect = "index.php";
					} else {
						ajouteMessage($logique->messageErreur);
					}
				} else {
					ajouteMessage("Remplir la designation du theme SVP");
				}
			}
		}
	}
}


?>
