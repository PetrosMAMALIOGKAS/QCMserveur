 <?php
 global $vue;
 ?>
 <form action="index.php?action=publier_resultats" method="POST">
	<fieldset>
		<legend>Selection le Qcm pour publier ses resultats</legend>
		<table>
			<tr>
				<th>selection</th>
				<th>idQcm</th>
				<th>Designation</th>
			</tr>
	<?php foreach ($vue['ResultatsPublier'] as $qcm) { ?>
			<tr>
				<td><input type="radio" id=<?php echo "numero" . @$qcm[idQcm]; ?> name="resultPubli" value=<?php echo @$qcm[idQcm]; ?> /></td>
				<td><?php echo @$qcm[idQcm]; ?></td>
				<td><label for=<?php echo "numero" . @$qcm[idQcm]; ?>><?php echo @$qcm[designation]; ?></label></td>
			</tr>
	<?php } ?>
		</table>
		<br/>
		<input type="submit" value="submit" />
	</fieldset>
 </form>