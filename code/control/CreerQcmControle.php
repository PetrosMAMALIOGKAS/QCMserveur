<?php
namespace Code\Control;

// require_once('QuestionLogique.php');
// require_once('Question.php');
// require_once('CreerQcmLogique.php');
// require_once('Controle.php');

class CreerQcmControle extends Controle {
	public $page = "creerQcmFormulaire.php";

	function executer() {
		global $vue;
		// on obtient toutes les questiojns de la base des donnees
		$logique = new \Code\Logique\QuestionLogique();
		$vue['listeQuestions'] = $logique->listeToutesQuestions();
		// on teste les droits de Personne courante
		if ($this->testerProfesseurEtDiriger()) {
			if (!isset($_POST['designation'])) {
				$vue['designation'] = "";
			} else {
				$montrerFormulaire = true;
				// on teste si la formulaire est compet et si le qcm contient au moins 2 questions
				if (!empty($_POST['designation']) && !empty($_POST['questionsDansQcm']) && (count($_POST['questionsDansQcm']) > 1)) {
					$logique = new \Code\Logique\CreerQcmLogique();
					$logique->creerQcm($_POST['designation'], $_SESSION['Personne']->idPersonne);
					if ($logique->succes) {
						$questionsDansQcm = $_POST['questionsDansQcm'];
						// boucle pour declarer toutes les question dans contient
						foreach ($questionsDansQcm as  $idQuestion) {
							$logique->creeContenuQcm($logique->idQcm, $idQuestion);
						}
						if ($logique->succes) {
							ajouteMessage("le Qcm de id : " . $logique->idQcm . " cree");
							$montrerFormulaire = false;
							$this->redirect = "index.php";
						} else {
							ajouteMessage("Error de insertion de contenu de qcm");
						}

					} else {
						ajouteMessage("Error lors de la creation du qcm");
					}

				} else {
					ajouteMessage("Un QCM  doit avoir une designation et au moins deux questions");
				}
				if ($montrerFormulaire) {
					$vue['designation'] = empty($_POST['designation']) ? "" : $_POST['designation'];
				}
			}
		}

	}
}

?>
