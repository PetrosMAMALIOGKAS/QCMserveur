<form action="index.php?action=creation" method="POST">
	<h4>Creation d'un utilisateur</h4>
	<fieldset>
		<legend>Vos informations</legend>
		<label for="email">Email</label>
		<input type="email" id="email" name="email" value="<?php echo htmlspecialchars($vue['email']); ?>"/>
		<label for="motDePasse">mot de passe</label>
		<input type="password" id="motDePasse" name="motDePasse" />
		<label for="nom">Nom</label>
		<input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($vue['nom']); ?>"/>
		<label for="prenom">Prenom</label>
		<input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($vue['prenom']); ?>"/>
		<fieldset>
			<legend>Votre statut<legend/>
			<input type="radio" id="eleve" name="statut" value="ELE" <?php if ($vue['statut'] == 'ELE') echo 'checked'; ?>/>
			<label for="eleve">Eleve</label>
			<input type="radio" id="eleve" name="statut" value="PRO" <?php if ($vue['statut'] == 'PRO') echo 'checked'; ?>/>
			<label for="eleve">Professeur</label>
		</fieldset>
		<input type="submit" value="submit" />		
	</fieldset>
</form>