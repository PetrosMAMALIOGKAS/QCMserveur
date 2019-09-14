<?php


// Retourne vrai si la personne est connecté
//
function estConnecte() {
	return isset($_SESSION['Personne']);
}


// Retourne vrai si la personne est Professeur
//
function estProfesseur() {
	return estConnecte() && $_SESSION['Personne']->statut == "PRO";
}


// Retourne vrai si la personne est élève
//
function estEleve() {
	return estConnecte() && $_SESSION['Personne']->statut == "ELE";
}


/**
*
* function qui throws des exception au lieu des errors et des notices 
*
*/

function exception_error_handler($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // This error code is not included in error_reporting
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
}

// initialise les exceptions
set_error_handler("exception_error_handler");

?>