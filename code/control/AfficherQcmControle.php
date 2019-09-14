<?php
namespace Code\Control;

//require_once('QcmLogique.php');
//require_once('Controle.php');

class AfficherQcmControle extends Controle {
	public $page = "publierFormulaire.php";

	function executer() {
		$logique = new \Code\Logique\QcmLogique();
		$qcm = $logique->lireQcm($_GET['idQcm']);
		if ($logique->succes) {
			global $vue;
			$vue['Qcm'] = $qcm;
			$_SESSION['Qcm'] = $qcm;
		} else {
			ajouteMessage($logique->message);
			$this->redirect = "index.php?action=lister_qcm";
		}
	}
}

?>
