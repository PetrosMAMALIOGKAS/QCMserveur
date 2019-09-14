<?php
namespace Code\Logique;

// require_once('QcmDAO.php');
// require_once('ContientDAO.php');

class CreerQcmLogique {
	public $succes;
	public $message;
	public $idQcm;

	function creerQcm($designation, $createur) {
		$dao = new \Code\Dao\QcmDAO();
		$qcm = new \Code\Obj\Qcm();
		$qcm->designation = $designation;
		$qcm->createur    = $createur;
		$dao->creer($qcm);
		$this->idQcm = $qcm->idQcm;
		$this->succes = true;
	}

	function creeContenuQcm($idQcm, $idQuestion) {
		$dao = new \Code\Dao\ContientDAO();
		$qcmContenu = new \Code\Obj\Contient();
		$qcmContenu->idQcm      = $idQcm;
		$qcmContenu->idQuestion = $idQuestion;
		$dao->creer($qcmContenu);
		$this->succes = true;
	}
}

?>
