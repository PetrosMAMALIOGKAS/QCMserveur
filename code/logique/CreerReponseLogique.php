<?php
namespace Code\Logique;

//require_once('ReponseDAO.php');

class CreerReponseLogique {
	public $succes;
	public $idReponse;

	function creerReponse($idQuestion, $texte) {
		$dao = new \Code\Dao\ReponseDAO();
		$reponse = new \Code\Obj\Reponse();
		$reponse->idQuestion = intval($idQuestion);
		$reponse->texte      = $texte;
		$dao->creer($reponse);
		$this->idReponse = $reponse->idReponse;
		$this->succes = true;

	}
}

?>
