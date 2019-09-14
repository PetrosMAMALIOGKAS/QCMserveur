<?php
namespace Code\Dao;

// require_once('Personne.php');
// require_once('CodesBDD.php');

class PersonneDAO {

	function lirePersonneParId($id) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT * FROM PERSONNE WHERE idPersonne = :id");
		$st->bindParam(":id", $id);
		$st->execute();
		$resultat = $st->fetchObject('\Code\Obj\Personne');

		if ($resulat) {
			return $resultat;
		} else {
			return false;
		}
	}   // fin function lirePersonneParId

	function lirePersonne($email) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT * FROM personne WHERE email= :email");
		$st->bindParam(":email", $email);
		$st->execute();
		$resultat = $st->fetchObject('\Code\Obj\Personne');
		if ($resultat) {
			$resultat->idPersonne = intval($resultat->idPersonne);
			return $resultat;
		} else {
			return false;
		}
	}

	function creePersonne($personne) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("INSERT INTO personne (nom, prenom, email, motDePasse, statut) VALUES (?, ?, ?, ?, ?)");
		$st->bindValue(1, $personne->nom);
		$st->bindValue(2, $personne->prenom);
		$st->bindValue(3, $personne->email);
		$st->bindValue(4, $personne->motDePasse);
		$st->bindValue(5, $personne->statut);
		$st->execute();
	}
}
?>
