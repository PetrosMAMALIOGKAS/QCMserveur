<?php
namespace Code\Control;

// require_once('ConnexionLogique.php');
// require_once('Controle.php');

class ConnexionControle extends Controle {
	public $page ="ConnexionFormulaire.php";

	function executer() {
		global $vue;
		global $_POST;
		if (!isset($_POST['email']) || !isset($_POST['motDePasse'])) {
			$vue["email"] =       "";
			$vue["motDePasse"] =  "";
		} elseif (empty($_POST['email']) || empty($_POST['motDePasse'])) {
			// L' un des deux champs n'est pas rempli
			$vue['email'] =       $_POST['email'];
			$vue['motDePasse'] =  "";  //il faut retaper le mot de passe
			ajouteMessage("donnez un email et un mot de passe");
		} else {
			// On tente la connexion
			$logique = new \Code\Logique\ConnexionLogique();
			$logique->connecterPersonne($_POST['email'], $_POST['motDePasse']);

			if ($logique->connexionCorrecte()) {
				$_SESSION['Personne'] = $logique->personne;

				// on demande la page d' affichage
				$this->redirect = "index.php";
			} else {
				ajouteMessage('email et/ou mot de passe incorrect pour ' . $_POST['email']);
				$vue['email'] =      $_POST['email'];
				$vue['motDePasse'] = "";
			}
		}
	}
}

?>
