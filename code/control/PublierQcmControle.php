<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('QcmLogique.php');
// require_once('Qcm.php');




class PublierQcmControle extends Controle {
	public $page = "publierFormulaire.php";

	function executer() {
		if ($this->testerProfesseurEtDiriger()) {
			if (!isset($_POST['dateLimite'])) {
				$vue['dateLimite'] = "";
			} else {
				if (!empty($_POST['dateLimite'])) {
					$logique = new \Code\Logique\QcmLogique();
					$logique->publierQcm($_SESSION['Qcm']->idQcm, $_POST['dateLimite']);
					if ($logique->succes) {
						ajouteMessage("Qcm de code : " . $_SESSION['Qcm']->idQcm . " publie" );
						$this->redirect = "index.php";
					} else {
						ajouteMessage($logique->message);
					}
				} else {
					ajouteMessage("Vous devez donnez une date");
				}
			}
		}
	}
}

?>
