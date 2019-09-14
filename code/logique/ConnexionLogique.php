<?php
namespace Code\Logique;

// require_once('CodesBDD.php');
// require_once('Personne.php');
// require_once('PersonneDAO.php');

class ConnexionLogique {
	public $personne;

	function connecterPersonne($email, $motDePasse) {
		$personne = null;
		$dao = new \Code\Dao\PersonneDAO();
		$pers = $dao->lirePersonne($email);
		if ($pers != null && password_verify($motDePasse, $pers->motDePasse)) {
			$this->personne = $pers;
			$this->personne->motDePasse = null;
		}
	}

	function connexionCorrecte() {
		return $this->personne != null;
	}
}
?>
