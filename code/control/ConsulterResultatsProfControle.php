<?php
namespace Code\Control;


// require_once('Controle.php');
// require_once('QcmLogique.php');

class ConsulterResultatsProfControle extends Controle {
	public $page="consulterResultatsProf.php";

	function executer() {
		global $vue;
		$logique = new \Code\Logique\QcmLogique();
		$qcmSansDoublons = $logique->listerLesQcmsSansDoublons($_SESSION['Personne']->idPersonne);
		if ($logique->succes) {
			$_SESSION['QcmSansDoublons'] = $qcmSansDoublons;
		}
		if (isset($_POST['qcmchoise']) && !empty($_POST['qcmchoise'])) {
			if ($logique->succes) {
				$resultats = $logique->recupererResultats($_POST['qcmchoise']);
				$_SESSION['QcmProfConsulter'] = $resultats;
				//var_dump($_SESSION['QcmProfConsulter']);
				//break;
				$numQuestions = $logique->numQuestions($_POST['qcmchoise']);
				if ($logique->succes) {
					$_SESSION['NumQuestions'] = $numQuestions;
				} else {
					ajouteMessage("je ne ai pu pas compte les question");
				}
			} else {
				ajouteMessage("je ne peut trouver les resultats de qcm " . $_POST['qcmchoise']);
			}

		}




	}
}
?>
