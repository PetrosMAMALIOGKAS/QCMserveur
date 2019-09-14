<?php
namespace Code\Logique;

//require_once('QuestionDAO.php');

class CreerQuestionLogique {
	public $succes;
	public $idQuestion;

	function creerQuestion($texteQuestion, $auteur, $idTheme) {
		$dao = new \Code\Dao\QuestionDAO();
		$question = new \Code\Obj\Question();
		$question->texteQuestion =  $texteQuestion;
		$question->auteur = 	    intval($auteur);
		$question->theme =          intval($idTheme);
		$dao->creer($question);
		$this->idQuestion = $dao->idQuestion;

		$this->succes = true;
	}

	function ajouterReponseCorrect($questionId, $reponseCorrect) {
		$dao = new \Code\Dao\QuestionDAO();
		$dao->ajouterCorrect($questionId, $reponseCorrect);
		$this->succes = true;
	}
}

?>
