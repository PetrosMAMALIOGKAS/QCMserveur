<?php
namespace Code\Logique;

//require_once('ThemeDAO.php');

class ThemeLogique {

	function listeThemes() {
		$dao = new \Code\Dao\ThemeDAO();
		return $dao->listerThemes();
	}
}

?>
