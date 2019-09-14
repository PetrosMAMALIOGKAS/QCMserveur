<?php
global $vue;
?>
<form action="index.php?action=lister_questions_theme" method="POST">
	<fieldset>
		<legend>Choissisez le thme pour afficher ses questions</legend>
		<select name="idTheme">
		<?php foreach ($vue['Themes'] as $theme) { ?>
					<option value=<?php echo $theme->idTheme; ?>><?php echo $theme->designation; ?></option>			
		<?php } ?>
		</select>
		<br/>
		<input type="submit" value="submit" /> 
	</fieldset>
</form>
<?php
if ($vue['listeQuestions'] != null) {
?>
<div>
	<h5>Questions de theme id <?php echo $vue['listeQuestions'][0]->theme; ?></h5>
	<table>
		<tr>
			<th>id Question</th>
			<th>texte de question</th>
			<th>auteur</th>
		</tr>
<?php foreach ($vue['listeQuestions'] as $question) { ?>
		<tr>
			<td><?php echo $question->idQuestion; ?></td>
			<td><?php echo $question->texteQuestion; ?></td>
			<td><?php echo $question->auteur; ?></td>
		</tr>
<?php } ?>
	</table>

</div>

<?php } ?>