<?php
namespace Code\Logique;

// require_once('QuestionDAO.php');
// require_once('ReponseDAO.php');

class QuestionLogique {
	public $message;
	public $succes;

	/**
	*  return les question que l'auteur est le Personne courante
	*
	*	@ return un array des Questions Objets
	*/
	function listeQuestions() {
		$dao = new \Code\Dao\QuestionDAO();
		$utilisateur = $_SESSION['Personne']->idPersonne;
		return $dao->listeQuestions($utilisateur);
	}

	function listeQuestionsParTheme($idTheme) {
		$this->succes = false;
		$dao = new \Code\Dao\QuestionDAO();
		$liste = $dao->listeQuestionsParTheme($idTheme);
		if ($liste == null) {
			$this->succes = false;
			$this->message = ("Il n y pas de questions de theme id" . $idTheme );
			return null;
		}
		$this->succes = true;
		return $liste;
	}

	function listeToutesQuestions() {
		$this->succes = false;
		$dao = new \Code\Dao\QuestionDAO();
		return $dao->listeToutesQuestions();
		$this->succes = true;
	}

	/**
	*	return le contenu de une ligne du tableau question
	*
	*	@param  integer   $idQuestion   le id de question à returner
	*	@rerurn Question  un objet question
	*/
	function lireQuestion($idQuestion) {
		$this->succes = false;
		$dao = new \Code\Dao\QuestionDAO();
		$question = $dao->lireQuestion($idQuestion);
		$this->succes = true;
		return $question;
	}

	function lireReponses($idQuestion) {
		$this->succes = false;
		$dao = new \Code\Dao\ReponseDAO();
		$reponses = $dao->lireReponses($idQuestion);
		$this->succes = true;
		return $reponses;
	}

	function modifierQuestion($texteQuestion, $reponseCorrect, $idQuestion) {
		$this->succes = false;
		$dao = new \Code\Dao\QuestionDAO();
		$modifications = $dao->modifierQuestion($texteQuestion, $reponseCorrect, $idQuestion);
		$this->succes = true;
	}

	function modifierReponse($reponse, $idQuestion, $idReponse) {
		$this->succes = false;
		$dao = new \Code\Dao\ReponseDAO();
		$modifications = $dao->modifierReponses($reponse, $idQuestion, $idReponse);
		$this->succes = true;
	}
}
?>
