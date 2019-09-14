<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('QcmLogique.php');
// require_once('QuestionLogique.php');


class AfficherQcmPourCompleterControle extends Controle {
	public $page = "afficheQcmPourCompleter.php";

	function executer() {
		$logique = new \Code\Logique\QcmLogique();
		$qcm = $logique->lireQcmPourCompleter($_GET['idQcm']);
		if ($logique->succes) {
			$_SESSION['Qcm'] = $qcm;
			//on recoupere les question de qcm
			$idQcm = $qcm->idQcm;
			$listeDeQuestions = $logique->listerQuestionsDeQcm($idQcm);
			$logique = new \Code\Logique\QuestionLogique();
			$questionsQcm = array();
			$reponsesQcm  = array();
			foreach ($listeDeQuestions as $idQuestion) {
				$questionsQcm[] = $logique->lireQuestion($idQuestion);
				$reponsesQcm[]  = $logique->lireReponses($idQuestion);
			}
			$_SESSION['Questions'] = $questionsQcm;
			$_SESSION['Reponses'] = $reponsesQcm;
		} else {
			ajouteMessage($logique->message);
		}
	}
}
?>
