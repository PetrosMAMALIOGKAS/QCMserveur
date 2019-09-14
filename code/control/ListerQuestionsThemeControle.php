<?php
namespace Code\Control;

// require_once('Controle.php');
// require_once('ThemeLogique.php');
// require_once('QuestionLogique.php');

class ListerQuestionsThemeControle extends Controle {
	public $page = "listerQuestionsParTheme.php";

	function executer() {
		global $vue;
		$logique = new \Code\Logique\ThemeLogique();
		$themes = $logique->listeThemes();
		$vue['Themes'] = $themes;
		$logique = new \Code\Logique\QuestionLogique();
		@$idTheme = intval($_POST['idTheme']);
		$liste = $logique->listeQuestionsParTheme($idTheme);
		$vue['listeQuestions'] = $liste;
	}
}

?>
