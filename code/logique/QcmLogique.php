<?php
namespace Code\Logique;

// require_once('QcmDAO.php');
// require_once('CompleterDAO.php');
// require_once('ContientDAO.php');

class QcmLogique {
	public $message;
	public $succes;

	function  listerQcmNonPublie() {
		$this->succes = false;
		$dao = new \Code\Dao\QcmDAO();
		$createur = $_SESSION['Personne']->idPersonne;
		$result =  $dao->listerQcmNonPublie($createur);
		if (count($result)== 0) {
			$this->succes = false;
			$this->message = "Vous n'avez pas des qcm non publie";
			return null;
		} else {
			$this->succes = true;
			return $result;
		}
	}

	function listerQcmPublie() {
		$this->succes = false;
		$dao = new \Code\Dao\QcmDAO();
		$idPersonne = $_SESSION['Personne']->idPersonne;
		$result = $dao->listerQcmPublie($idPersonne);
		$qcmNonExpire = $this->testerQcmDate($result);
		$result = $dao->listerQcmPublie($idPersonne);    // on appelle encore une fois pour obtenir les Qcm à jour
 		if (count($result) == 0) {
			$this->message = "Il n y pas de Qcms publie venez plus tard";
			return null;
		} else {
			$this->succes = true;
			return $result;
		}
	}



	function listerQcmExpireProf() {
		$this->succes = false;
		$dao = new \Code\Dao\QcmDAO();
		$idPersonne = $_SESSION['Personne']->idPersonne;
		$result = $dao->listerQcmPublieProf($idPersonne);
		$qcmNonExpire = $this->testerQcmDate($result);
 		if (count($result) == 0) {
			$this->message = "Il n y pas de Qcms expire pour publies les resultats venez plus tard";
			return null;
		} else {
			$this->succes = true;
			return $result;
		}
	}


	/*  Function qui test si les Qcm objets dans $results sont expire
	*	et appel a QcmDAO de les depublier
	*	@param $result : un tableau des Qcm objets
	*
	*	@ returns  true et les objets dans la basse des donnees sont modifier
	*/
	function testerQcmDate($result) {
		if (count($result) != 0) {
			foreach ($result as $qcm) {
				$dateLimite = new \DateTime($qcm->dateLimite);
				$maintenant = new \DateTime(date('Y-m-d H:i:s', time()));
				$comparaison = $dateLimite->diff($maintenant);
				$comparaison = $comparaison->format('%R%a days %H heures %i minutes %s  seconds');
				if (substr($comparaison, 0, 1) == "+") {
					$dao = new \Code\Dao\QcmDAO();
					$dao->depublierQcmExpire($qcm->idQcm);
				}
			}
		}
		return true;
	}


	function lireQcm($idQcm) {
		$this->succes = false;
		$dao = new \Code\Dao\QcmDAO();
		$createur = $_SESSION['Personne']->idPersonne;
		$result = $dao->lireQcm($idQcm);
		if ($result == null) {
			$this->succes  = false;
			$this->message = "Le qcm demande n'existe pas dans la base des donnees";
			return null;
		} elseif ($result->createur != $createur) {
			$this->succes  = false;
			$this->message = "Vous n' etes pas le createur de ce QCM donc vous pouvez pas le modifier";
			return null;
		} else {
			$this->succes = true;
			return $result;
		}
	}

	function publierQcm($idQcm, $dateLimite) {
		$this->succes = false;
		$dateLimite = str_replace("T" , " ", $dateLimite);
		$dateLimite = $dateLimite . ":00";
		$date = date('Y-m-d H:i:s', time());
		if ($this->getAnnee($date) > $this->getAnnee($dateLimite)) {
			$this->succes = false;
			$this->message = ("Vous pouvez donnez une date(annee) qui est passee");
		} elseif ($this->getMois($date) > $this->getMois($dateLimite)) {
			$this->succes = false;
			$this->message = ("Vous pouvez donnez une date(mois) qui est passee");
		} elseif ($this->getJour($date) > $this->getjour($dateLimite)) {
			$this->succes = false;
			$this->message = ("Vous pouvez donnez une date(jour) qui est passee");
		} else {
			$dao = new \Code\Dao\QcmDAO();
			$dao->publierQcm($idQcm, $dateLimite);
			$this->succes = true;
		}
	}

	function getAnnee($date) {
		$annee = substr($date, 0 , 4);
		return $annee;
	}

	function getMois($date) {
		$mois = substr($date, 5 , 2);
		return $mois;
	}

	function getJour($date) {
		$jour = substr($date, 8 , 2);
		return $jour;
	}


