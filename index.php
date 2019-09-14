<?php
require("vendor/autoload.php");

use Code\Control\PageControle;

// require_once("code/Personne.php");
// require_once("code/Theme.php");
// require_once("code/Question.php");
// require_once("code/Qcm.php");

// on declare la timezone
date_default_timezone_set("Europe/Paris");

session_start();

// functions utilitaires de l'application

//require_once("code/general.php");

if (isset($_GET['action'])) {
	$action = $_GET['action'];
}
else {
	$action = "";
}

// appel de fichier qui contient les messages destinees au utilisateur

//require_once("code/messages.php");

// Initialisation des donnees pour la vue si vide

$vue = array();
$vue['titrePage'] = "Home Page";



switch ($action) {
	case "connexion" :
		//require_once('code/ConnexionControle.php');
		$commande = new Code\Control\ConnexionControle();
		break;
	case "deconnexion" :
		//require_once('code/DeconnexionControle.php');
		$commande = new Code\Control\DeconnexionControle();
		break;
	case "creation" :
		//require_once('code/CreerUtilisateurControle.php');
		$commande = new Code\Control\CreerUtilisateurControle();
		break;
	case "lister_questions_theme" :
		//require_once('code/ListerQuestionsThemeControle.php');
		$commande = new Code\Control\ListerQuestionsThemeControle();
		break;
	case "creer_theme" :
		//require_once('code/CreerThemeControle.php');
		$commande = new Code\Control\CreerThemeControle();
		break;
	case "creer_question" :
		//require_once('code/CreerQuestionControle.php');
		$commande = new Code\Control\CreerQuestionControle();
        break;
	case "creer_reponse" :
		//require_once('code/CreerReponseControle.php');
    	$commande = new Code\Control\CreerReponseControle();
        break;
	case "modifier_question" :
		//require_once('code/AfficherQuestionControle.php');
    	$commande = new Code\Control\AfficherQuestionControle();
        break;
	case "lister_questions" :
		//require_once('code/ListerQuestionsControle.php');
    	$commande = new Code\Control\ListerQuestionsControle();
		break;
	case "modifier_controle" :
		//require_once('code/ModifierQuestionControle.php');
    	$commande = new Code\Control\ModifierQuestionControle();
        break;
	case "creer_qcm" :
		//require_once('code/CreerQcmControle.php');
    	$commande = new Code\Control\CreerQcmControle();
        break;
	case "lister_qcm" :
		//require_once('code/ListerQcmControle.php');
    	$commande = new Code\Control\ListerQcmControle();
        break;
	case "afficher_qcm" :
		//require_once('code/AfficherQcmControle.php');
    	$commande = new Code\Control\AfficherQcmControle();
        break;
	case "publier_qcm" :
		//require_once('code/PublierQcmControle.php');
    	$commande = new Code\Control\PublierQcmControle();
        break;
	case "lister_qcm_publie" :
		//require_once('code/ListerQcmPublieControle.php');
    	$commande = new Code\Control\ListerQcmPublieControle();
        break;
	case "afficher_qcm_pour_completer" :
		//require_once('code/AfficherQcmPourCompleterControle.php');
    	$commande = new Code\Control\AfficherQcmPourCompleterControle();
        break;
	case "traiter_completer" :
		//require_once('code/TraiterCompleterControle.php');
    	$commande = new Code\Control\TraiterCompleterControle();
        break;
	case "consulter_resultats_prof" :
		//require_once('code/ConsulterResultatsProfControle.php');
    	$commande = new Code\Control\ConsulterResultatsProfControle();
        break;
	case "publier_resultats" :
		//require_once('code/PublierResultatsControle.php');
    	$commande = new Code\Control\PublierResultatsControle();
        break;
	case "consulter_resultats_eleve" :
		//require_once('code/ConsulterResultatsEleveControle.php');
    	$commande = new Code\Control\ConsulterResultatsEleveControle();
        break;
	case "" :
		//require_once('code/PageControle.php');
		$commande = new Code\Control\PageControle("accueil.php");
		break;
	default :
		//require_once('code/InconnuControle.php');
		$commande = new Code\Control\InconnuControle;
}

$commande->executer();


//require_once('code/EntreeMenu.php');

// les entrees des menu generaux
$menu = array(new Code\Obj\EntreeMenu("Connexion",       "index.php", array("action" => "connexion")),
						 	new Code\Obj\EntreeMenu("Deconnexion",     "index.php", array("action" => "deconnexion")),
			  			new Code\Obj\EntreeMenu("Creer un compte", "index.php", array("action" => "creation"))
			  		);

// les entrees des menu de Professeur
if (@$_SESSION['Personne']->statut == 'PRO' ) {
	$menu[] = new Code\Obj\EntreeMenu("Lister les question par theme",   "index.php", array("action" => "lister_questions_theme"));
	$menu[] = new Code\Obj\EntreeMenu("Creer un theme",                  "index.php", array("action" => "creer_theme"));
	$menu[] = new Code\Obj\EntreeMenu("Creer une question",              "index.php", array("action" => "creer_question"));
	$menu[] = new Code\Obj\EntreeMenu("Consulter/Modifier une question", "index.php", array("action" => "lister_questions"));
	$menu[] = new Code\Obj\EntreeMenu("Creer un Qcm",                    "index.php", array("action" => "creer_qcm"));
	$menu[] = new Code\Obj\EntreeMenu("Publier un Qcm",                  "index.php", array("action" => "lister_qcm"));
	$menu[] = new Code\Obj\EntreeMenu("Consulter les resultats",         "index.php", array("action" => "consulter_resultats_prof"));
	$menu[] = new Code\Obj\EntreeMenu("Publier les resultats",           "index.php", array("action" => "publier_resultats"));

}

// les entrees des menu d' eleve
if (@$_SESSION['Personne']->statut == 'ELE' ) {
	$menu[] = new Code\Obj\EntreeMenu("Lister les Qcm publie/completer Qcm",         "index.php", array("action" => "lister_qcm_publie"));
	$menu[] = new Code\Obj\EntreeMenu("Consulter les resultats",      				"index.php", array("action" => "consulter_resultats_eleve"));
}


if ($commande->redirect) {
	header('Location: ' . $commande->redirect);
} elseif ($commande->page) {
	include("ui/entete.php");
	include("ui/menu.php");
	include("ui/listeMessages.php");
	echo "<div class='contenu'>";
	include("ui/" . $commande->page);
	echo "<div>";
	include("ui/pied.php");
}



?>
