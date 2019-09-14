<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('QuestionLogique.php');

class ListerQuestionsControle extends Controle {
	public $page = "listerQuestions.php";

	function executer() {
		$logique = new \Code\Logique\QuestionLogique();
		$liste = $logique->listeQuestions();
		global $vue;
		$vue['listeQuestions'] = $liste;
	}
}

?>
