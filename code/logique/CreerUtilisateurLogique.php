<?php
namespace Code\Logique;

//require_once('PersonneDAO.php');

class CreerUtilisateurLogique {
	public $succes;
	public $message;

	function creeUtilisateur($email, $motDePasse, $nom, $prenom, $statut) {
		$dao = new \Code\Dao\PersonneDAO();
		if ($dao->lirePersonne($email)) {
			$this->message = "il y une personne inscrite avec le mel " . $email;
			$this->succes = false;
		} else {
			$hash = password_hash($motDePasse, PASSWORD_BCRYPT, array("cost" => 7));
			$personne = new \Code\Obj\Personne();
			$personne->email      = $email;
			$personne->motDePasse = $hash;
			$personne->nom        = $nom;
			$personne->prenom     = $prenom;
			$personne->statut     = $statut;
			$dao->creePersonne($personne);
			$this->succes = true;
		}
	}
}

?>
