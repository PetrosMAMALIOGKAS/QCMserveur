<?php 
global $vue;

$i = 0;
?>
<table>
	<tr>
		<th>idQcm</th>
		<th>dateSoumis</th>
		<th>Resultat</th>
	</tr>
<?php foreach ($vue['ResultatsEleve'] as $result) { ?>
	<tr>
		<td><?php echo @$result['idQcm']; ?></td>
		<td><?php echo @$result['dateSoumis']; ?></td>
		<td><?php echo @$result['resultat'] . "/" . @$vue['numQuestions'][$i]; ?></td>
	</tr>
<?php $i++;
		} ?>
</table>

