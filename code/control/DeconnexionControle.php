<?php
namespace Code\Control;

// require_once('Controle.php');

class DeconnexionControle extends Controle  {

	function executer() {
		$this->redirect = "index.php";
		unset($_SESSION['Personne']);
	}
}
?>
