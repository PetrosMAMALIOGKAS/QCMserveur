<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('CreerQuestionLogique.php');
// require_once('CreerReponseLogique.php');

class CreerQuestionControle extends Controle {
	public $page = "formulaireQuestion.php";

	function executer() {
		global $vue;
		$montrerFormulaire = "";
		// tester les droit d' access
		if ($this->testerProfesseurEtDiriger()) {
			// verifier si on o déjà afficher le formulaire
			if (!isset($_POST['texteQuestion']) || !isset($_POST['idTheme'])) {
				$vue['idTheme'] =          "";
				$vue['texteQuestion'] =  "";
			} else {
				$montrerFormulaire = true;
				// On teste si la formulaire est complet..
				if (!empty($_POST['idTheme']) && !empty($_POST['texteQuestion'])) {
					$logique = new \Code\Logique\CreerQuestionLogique();
					$logique->creerQuestion($_POST['texteQuestion'], $_SESSION['Personne']->idPersonne, $_POST['idTheme']);
					if ($logique->succes) {
						$montrerFormulaire = false;
						// on garde au session le numero de qustion pôur ajouter des reponses
						$_SESSION['idQuestionATraiter'] = $logique->idQuestion;
						$this->redirect = "index.php?action=creer_reponse";
					} else {
						ajouteMessage("Question pas creer au niveau logique");
					}

				} else {
					ajouteMessage("Une question doit avoir un theme et du texte");
				}
				if ($montrerFormulaire) {
					$vue['idTheme'] = empty($_POST['idTheme']) ? "" :$_POST['idTheme'];
					$vue['texteQuestion'] = empty($_POST['texteQuestion']) ? "" : $_POST['texteQuestion'];
				}


			}
		}
	}





}

?>
