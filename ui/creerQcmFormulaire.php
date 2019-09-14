<p>Creation d'un vouveau QCM</p>
<form action="index.php?action=creer_qcm" method="POST">
	<div>
		<label for="designation">Donner le titre du qcm</label>
		<textarea id="designation" name="designation" cols="100" rows="1"></textarea>
		<fieldset>
			<legend>Cochez les question que vous voulez dans le qcm</legend>
			<table>
				<tr>
					<th>champ a cocher</th>
					<th>texte question</th>
					<th>theme de la question</th>
					<th>auteur de la question</th>
				</tr>
				<?php foreach ($vue['listeQuestions'] as $question) {
						$idQuestion = $question->idQuestion; ?>
				<tr>	
					<td><input type="checkbox" id="<?php echo 'ques' . $idQuestion; ?>" name="questionsDansQcm[]" value="<?php echo $idQuestion; ?>" /></td>
					<td><value for="<?php echo 'ques' . $idQuestion; ?>"><?php echo $question->texteQuestion; ?></label></td>
					<td><?php echo $question->theme; ?></td>
					<td><?php echo $question->auteur; ?></td>
				</tr>
				<?php } ?>
			</table>
		</fieldset>
		<input type="submit" value="creation" />
	</div>
</form>
