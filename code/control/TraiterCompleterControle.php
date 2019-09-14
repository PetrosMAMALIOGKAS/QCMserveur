<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('QcmLogique.php');

class TraiterCompleterControle extends Controle {
	public $page = "afficheQcmPourCompleter.php";

	function executer() {
		// creation d'un tableau avec tous les nom des variables du formulaire
		$reponsesNames = array();
		foreach ($_SESSION['Questions'] as $question) {
			$reponsesNames[] = "reponseDequestion" . $question->idQuestion;
		}

		// verifier si toutes les questions ont repondu;
		if ($this->checkEmptyField($reponsesNames)) {
			$qcm   = $_SESSION['Qcm']->idQcm;
			$eleve = $_SESSION['Personne']->idPersonne;
			$reponsesDonne = $this->creeTableauDeReponses($reponsesNames);
			$logique = new \Code\Logique\QcmLogique();
			$logique->sauvegardeResultat($qcm, $eleve, $reponsesDonne);
			if ($logique->succes) {
				$logique->sauvegardeReponses($qcm, $eleve, $reponsesDonne);
				if ($logique->succes) {
					ajouteMessage('Merci pour vos reponse les results seront publie prochainement');
					$this->redirect = "index.php";
				} else {
					ajouteMessage($logique->message);
					$this->redirect = "index.php";
				}
			} else {
				ajouteMessage($logique->message);
				$this->redirect = "index.php";
			}
		} else {
			ajouteMessage("Vous devez donner une reponse pour toutes les questions");
		}

	}


	function checkEmptyField($reponsesNames) {
		$result = true;
		foreach ($reponsesNames as $name) {
			if (empty($_POST[$name])) {
				return false;
			}
		}
		return $result;

	}

	function creeTableauDeReponses($reponsesNames) {
		$result = array();
		foreach ($reponsesNames as $name) {
			$idQuestion = intval(substr($name, 17,2));
			$result[$idQuestion] = $_POST[$name];
		}
		return $result;
	}
}

?>
