<h5>Série : <?= $serie->name ?></h5>
<p>Genre : <?= $serie->genre ?></p>
<p>Nombre de saisons : <?= $serie->nb ?></p>
<div class="case">
<img src="data:image/jpeg;base64,<?= base64_encode($serie->jpeg) ?>" alt="<?= $serie->name ?>" />
<div class="overview">
    <?= $serie->overview ?>
</div>
</div>

<h6>Liste des saisons</h6>
<ul class="season-list"> 
<?php foreach($saisons as $saison): ?>
    <li class="season-card">  
        <img src="data:image/jpeg;base64,<?= base64_encode($saison->jpeg) ?>" alt="Poster saison" style="width:100px;" />
        <?= anchor("tvshow/GetSeasonDetails/{$saison->id}", "{$saison->name}") ?>
    </li>
<?php endforeach; ?>
</ul>





<?php if (! empty($_SESSION['username'])): ?>
    <form action="<?= site_url('comments/add/'.$serie->id) ?>" method="post">
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
<?php else: ?>
    <p>Vous devez <a href="<?= site_url('login/login') ?>">vous connecter</a> pour laisser un commentaire.</p>
<?php endif; ?>

<hr>

<!-- Liste des commentaires -->
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
