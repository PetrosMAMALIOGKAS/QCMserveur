<?php 
global $vue;
if (@$vue['listeQcm'][0]->publication == 0) {
	echo "<p>Clicker sur le ID de QCM que vous voulez publier</p>";
	$action = "afficher_qcm";
} elseif ($vue['listeQcm'][0]->publication == 1) {
	echo "<p>Clicker sur le ID de QCM que vous voulez completer</p>";
	$action = "afficher_qcm_pour_completer";
}
?>

	
	<table>
		<tr>
			<th>ID QCM</th>
			<th>Titre</th>
		</tr>
		<?php foreach($vue['listeQcm'] as $qcm) { ?>
		<tr>
			<td><a href="index.php?action=<?php echo $action; ?>&amp;idQcm=<?php echo $qcm->idQcm; ?>"><?php echo $qcm->idQcm; ?></a></td>
			<td><?php echo htmlentities($qcm->designation); ?></td>
		</tr>
		<?php } ?>
	</table>
