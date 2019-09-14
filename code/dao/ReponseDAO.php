<?php
namespace Code\Dao;

// require_once('QuestionDAO.php');
// require_once('Question.php');
// require_once('CodesBDD.php');

class ReponseDAO {

	function creer($reponse) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("INSERT INTO reponse(idQuestion, texte) VALUES (?,?)");
		var_dump($reponse->idQuestion);
		var_dump($reponse->texte);
		$st->bindValue(1, intval($reponse->idQuestion));
		$st->bindValue(2, $reponse->texte);
		$st->execute();
		$reponse->idReponse = $db->lastInsertId();
	}

	function lireReponses($idQuestion) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT * FROM reponse WHERE idQuestion= :idQuestion");
		$st->bindParam(":idQuestion", $idQuestion);
		$st->execute();
		$resultat = array();
		while ($reponse = $st->fetchObject('\Code\Obj\Reponse')) {
			$reponse->idQuestion = intval($reponse->idQuestion);
			$reponse->idReponse  = intval($reponse->idReponse);
			$resultat[] = $reponse;
		}
		return $resultat;
	}

	function modifierReponses($reponse, $idQuestion, $idReponse) {
		global $DB_INFO;
		global $vue;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st= $db->prepare("UPDATE reponse SET texte= :texte WHERE idQuestion= :idQuestion AND idReponse= :idReponse");
		$st->bindParam(":texte", $reponse);
		$st->bindParam(":idQuestion", $idQuestion);
		$st->bindParam(":idReponse", $idReponse);
		$st->execute();
	}
}


?>
