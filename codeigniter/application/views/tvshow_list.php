<h6>Liste des séries</h6>
<section class="list">
<?php foreach ($tvshow as $show): ?>
    <article>
        <img src="data:image/jpeg;base64,<?= base64_encode($show->jpeg) ?>" />
        <div class='short-text' >
        <?= anchor("tvshow/GetTvshowDetails/{$show->id}", "{$show->name}") ?>
        </div>
        <footer class='short-text'><?= $show->nb ?> saisons</footer>
    </article>
<?php endforeach; ?>
</section>
