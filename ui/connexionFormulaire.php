<form method = "POST" action = "index.php?action=connexion">
	<label for="email">email</label>
	<input type="email" name="email" id="email" value = "<?php echo htmlspecialchars($vue['email']); ?>" /><br/>
	<label for="motdepasse">Mot de passe</label>
	<input type="password" name="motDePasse" id="motdepasse" /><br/>
	<input type="submit" value="submit" />
</form>