<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('QcmLogique.php');

class PublierResultatsControle extends Controle  {
	public $page = "publierResultats.php";

	function executer() {
	 global $vue;
	 $logique = new \Code\Logique\QcmLogique();
	 $resultatsPretsPublier = $logique->resultatsPretsPublier($_SESSION['Personne']->idPersonne);

	 if ($logique->succes) {
		 $vue['ResultatsPublier'] = $resultatsPretsPublier;
 	 } else {
		 ajouteMessage($logique->message);
		 $this->redirect = "index.php";
	 }
	 if ($this->testerProfesseurEtDiriger()) {
		 if (!empty($_POST['resultPubli'])) {
			 $logique->publieResultats($_POST['resultPubli']);
			 if ($logique->succes) {
				 ajouteMessage("les resultats de qcm id " . $_POST['resultPubli'] . " sont publiee" );
				 $this->redirect = "index.php";
			 } else {
				 ajouteMessage($logique->message);
				 $this->redirect = "index.php";
			 }
		}
	 }


    }


}



?>
