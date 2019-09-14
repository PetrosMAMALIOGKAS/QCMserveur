<div>
<form action="index.php?action=creer_reponse" method="POST">
	<fieldset>
		<legend>Formulaire des reponses</legend>
		<label for="reponse1">reponse no: 1 </label>
		<input type="text" id="reponse1" name="premierReponse" /><br/>
		<label for="reponse2">reponse no: 2 </label>
		<input type="text" id="reponse2" name="deuxiemeReponse" /><br/>
		<label for="reponse3">reponse no: 3 </label>
		<input type="text" id="reponse3" name="troisiemeReponse" /><br/><br/>
		<label for="reponseCorrect">Quelle est la reponse correcte</label>
		<input type="number" id="reponseCorrect" name="reponseCorrect" min="1" max="3"/><br/><br/><br/>
		<input type="submit" value="submit" />
	</fieldset>
</form>

</div>
