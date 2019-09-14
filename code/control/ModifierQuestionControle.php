<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('QuestionLogique.php');
// require_once('Question.php');

class ModifierQuestionControle extends Controle {
	public $page = "modifierFormulaire.php";

	function executer() {
		global $vue;
		var_dump($vue);
		// tester les droit des professeur et si la personne appartien la question
		if (estProfesseur() && $_SESSION['Personne']->idPersonne == $_SESSION['Question']->auteur) {
			if(!empty($_POST['texteQuestion']) && !empty($_POST['premierReponse']) && !empty($_POST['deuxiemeReponse']) && !empty($_POST['troisiemeReponse']) && !empty($_POST['reponseCorrect'])) {
				$logique = new \Code\Logique\QuestionLogique();
				$logique->modifierQuestion($_POST['texteQuestion'], $_POST['reponseCorrect'], $_SESSION['Question']->idQuestion);
				// verification du changement de question
				if ($logique->succes) {
					$logique->modifierReponse($_POST['premierReponse'],   $_SESSION['Question']->reponses[0]->idQuestion, $_SESSION['Question']->reponses[0]->idReponse);
					$logique->modifierReponse($_POST['deuxiemeReponse'],  $_SESSION['Question']->reponses[1]->idQuestion, $_SESSION['Question']->reponses[1]->idReponse);
					$logique->modifierReponse($_POST['troisiemeReponse'], $_SESSION['Question']->reponses[2]->idQuestion, $_SESSION['Question']->reponses[2]->idReponse);
					// verification du changement des reponse
					if ($logique->succes) {
						ajouteMessage("Question et Reponse avec l' id " . $_SESSION['Question']->idQuestion . " est modifier");
						$this->redirect = "index.php?action=lister_questions";
					} else {
						ajouteMessage("Reponses n'a pas changé");
					}

				} else {
					ajouteMessage("Question n'a pas changé");
				}
			}
		} else {
			ajouteMessage("Vous devez etre celui qui a cree la question afin de la modifier");
			$this->redirect = "index.php?action=lister_questions";
		}
	}

}


?>
