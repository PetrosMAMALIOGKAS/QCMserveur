<?php
namespace Code\Control;


// require_once('Controle.php');


// Controle qui permet d'afficher une page fixe

class PageControle extends Controle {

	function __construct($page) {
		$this->page = $page;
	}
}

?>
