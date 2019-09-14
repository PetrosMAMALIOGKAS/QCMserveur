<?php
namespace Code\Dao;

// require_once('Qcm.php');
// require_once('CodesBDD.php');

class ContientDAO {

	function creer($qcmContenu) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("INSERT INTO contient (idQcm, idQuestion) VALUES (?,?)");
		$st->bindValue(1, $qcmContenu->idQcm);
		$st->bindValue(2, $qcmContenu->idQuestion);
		$st->execute();
	}

	function numQuestions($idQcm) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT COUNT(*) FROM contient WHERE idQcm = :idQcm");
		$st->bindParam(":idQcm", $idQcm);
		$st->execute();
		return $st->fetchColumn();
	}
}
?>
