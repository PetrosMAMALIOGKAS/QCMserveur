<?php
//include_once('./code/ListerControle.php');
$creeList = new \Code\Control\ListerControle();
$creeList->executer();
?>

<table>
<tr>
	<th>ID Theme</th>
	<th>Designation</th>
	<th>Creauteur</th>
</tr>
<?php
foreach ($vue['listeThemes'] as $theme) {
	echo "<tr>";
	echo "<td>" . $theme->idTheme     . "</td>";
	echo "<td>" . $theme->designation . "</td>";
	echo "<td>" . $theme->createur    . "</td>";
	echo "</tr>";
}

?>

</table>
