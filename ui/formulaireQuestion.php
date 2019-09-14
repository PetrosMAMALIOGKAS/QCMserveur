<?php
//include_once('./code/ListerControle.php');
$creeList = new \Code\Control\ListerControle();
$creeList->executer();
$tableLength = count($vue['listeThemes']);
?>

<div>
	<form action="index.php?action=creer_question" method="POST">
		<fieldset>
			<legend>Formulaire de question</legend>
			<br/>
			<p>choissisez la theme la question à creer</p>
			<?php foreach ($vue['listeThemes'] as $themeCourant) {
					$flag= 1; ?>
			<input type="radio" id="<?php echo $flag; ?>" name="idTheme" value="<?php echo $themeCourant->idTheme; ?>"/>
			<label for="<?php echo $flag; ?>"><?php echo $themeCourant->designation; ?></label><br/>
			<?php $flag++;
				}
			?>
			<br/><br/>
			<label for="texteQuestion">Donnez la texte de la question</label>
			<textarea id="texteQuestion" name="texteQuestion" rows="1" cols="100"></textarea>
			<br/><br/>
			<input type="submit" value="submit" />
		</fieldset>
	</form>

</div>
