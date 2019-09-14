<?php
namespace Code\Dao;

// require_once('Question.php');
// require_once('CodesBDD.php');

class QuestionDAO {

	function creer($question) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("INSERT INTO question (texteQuestion, auteur, theme) VALUES (?,?,?)");
		$st->bindValue(1, $question->texteQuestion);
		$st->bindValue(2, $question->auteur);
		$st->bindValue(3, $question->theme);
		$st->execute();
		$this->idQuestion = $db->lastInsertId();
	}

	function ajouterCorrect($idQuestion, $reponseCorrect) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("UPDATE question SET reponseCorrect = :reponseCorrect WHERE idQuestion = :idQuestion");
		$st->bindParam(":reponseCorrect", $reponseCorrect);
		$st->bindParam(":idQuestion", $idQuestion);
		$st->execute();
	}

	/**
   * Liste les questions. Renvoie un ensemble d'objets Questions.
   * $utilisateur : tous les question que le auteur est le $utilisateur courant
   */

	function listeQuestions($utilisateur) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->query("SELECT * FROM question WHERE auteur = $utilisateur");
		$resultat = array();
		while ($questionObject = $st->fetchObject('\Code\Obj\Question')) {
			$resultat[] = $questionObject;
		}
		return $resultat;
	}

	function listeQuestionsParTheme($idTheme)  {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->query("SELECT * FROM question WHERE theme = $idTheme");
		$resultat = array();
		while ($questionObject = $st->fetchObject('\Code\Obj\Question')) {
			$resultat[] = $questionObject;
		}
		return $resultat;
	}


	function listeToutesQuestions() {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->query("SELECT * FROM question");
		$resultat = array();
		while ($question = $st->fetchObject('\Code\Obj\Question')) {
			$question->idQuestion     = intval($question->idQuestion);
			$question->auteur         = intval($question->auteur);
			$question->theme          = intval($question->theme);
			$question->reponseCorrect = intval($question->reponseCorrect);
			$resultat[] = $question;
		}
		return $resultat;
	}


	function lireQuestion($idQuestion) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT * FROM question WHERE idQuestion = :idQuestion");
		$st->bindParam(":idQuestion", $idQuestion);
		$st->execute();
		$resultat = $st->fetchObject('\Code\Obj\Question');
		$resultat->idQuestion     = intval($resultat->idQuestion);
		$resultat->auteur         = intval($resultat->auteur);
		$resultat->theme          = intval($resultat->theme);
		$resultat->reponseCorrect = intval($resultat->reponseCorrect);
		return $resultat;

	}

	function modifierQuestion($texteQuestion, $reponseCorrect, $idQuestion) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("UPDATE question SET texteQuestion= :texteQuestion, reponseCorrect= :reponseCorrect WHERE idQuestion= :idQuestion");
		$st->bindParam(":texteQuestion", $texteQuestion);
		$st->bindParam(":reponseCorrect", $reponseCorrect);
		$st->bindParam(":idQuestion", $idQuestion);
		$st->execute();

	}

}
?>