	function lireQcmPourCompleter($idQcm) {
		$this->succes = false;
		$dao = new \Code\Dao\QcmDAO();
		$result = $dao->lireQcm($idQcm);
		if ($result == null) {
			$this->succes  = false;
			$this->message = "Le qcm demande n'existe pas dans la base des donnees";
			return null;
		} elseif ($result->publication == -1) {
			$this->succes  = false;
			$this->message = "Vous avez deja completer ce qcm";
			return null;
		} elseif ($result->publication == 0) {
			$this->succes  = false;
			$this->message = "Ce qcm n'est pas publier";
			return null;
		} else {
			$this->succes = true;
			return $result;
		}


	}

	function listerQuestionsDeQcm($idQcm) {
		$this->succes = false;
		$dao = new \Code\Dao\QcmDAO();
		$result = $dao->listerQuestionsDeQcm($idQcm);
		if ($result == null) {
			$this->succes  = false;
			$this->message = "Le qcm demande n'a pas de questions";
			return null;
		} else {
			$this->succes = true;
			return $result;
		}
	}

	function sauvegardeResultat($qcm, $eleve, $reponsesDonne) {
		$this->succes = false;
		$dao = new \Code\Dao\CompleterDAO();
		$questions  = $_SESSION['Questions'];
		$reponses   = $_SESSION['Reponses'];
		$reponsesCorrectCounter = 0;
		$i = 0;
		foreach ($reponsesDonne as $idQuestion => $idReponse) {
			// verifier que c'est la question repondu
			if ($questions[$i]->idQuestion == $idQuestion) {
				$reponseCouranteCorrect = $questions[$i]->reponseCorrect; // on voir quelle est la question correct
				$reponseCouranteCorrect = $reponseCouranteCorrect - 1;    // -1 pour lire la reponse au tableau
			} else {
				$this->succes = false;
				$this->message = "La question repondu c'est pas la meme avec la question courante";
				return null;
			}
			// on verifie si la reponse donnee est correcte et on affecte le counter
			if ($reponses[$i][0]->idQuestion ==  $questions[$i]->idQuestion) {
				if ($reponses[$i][$reponseCouranteCorrect]->idReponse == intval($idReponse)) {
					$reponsesCorrectCounter++;
				}
			} else {
				$this->succes = false;
				$this->message = "L'indice de la reponse ne correspond pas a la question courante";
				return null;
			}
			$i++;
		}
		// on envoye les result a la base de donnees
		$dao->sauvegardeResultat($qcm, $eleve,$reponsesCorrectCounter);
		$this->succes = true;
	}

	function sauvegardeReponses($idQcm, $idPersonne, $reponsesDonne) {
		$this->succes = false;
		$dao = new \Code\Dao\CompleterDAO();
		foreach ($reponsesDonne as $idQuestion => $idReponse) {
			$dao->sauvegardeReponses($idQcm, $idPersonne, $idQuestion, $idReponse);
		}
		$this->succes = true;
	}


	function recupererResultats($idQcm) {
		$this->succes = false;
		$dao = new \Code\Dao\CompleterDAO();
		$result = $dao->recupererResultats(intval($idQcm));
		$this->succes = true;
		return $result;
	}



	function listerLesQcmsSansDoublons($idPersonne){
		$this->succes = false;
		$dao = new \Code\Dao\CompleterDAO();
		$result = $dao->recupererQcmsSansDoublons($idPersonne);
		$this->succes = true;
		return $result;
	}

	/* Compte le numero des qustion dans un qcm
	*  @param $idQcm   le identifiant de qcm qui va compte
	*  @return   un integer
	*/
	function numQuestions($idQcm) {
		$this->succes = false;
		$dao = new \Code\Dao\ContientDAO();
		$result = $dao->numQuestions($idQcm);
		$this->succes = true;
		return $result;

	}

	function resultatsPretsPublier($idPersonne) {
		$dao = new \Code\Dao\QcmDAO();
		$result = $dao->resultatsPretsPublier($idPersonne);
		if (count($result) == 0) {
			$this->message = "Il n y pas de resultats a publier ";
			$this->succes = false;
			return null;
		}
		$this->succes = true;
		return $result;
	}


	function publieResultats($idQcm) {
		$this->succes = false;
		$dao = new \Code\Dao\QcmDAO();
		$result = $dao->publieResultats($idQcm);
		if ($result) {
			$this->succes = true;
		} else {
			$this->succes = false;
			$this->message = ("je n'ai pas pu publie les resultats de qcm demande");
		}
	}

	function recupererResultatsEleve($idPersonne) {
		$dao = new \Code\Dao\CompleterDAO();
		$result = $dao->recupererResultatsEleve($idPersonne);
		if (count($result) == 0) {
			$this->message = "Il n y pas de resultats a consulter ";
			$this->succes = false;
			return null;
		}
		$this->succes = true;
		return $result;
	}




}
?>
