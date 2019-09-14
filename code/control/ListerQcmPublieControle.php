<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('QcmLogique.php');

class ListerQcmPublieControle extends Controle {
	public $page = "listerQcm.php";

	function executer() {
		$logique = new \Code\Logique\QcmLogique();
		$liste = $logique->listerQcmPublie();
		global $vue;
		if ($logique->succes) {
			//$liste = $logique->enleverLesQcmComplete($liste);
			$vue['listeQcm'] = $liste;
			$_SESSION['listeQcm'] = $liste;
		} else {
			ajouteMessage($logique->message);
			$this->redirect = "index.php";
		}
	}
}
?>
