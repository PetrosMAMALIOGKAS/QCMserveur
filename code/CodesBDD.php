<?php
/*
*  Informations pour la connexion à la base des données
*/

class DBinfo {
	public $serveur;
	public $db;
	public $login;
	public $password;

	function __construct($serveur, $db, $login, $password) {
		$this->serveur =     $serveur;
		$this->db =          $db;
		$this->login =       $login;
		$this->password =    $password;
	}

	function creeConnexion() {
		return new PDO("mysql:host=$this->serveur;dbname=$this->db", $this->login, $this->password,
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	}
}
global $DB_INFO;
$DB_INFO = new DBinfo("localhost", "qcmserveur", "root", "");

?>
