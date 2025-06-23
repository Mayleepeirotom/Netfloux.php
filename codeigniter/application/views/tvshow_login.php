<br>
<form method="post">
	Pseudo ou adresse e-mail
	<input type="text" name="login" required>
	Mot de passe
	<input type="password" name="password" required>
	<button type="submit">Connexion</button>
</form>
<?php if(isset($error)): ?>
	<p><?= $error; ?></p>
<?php endif; ?>
<a href="<?= site_url('login/register')?>">Inscription</a>