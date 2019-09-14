<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('CreerUtilisateurLogique.php');

class CreerUtilisateurControle extends Controle  {
	public $page = "formulaireCreerUtilisateur.php";

	function executer() {
		global $vue;
		if (!isset($_POST['email'])) {
			$vue['email']      = "";
			$vue['motDePasse'] = "";
			$vue['nom']        = "";
			$vue['prenom']     = "";
			$vue['statut']     = "";
		} else {
			$montrerFormulaire = true;
		if (!empty($_POST['email']) && !empty($_POST['motDePasse']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['statut'])) {
			$logique = new \Code\Logique\CreerUtilisateurLogique();
			$logique->creeUtilisateur($_POST['email'], $_POST['motDePasse'], $_POST['nom'], $_POST['prenom'], $_POST['statut']);
			if ($logique->succes) {
				ajouteMessage('Votre compte etait cree. Vous pouvez connecter ');
				$this->redirect = "index.php";
			} else {
				ajouteMessage($logique->message);
			}

		} else {
			ajouteMessage('Vous devez definir le login, mot de passe, nom, prenom et statut');
		}
		if ($montrerFormulaire) {
			@$vue['email']      = $_POST['email'];
			@$vue['nom']        = $_POST['nom'];
			@$vue['prenom']     = $_POST['prenom'];
			@$vue['statut']     = $_POST['statut'];
		}
		}
	}
}
?>
