<?php
namespace Code\Control;

// require_once('Controle.php');

class InconnuControle extends Controle {
	public $redirect = "index.php";

	function executer() {
		global $vue;
		ajouteMessage("Désolé la page demandé n'existe pas");
		ajouteMessage("Esayer une autre page");

	}

}
?>
