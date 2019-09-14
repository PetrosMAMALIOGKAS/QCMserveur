<?php
namespace Code\Dao;

// require_once('CodesBDD.php');
// require_once('Qcm.php');

class QcmDAO {

	function creer($qcm) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("INSERT INTO qcm (designation, createur) VALUES (?,?)");
		$st->bindValue(1, $qcm->designation);
		$st->bindValue(2, $qcm->createur);
		$st->execute();
		$qcm->idQcm = $db->lastInsertId();
	}

	function listerQcmNonPublie($createur) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT * FROM qcm WHERE createur = :createur AND publication = 0");
		$st->bindParam(":createur", $createur);
		$st->execute();
		$resultat = array();
		while ($qcm = $st->fetchObject('\Code\Obj\Qcm')) {
			$qcm->idQcm       = intval($qcm->idQcm);
			$qcm->createur    = intval($qcm->createur);
			$qcm->publication = intval($qcm->publication);
			$resultat[] = $qcm;
		}
		return $resultat;
	}

	function listerQcmPublie($idPersonne) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
	//	$st = $db->query("SELECT * FROM qcm WHERE publication = 1");
	    $st = $db->prepare("SELECT * FROM qcm WHERE publication = 1 AND idQcm NOT IN
									(SELECT idQcm FROM completer WHERE idPersonne= :idPersonne)");
		$st->bindParam(":idPersonne", $idPersonne);
		$st->execute();
		$resultat = array();
		while ($qcm = $st->fetchObject('\Code\Obj\Qcm')) {
			$qcm->idQcm       = intval($qcm->idQcm);
			$qcm->createur    = intval($qcm->createur);
			$qcm->publication = intval($qcm->publication);
			$resultat[] = $qcm;
		}
		return $resultat;
	}

	function listerQcmPublieProf($idPersonne) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
	    $st = $db->prepare("SELECT * FROM qcm WHERE publication = 1 AND idPersonne= :idPersonne");
		$st->bindParam(":idPersonne", $idPersonne);
		$st->execute();
		$resultat = array();
		while ($qcm = $st->fetchObject('\Code\Obj\Qcm')) {
			$qcm->idQcm       = intval($qcm->idQcm);
			$qcm->createur    = intval($qcm->createur);
			$qcm->publication = intval($qcm->publication);
			$resultat[] = $qcm;
		}
		return $resultat;
	}

	function lireQcm($idQcm) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT * FROM qcm WHERE idQcm= :idQcm");
		$st->bindParam(":idQcm", $idQcm);
		$st->execute();
		$resultat = $st->fetchObject('\Code\Obj\Qcm');
		$resultat->idQcm       = intval($resultat->idQcm);
		$resultat->createur    = intval($resultat->createur);
		$resultat->publication = intval($resultat->publication);
		return $resultat;
	}

	function publierQcm($idQcm, $dateLimite) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("UPDATE qcm SET dateLimite = :dateLimite, publication= 1 WHERE idQcm = :idQcm");
		$st->bindParam(":dateLimite", $dateLimite);
		$st->bindParam(":idQcm", $idQcm);
		$st->execute();
	}

	function listerQuestionsDeQcm($idQcm) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT * FROM contient WHERE idQcm= :idQcm");
		$st->bindParam(":idQcm", $idQcm);
		$st->execute();
		$result = array();
		while ($ligne = $st->fetch(\PDO::FETCH_ASSOC)) {
			$result[] = intval($ligne['idQuestion']);
		}
		return $result;
	}


	function depublierQcmExpire($idQcm) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("UPDATE qcm SET publication = -1 WHERE idQcm= :idQcm");
		$st->bindValue(":idQcm" , $idQcm);
		$st->execute();

	}

	function resultatsPretsPublier($idPersonne) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT * FROM qcm WHERE createur = :idPersonne AND publication = -1 AND publieResultats = 0");
		$st->bindParam(":idPersonne", $idPersonne);
		$st->execute();
		$resultat = array();
		while ($ligne = $st->fetch(\PDO::FETCH_ASSOC)) {
			$resultat[] = $ligne;
		}
		return $resultat;
	}

	function publieResultats($idQcm) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("UPDATE qcm SET publieResultats = 1 WHERE idQcm = :idQcm");
		$st->bindParam(":idQcm", $idQcm);
		return $st->execute();

	}




}
?>
