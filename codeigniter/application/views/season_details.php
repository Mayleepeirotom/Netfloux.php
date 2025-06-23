<h5><?= $saison->serie_name ?></h5>
<p>Genre : <?= $saison->genre ?></p>
<img src="data:image/jpeg;base64,<?= base64_encode($saison->jpeg) ?>" alt="<?= $saison->serie_name ?>" />
<h6>Saison <?= $saison->seasonNumber ?> : <?= $saison->season_name ?></h6>

<h6>Liste des épisodes</h6>
<ul class="episode-list"> 
<?php foreach($episodes as $episode): ?>
    <li class="episode-card"> <strong><?= $episode->name ?></strong> : <?= $episode->overview ?></li>
<?php endforeach; ?>
</ul>

<br>
<?php if (! empty($_SESSION['username'])): ?>
    <form action="<?= site_url('comments/addSeason/'.$saison->id) ?>" method="post">
        <div>
            <label for="note">Note (1–5) :</label>
            <select name="note" id="note">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div>
            <label for="texte">Commentaire :</label>
            <textarea name="texte" id="texte" rows="4"></textarea>
        </div>
        <button type="submit">Envoyer</button>
    </form>
    <br>
<?php else: ?>
    <p>Vous devez <a href="<?= site_url('login/login') ?>">vous connecter</a> pour laisser un commentaire.</p>
<?php endif; ?>

<h6>Commentaires</h6>
<?php if (! empty($comments)): ?>
    <?php foreach ($comments as $c): ?>
        <div class="comment">
            <p>
                <strong><?= html_escape($c->userlogin) ?></strong>
                — <?= html_escape($c->note) ?>/5
            </p>
            <p><?= html_escape($c->texte) ?></p>
            <hr>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun commentaire pour le moment.</p>
<?php endif; ?>
