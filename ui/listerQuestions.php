<p>Clicker sur le ID de question que vous voulez modifier</p>
<table>
	<tr>
		<th>ID Question</th>
		<th>Texte de question</th>
	</tr>
	<?php foreach($vue['listeQuestions'] as $question) { ?>
	<tr>
		<td><a href="index.php?action=modifier_question&amp;idQuestion=<?php echo $question->idQuestion; ?>"><?php echo $question->idQuestion; ?></a></td>
		<td><?php echo htmlentities($question->texteQuestion); ?></td>
	</tr>
	<?php } ?>
</table>