<?php
namespace Code\Control;

//require_once('Personne.php');

class Controle {

	public $redirect =   null;             // Variable qui nous dicte la page de redirection au cas que n'est pas nulle
	public $page =      "probleme.php";

	function executer() {}

	function testerProfesseurEtDiriger() {
		$test = $this->testerConnexionEtRediger("Vous devez être connecter comme professeur pour effectuer cette action");
		if ($test && !estProfesseur()) {
			$test = false;
			global $vue;
			ajouteMessage("Vous devez être professeur pour effectuer cette action");
			$this->redirect = "index.php";
		}
		return $test;
	}

	function testerEleveEtDiriger() {
		$test = $this->testerConnexionEtRediger("Vous devez être connecter comme élève pour effectuer cette action");
		if ($test && !estEleve()) {
			$test = false;
			global $vue;
			ajouteMessage("Vous devez être élève pour effectuer cette action");
			$this->redirect = "index.php";
		}
		return $test;
	}

	function testerConnexionEtRediger($msg = "Vous devez être connecte pour effectuer cette action") {
		$test = true;
		if (!estConnecte()) {
			$test = false;
			ajouteMessage($msg);
			$this->redirect = "index.php?action=connexion";
		}
		return $test;
	}

}

?>
