<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('QuestionLogique.php');


class AfficherQuestionControle extends Controle {
	public $page = "modifierFormulaire.php";

	function executer() {
		$logique = new \Code\Logique\QuestionLogique();
		if (!isset($_GET['idQuestion'])) {
			ajouteMessage("Question n'existe pas dans la base des donnees");
			$this->redirect= "index.php?action=lister_questions";
		} else {
			$question = $logique->lireQuestion($_GET['idQuestion']);
			if ($logique->succes) {
				global $vue;
				$vue['Question'] = $question;
				// on copie la Question dans $_SESSION car $vue sera reinitialise en passant de index
				//$_SESSION['Question'] = $question;
				$reponses = $logique->lireReponses($_GET['idQuestion']);
				if ($logique->succes) {
					$vue['Question']->reponses = $reponses;
					// on copie les  reponses dans $_SESSION car $vue sera reinitialise en passant de index
					//$_SESSION['Question']->reponses = $reponses;
				} else {
					ajouteMessage($logique->message);
					$this->redirect= "index.php?action=lister_questions";
				}
			} else {
				ajouteMessage($logique->message);
				$this->redirect= "index.php?action=lister_questions";
			}
		}

	}
}


?>
