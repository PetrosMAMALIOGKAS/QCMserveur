<?php
include('listerThemes.php');
global $vue;
?>
<div>
	<form method="POST" action="index.php?action=creer_theme">
		<fieldset>
			<legend>Creation d'un nouveau thème</legend>
			<label for="designation">Donnez la désignation SVP</label>
			<input type="text" id="designation" name="designation"  />
			<br/><br/>
			<input type="submit" value="ajoute" />
		</fieldset>
	</form>
</div>
