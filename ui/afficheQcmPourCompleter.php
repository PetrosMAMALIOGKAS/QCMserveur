<?php


global $vue;

$i=1;
?>

<form action="index.php?action=traiter_completer" method="POST">
	<fieldset>
		<legend>Choisisez la bonne reponse de toutes les questions et clickez sur submit</legend>
		<?php foreach ($_SESSION['Questions'] as $question) { ?>
		<div>Question no: <?php echo $i; ?>
			<div>
				<?php echo $question->texteQuestion . " ?"; ?>
			</div>
			<table>
				<tr>
					<th>la correcte</th>
					<th></th>
				</tr>
			<?php foreach ($_SESSION['Reponses'][$i-1] as $reponse) { ?>

				<tr>
					<td><input type="radio"  id=<?php echo "reponse" . $reponse->idReponse; ?> name=<?php echo "reponseDequestion" . $reponse->idQuestion; ?> value=<?php echo $reponse->idReponse; ?> /></td>
					<td><label for=<?php echo "reponse" . $reponse->idReponse; ?>><?php echo $reponse->texte; ?></label> </td>
				</tr>

			<?php	} ?>

			</table>

		</div>
		<?php  $i++;
		} // for each questions


 ?>

		<input type="submit" value="submit" />

	</fieldset>
</form>
