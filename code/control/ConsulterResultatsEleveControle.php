<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('QcmLogique.php');

class ConsulterResultatsEleveControle extends Controle  {
	public $page = "consulterResultatsEleve.php";

	function executer() {
		global $vue;
		$logique = new \Code\Logique\QcmLogique();
		$resultats = $logique->recupererResultatsEleve($_SESSION['Personne']->idPersonne);
		$numQuestions = array();

		if ($this->testerEleveEtDiriger() && $logique->succes) {
			foreach ($resultats as $result) {
				$numQestions[] = $logique->numQuestions(@$result[idQcm]);
			}
			$vue['ResultatsEleve'] = $resultats;
			$vue['numQuestions'] = $numQestions;

		} else {
			ajouteMessage($logique->message);
			$this->redirect= "index.php";
		}


	}

}
?>
