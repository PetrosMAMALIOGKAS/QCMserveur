<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('QcmLogique.php');

class ListerQcmControle extends Controle {
	public $page = "listerQcm.php";

	function executer() {
		global $vue;
		$logique = new \Code\Logique\QcmLogique();
		$qcmListe = $logique->listerQcmNonPublie();
		if ($logique->succes) {
			$vue['listeQcm'] = $qcmListe;
			$_SESSION['listeQcm'] = $qcmListe;
		} else {
			ajouteMessage($logique->message);
			$this->redirect="index.php";
		}
	}
}
?>
