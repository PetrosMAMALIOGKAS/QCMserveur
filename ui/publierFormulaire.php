
<form action="index.php?action=publier_qcm" method="POST">
	<fieldset>
		<legend>publication du qcm avec l' id :<?php echo $_SESSION['Qcm']->idQcm; ?></legend>
		<h4>Titre du qcm</h4>
		<span><?php echo $_SESSION['Qcm']->designation; ?></span><br/><br/>
		<label for="dateLimite">Selectionez la date limite pur le QCM :</label>
		<input type="datetime-local" id="dateLilmite" name="dateLimite" /><br/><br/>
		<input type="submit" value="publier" />
	</fieldset>
	
</form>