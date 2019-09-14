<?php
namespace Code\Logique;

//require_once('ThemeDAO.php');

class CreerThemeLogique {
	public $succes;

	function creerTheme($designation) {
		$dao =    new \Code\Dao\ThemeDAO();
		$theme =  new \Code\Obj\Theme();

		$theme->designation = $designation;
		$theme->createur    = intval($_SESSION['Personne']->idPersonne);
		$dao->creerThemeDAO($theme);
		$this->succes = true;

	}
}

?>
