<?php
global $vue;

?>

<form action="index.php?action=consulter_resultats_prof" method="POST">
	<fieldset>
		<legend>Selectionez le Qcm que vous voulez voir les resultats</legend>
			<select id="qcmchoise" name="qcmchoise">
				<?php foreach ($_SESSION['QcmSansDoublons'] as $qcm) { ?>
				<option value=<?php echo @$qcm[idQcm]; ?>><?php echo @$qcm[idQcm]; ?></option>
				<?php } ?>
			</select>
			<input type="submit" value="submit"	/>
	</fieldset>
</form>
<br/><br/>
<?php if (isset($_SESSION['QcmProfConsulter'])) { ?>
<table>
	<tr>
		<th>id Qcm</th>
		<th>Eleve</th>
		<th>Date Soumis</th>
		<th>Questiuons correctes</th>
	</tr>
	<?php foreach (@$_SESSION['QcmProfConsulter'] as $resultat) { ?>
		<tr>
			<td><?php echo @$resultat[idQcm]; ?></td>
			<td><?php echo @$resultat[idPersonne]; ?></td>
			<td><?php echo @$resultat[dateSoumis]; ?></td>
			<td><?php echo @$resultat[resultat] . " sur " . $_SESSION['NumQuestions']; ?></td>
		</tr>
	<?php } ?>
</table>
<?php } ?>