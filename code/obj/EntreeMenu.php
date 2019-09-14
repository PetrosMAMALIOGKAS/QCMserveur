<?php
namespace Code\Obj;

class EntreeMenu {
	public $label;
	public $lien;
	public $args;

	function __construct($label, $lien, $args) {
		$this->label =   $label;
		$this->lien =    $lien;
		$this->args =    $args;
	}


	// renvoie l'entree de menu
	function afficheLigne() {
		$adresse = $this->lien;
		$seperateur = "?";
		foreach ($this->args as $name => $val) {
			$adresse = $adresse . $seperateur . urlencode($name) . "=" . urlencode($val);
			$seperateur = "&amp";
		}
		return '<a href="' .$adresse . '">' . htmlspecialchars($this->label) . "</a>";

	}
}

?>
