<div class="menu">
	<?php
	foreach ($menu as $entree) {
		echo "<div class='enteeMenu'>" . $entree->afficheLigne() . "</div>";
	}
	?>
</div>