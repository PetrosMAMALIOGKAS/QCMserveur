<div class="listeMessages">
	<?php
	foreach (@listeMessages() as $msg) {
		echo '<div class="message">';
		echo htmlspecialchars($msg);
		echo '</div>';
	}
	?>
</div>
