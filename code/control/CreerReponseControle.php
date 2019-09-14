<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('CreerReponseLogique.php');
// require_once('CreerQuestionLogique.php');

class CreerReponseControle extends Controle {

	public $page = "formulaireReponse.php";

	function executer() {
		global $vue;

		if ($this->testerProfesseurEtDiriger()) {
			if (!isset($_POST['reponseCorrect'])) {
				// premiere affichage
				$vue['premierReponse'] =   "";
				$vue['deuxiemeReponse'] =  "";
				$vue['troisiemeReponse'] = "";
				$vue['reponseCorrect'] =   "";
			} else {
				$montrerFormulaire = true;
				// On teste si le furmulaire est complet
				if (!empty($_POST['premierReponse']) && !empty($_POST['deuxiemeReponse']) && !empty($_POST['troisiemeReponse']) && !empty($_POST['reponseCorrect'])) {
					$idQuestion = $_SESSION['idQuestionATraiter'];
					$logique1 = new \Code\Logique\CreerReponseLogique();
					$logique2 = new \Code\Logique\CreerReponseLogique();
					$logique3 = new \Code\Logique\CreerReponseLogique();
					$logique1->creerReponse($idQuestion, $_POST['premierReponse']);
					$logique2->creerReponse($idQuestion, $_POST['deuxiemeReponse']);
					$logique3->creerReponse($idQuestion, $_POST['troisiemeReponse']);
					// ajoute de la question correct dans la BDD
					$logique = new \Code\Logique\CreerQuestionLogique();
					$logique->ajouterReponseCorrect($idQuestion ,$_POST['reponseCorrect']);
					if ($logique1->succes && $logique2->succes && $logique3->succes && $logique->succes) {
						$montrerFormulaire = false;
						ajouteMessage("Question /Reponse est cree ");
						$_SESSION['idQuestionATraiter'] = null;
						// future affichage de question reponse
						$this->redirect = "index.php";
					} else {
						ajouteMessage("Question /Reponse n'est pas cree au niveau logique");
					}
				} else {
					ajouteMessage("toutes les reponses doit etre completer ainsi que la reponse correct");
				}
				if ($montrerFormulaire) {
					$vue['premierReponse'] = empty($_POST['premierReponse']) ? "" : $_POST['premierReponse'];
					$vue['deuxiemeReponse'] = empty($_POST['deuxiemeReponse']) ? "" : $_POST['deuxiemeReponse'];
					$vue['troisiemeReponse'] = empty($_POST['troisiemeReponse']) ? "" : $_POST['troisiemeReponse'];
					$vue['reponseCorrect'] = empty($_POST['reponseCorrect']) ? "" : $_POST['reponseCorrect'];
				}
			}
		}
	}

}





?>
