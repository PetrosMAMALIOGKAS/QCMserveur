<?php
/**
* Gestion des messages destinées à l'utilisateur
*/

if (!isset($_SESSION['messages'])) {
	effaceMessages();
}

// Function qui reinitialise le tableau messages
//
function effaceMessages() {
	$_SESSION['messages'] = array();
}


// Function qui ajoute un message au tablea messages
//
function ajouteMessage($msg) {
	$_SESSION['messages'][] = $msg;
}

// Retourne le tableau des messages at le reinitialise
//
function listeMessages() {
	@$resultat = $_SESSION['messages'];
	$_SESSION['messages'] = array();
	return $resultat;
}
?>
