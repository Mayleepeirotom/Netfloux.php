<br>
<form method="post">
	Pseudo
	<input type="text" name="pseudo" required>
	Adresse e-mail
	<input type="text" name="mail" required>
	Mot de passe
	<input type="password" name="password" required>
	<button type="submit">Inscription</button>
</form>
<?php if(isset($error)): ?>
	<p><?= $error; ?></p>
<?php endif; ?>
<a href="<?= site_url('login/login')?>">Connexion</a>