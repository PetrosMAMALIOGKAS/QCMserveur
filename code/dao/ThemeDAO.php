<?php
namespace Code\Dao;

// require_once('Theme.php');
// require_once('CodesBDD.php');
// require_once('Personne.php');

class ThemeDAO {

	function listerThemes(){
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->query("SELECT * FROM theme");
		$resultat = array();
		while ($resultatLigne = $st->fetchObject('\Code\Obj\Theme')) {
			$resultat[] = $resultatLigne;
		}
		if ($resultat) {
			return $resultat;
		} else {
			return false;
		}
	}


	function lireThemeParId($id) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT * FROM Theme WHERE idTheme= :id");
		$st->bindParam(":id", $id);
		$st->execute();
		$resultat = $st->fetchObject('\Code\Obj\Theme');
		if ($resultat) {
			return $resultat;
		} else {
			return false;
		}
	}

	function lireThemeParAuteur($idAuteur) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT * FROM theme WHERE createur= :idAuteur");
		$st->bindParam(":idAuteur", $idAuteur);
		$st->execute();
		$resultat = $st->fetchObject('\Code\Obj\Theme');
		if ($resultat) {
			return $resultat;
		} else {
			return false;
		}
	}

	function lireThemeParDesignation($designation) {
		global $DB_INFO;
		$db = null;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("SELECT * FROM theme WHERE designation= :designation");
		$st->bindParam(":designation", $designation);
		$st->execute();
		$resultat = $st->fetchObject('\Code\Obj\Theme');
		if ($resultat) {
			return $resultat;
		} else {
			return false;
		}
	}

	function creerThemeDAO($theme) {
		global $DB_INFO;
		$db = null;
		$_SESSION['Theme'] = $theme;
		$db = $DB_INFO->creeConnexion();
		$st = $db->prepare("INSERT INTO theme (designation, createur) VALUES(?,?)");
		$st->bindValue(1, $theme->designation);
		$st->bindValue(2, $theme->createur);
		$st->execute();
	}

}

?>
