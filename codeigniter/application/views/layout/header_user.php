<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
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
            <nav>
                <ul>
                    <li><strong>Inscription / Connexion</strong></li>
                    <li><a href="<?=site_url('tvshow/index')?>"><i class="fas fa-home"></i></a></li>
                </ul>
            </nav>
