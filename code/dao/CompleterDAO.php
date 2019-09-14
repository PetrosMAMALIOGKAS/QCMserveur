<?php
namespace Code\Dao;

//require_once('CodesBDD.php');

class CompleterDAO {

	function sauvegardeReponses($idQcm, $idPersonne, $idQuestion, $idReponse) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("INSERT INTO reponsesqcm (idQuestion, idPersonne, idQcm, reponseDonne) VALUES (?,?,?,?)");
		$st->bindValue(1, $idQuestion);
		$st->bindValue(2, $idPersonne);
		$st->bindValue(3, $idQcm);
		$st->bindValue(4, $idReponse);
		try {
			$st->execute();
		}  catch (Exception $e) {

			return null;
		}
		//$st->execute();
	}

	function sauvegardeResultat($qcm, $eleve,$reponsesCorrectCounter) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("INSERT INTO completer (idPersonne, idQcm, resultat, dateSoumis) VALUES (?,?,?, NOW())");
		$st->bindValue(1, $eleve);
		$st->bindValue(2, $qcm);
		$st->bindValue(3, $reponsesCorrectCounter);
		//$st->execute();
		try {
			$st->execute();
		}  catch (Exception $e) {
			ajouteMessage("Vous avez deja completer ce qcm");
			return null;
		}
	}

	function verifierComplete($idQcm, $idPersonne) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT EXISTS(SELECT * FROM completer WHERE idQcm= :idQcm AND idPersonne= :idPersonne)");
		$st->bindParam(":idQcm", $idQcm);
		$st->bindParam(":idPersonne", $idPersonne);
		return $st->execute();
	}


	function recupererResultats($idQcm) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT * FROM completer WHERE idQcm= :idQcm");
		$st->bindParam("idQcm", $idQcm);
		$st->execute();
		$resultat = array();
		while ($ligne = $st->fetch(\PDO::FETCH_ASSOC)) {
			$resultat[] = $ligne;
		}
		return $resultat;
	}


	function recupererQcmsSansDoublons($idPersonne) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT DISTINCT(idQcm) FROM completer WHERE idQcm IN
								(SELECT idQcm FROM qcm WHERE createur = :idPersonne AND (publication = 1 OR publication = -1));");
		$st->bindParam("idPersonne", $idPersonne);
		$st->execute();
		$resultat = array();
		while ($ligne = $st->fetch(\PDO::FETCH_ASSOC)) {
			$resultat[] = $ligne;
		}
		return $resultat;
	}

	function recupererResultatsEleve($idPersonne) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT * FROM completer WHERE idPersonne = :idPersonne AND idQcm IN
								(SELECT idQcm FROM qcm WHERE publieResultats = 1)");
		$st->bindParam(":idPersonne", $idPersonne);
		$st->execute();
		$resultat = array();
		while ($ligne = $st->fetch(\PDO::FETCH_ASSOC)) {
			$resultat[] = $ligne;
		}
		return $resultat;
	}


}
?>
