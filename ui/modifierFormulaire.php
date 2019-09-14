<?php

global $vue;

?>

<form action="index.php?action=modifier_controle" method="POST">
	<fieldset>
		<legend>Question à modifier changer les champs que vous voulez et tapez submit</legend>
		<p>le theme de la question est <?php echo htmlspecialchars($vue['Question']->theme); ?></p>
		<label for="texteQuestion">la texte de la question</label>
		<textarea id="texteQuestion" name="texteQuestion" rows="1" cols="100"/><?php echo htmlspecialchars($vue['Question']->texteQuestion); ?></textarea><br/>
		<label for="reponse1">reponse No 1 :</label>
		<textarea id="reponse1" name="premierReponse" rows="1" cols="100" ><?php echo htmlspecialchars($vue['Question']->reponses[0]->texte); ?></textarea><br/>
		
		<label for="reponse2">reponse No 2 :</label>
		<textarea id="reponse2" name="deuxiemeReponse" rows="1" cols="100" ><?php echo htmlspecialchars($vue['Question']->reponses[1]->texte); ?></textarea><br/>
		
		<label for="reponse3">reponse No 3 :</label>
		<textarea id="reponse3" name="troisiemeReponse"  rows="1" cols="100" ><?php echo htmlspecialchars($vue['Question']->reponses[2]->texte); ?></textarea><br/>
		<br/>
		<label for="reponseCorrect">Vous voulez changer la reponse correcte</label>
		<input type="number" id="reponseCorrect" name="reponseCorrect" value="<?php echo htmlspecialchars($vue['Question']->reponseCorrect); ?>" min="1" max="3" />
		<br/><br/>
		<input type="submit" value="submit" />
	</fieldset>
</form>

<h3><?php 
		  // on copie la Question dans $_SESSION car $vue sera reinitialise en passant de index
		  $_SESSION['Question'] = $vue['Question'];
	?></h3>