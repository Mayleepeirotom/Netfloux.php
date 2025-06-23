<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Netfloux</title>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
        />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <?=link_tag('assets/style.css')?>
    </head>
    <body>
        <main class='container'>
        <nav class="navigation">
  <!-- tout ce qui va à gauche -->
  <ul class="nav-left">
    <a href="<?=site_url('tvshow/index')?>" title="Accueil">
      <li>
    <i class="fas fa-home"></i>
</li>
    </a>
    <a href="<?=site_url('login/login')?>" title="Se connecter">
      <li>
    <i class="fas fa-user"></i>
</li>
    </a>
    <?php session_start();
      if (isset($_SESSION['username'])): ?>
    <li class="username"><?= htmlspecialchars($_SESSION['username']) ?></li>
    <a href="<?=site_url('login/logout')?>" title="Se déconnecter">
      <li>
    <i><input type="submit" value="Logout"></i>
</li>
    </a>
<?php endif; ?>

    <li>
      <a class="sorting-buttons" href="<?= site_url('Tvshow/sort?sort=name_asc'); ?>" class="btn btn-primary">Tri A→Z</a>
      <a class="sorting-buttons" href="<?= site_url('Tvshow/sort?sort=name_desc'); ?>" class="btn btn-primary">Tri Z→A</a>
      </li>
  </ul>

  <!-- tout ce qui va à droite -->
  <ul class="nav-right">
    <li>
      <form action="<?= site_url('tvshow/filterByGenre'); ?>" method="get">
        <select name="genre_id" aria-label="Genre" onchange="this.form.submit()">
          <option selected disabled value="">Genre</option>
          <?php if (isset($genres)) : foreach ($genres as $g): ?>
            <option value="<?= $g->id ?>"><?= htmlspecialchars($g->name) ?></option>
          <?php endforeach; endif; ?>
        </select>
      </form>
    </li>
    <li>
      <form action="<?= site_url('tvshow/SearchBySerieName'); ?>" method="post">
        <input type="text" name="name" placeholder="show name" required>
          </li>
          <li>
        <input type="submit" value="Search">
          </li>
      </form>
    </li>
  </ul>
</nav>
