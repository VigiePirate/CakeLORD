<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

$cakeDescription = 'Livre des Origines du Rat Domestique';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Alegreya:400,400i,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima:400" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('homepage.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="144x144" href="/img/lord.icon.144x144.png">
    <link rel="icon" type="image/png" sizes="48x48" href="/img/favicon-48x48.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <link rel="mask-icon" href="/img/safari-pinned-tab.svg" color="#663300">
    <meta name="msapplication-TileColor" content="#663300">
    <meta name="theme-color" content="#663300">
    <link rel="manifest" href="/manifest.webmanifest" crossorigin="use-credentials">
</head>
<body>
    <header>
        <div class="nav-container">
            <nav class="top-nav">
                <div class="top-nav-title">
                    <a href="/"><img alt="LORD Logo: Book with a Rat Tail" src="/img/lord.icon.contour.svg" /></a>
                    <a href="/" class="hide-on-mobile">Livre des Origines <br>du <span>Rat</span> Domestique</td></a>
                </div>
                <div class="top-nav-links">
                    <!-- Search form -->
                    <?= $this->Form->create(
                        null,
                        ['url' => [
                            'controller' => 'Rats',
                            'action' => 'named'],
                        'type' => 'post',
                        'method' => 'post',
                        'class' => 'searchbar'],
                    ); ?>
                        <?= $this->Form->control('name', ['type' => 'text','label' => false,'placeholder' => 'Search...']); ?>
                        <?= $this->Form->submit(); ?>
                    <?= $this->Form->end(); ?>
                    <!-- Login or access dashboard -->
                    <?=
                    ($this->getRequest()->getSession()->check('Auth.id')) ?
                        $this->Html->Link(
                        // $this->getRequest()->getSession()->read('Auth.username'),
                            $this->Html->image("/img/icon-user.svg", ["alt" => "Dashboard", "width" => "40"]),
                            ['controller' => 'Users', 'action' => 'home'],
                            ['escape' => false]) .
                        $this->Html->Link(
                            $this->Html->image("/img/icon-logout.svg", ["alt" => "Logout", "width" => "40"]),
                            ['controller' => 'Users', 'action' => 'logout'],
                            ['escape' => false])
                        :
                        $this->Html->Link(
                            $this->Html->image("/img/icon-login.svg", ["alt" => "Login", "width" => "40"]),
                            ['controller' => 'Users', 'action' => 'login'],
                            ['escape' => false])
                    ?>
                </div>
            </nav>
        </div>
    </header>
    <main class="main">
        <section class="hero">
            <div class="container">
                <div class="row row__hero">
                    <div class="column-responsive column-40">
                        <div class="hero__text">
                            <h1><?= $this->Html->image("catchphrase_path.svg", ["alt" => "Pour mieux les faire grandir, nous conservons leurs racines"]) ?></h1>
                         </div>
                         <div class="btn__center hero__text">
                           <?= $this->Html->link(__('Sign up'), ['controller' => 'Users', 'action' => 'register'], ['class' => 'button']) ?>
                           <?= $this->Html->link(__('Sign in'), ['controller' => 'Users', 'action' => 'login'], ['class' => 'button']) ?>
                         </div>
                    </div>
                    <div class="column-responsive column-60 col__img">
                        <?= $this->Html->image("hero_800x600.jpg", ["alt" => "Jeune rat burmese dumbo rex"]) ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="value">
            <div class="container">
                <div class="row row__hero">
                    <div class="column-30">
                        <?= $this->Html->image("icon-idcard.svg", ["alt" => "Carte d'identité"]) ?>
                        <h3>Fiches individuelles</h3>
                        <ul>
                            <li>Indentifiant unique</li>
                            <li>Pedigree imprimable</li>
                            <li>Traçabilité des origines</li>
                        </ul>
                    </div>
                    <div class="column-30">
                        <?= $this->Html->image("icon-genealogy.svg", ["alt" => "Arbre généalogique"]) ?>
                        <h3>Suivi des familles</h3>
                        <ul>
                            <li>Fiches portées</li>
                            <li>Arbres généalogiques</li>
                            <li>Outils pour les rateries</li>
                        </ul>
                    </div>
                    <div class="column-30">
                        <?= $this->Html->image("icon-healthstats.svg", ["alt" => "Graphique santé"]) ?>
                        <h3>Suivi de la population</h3>
                        <ul>
                            <li>Veille sanitaire</li>
                            <li>Statistiques démographiques</li>
                            <li>Statistiques épidémiologiques</li>
                        </ul>
                    </div>
            </div>
        </section>
        <section class="parallax">
            <div class="container">
                <div class="row row__parallax text-center">
                    <div class="column">
                        <div class="content postit">
                            <h2>Gratuit et ouvert à tous</h2>
                        </div>
                        <div class="content postit">
                            <p><strong>Quelle que soit leur origine</strong> : animalerie, particulier, raterie, labo, sauvetage... tous les rats peuvent être inscrits. Éleveur ou simple propriétaire, vous pouvez les enregistrer <strong>gratuitement</strong>.</p>
                        </div>
                        <div class="content postit">
                            <p>Toutes les informations, tous vos souvenirs sont conservés <strong>sans limite de durée</strong> et restent accessibles <strong>partout, tout le temps</strong>.</p>
                        </div>
                    </div>
                    <div class="column">
                        <div class="content postit">
                            <h2>Dans l'intérêt de l'espèce</h2>
                        </div>
                        <div class="content postit">
                            <p>Les informations collectées facilitent le suivi de la <strong>santé</strong> et de la <strong>mortalité</strong> des rats, et alimentent la production de <strong>statistiques</strong> automatiques.</p>
                        </div>
                        <div class="content postit">
                            <p>La centralisation des informations aide les <strong>élevages</strong> dans leurs programmes de <strong>reproduction</strong> et de <strong>sélection</strong> ; la conservation des ascendances permet de <strong>maîtriser la consanguinité</strong> du cheptel.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="footer_container">
        <footer>
            <div class="footer_section">
                <h5>Guides</h5>
                <a href="/articles">F.A.Q.</a>
                <a href="/articles">Full guides</a>
                <a href="/articles">Code of conduct</a>
                <a href="/articles">Contributing</a>
                <a href="/articles">I want a LORD</a>
            </div>
            <div class="footer_section">
                <h5>About</h5>
                <a href="/articles">History</a>
                <a href="/articles">What's New?</a>
                <a href="/articles">Staff</a>
                <a href="/articles">Credits</a>
                <a href="/articles">Legal Notice</a>
            </div>
            <div class="footer_section">
                <h5>Statistics</h5>
                <div class="footer_subsection">
                <a href="/articles">Site statistics</a>
                <a href="/articles">Rat statistics</a>
            </div>
                <h5>Rattery map</h5>
                <h5>Contact</h5>
            </div>
            <div class="footer_center hide-on-tablet">
                <!--<img src="/img/lord.footer.svg" width="105"/>-->
                <img src="/img/lord.shield.clean.svg" width="110"/>
                <div class="shieldline">Livre des Origines<br>du <span>Rat</span> Domestique</div> <!-- LORD v2.2 – “Cake” -->
                <div class="versionline">Version 2.2 – “Cake”</div>
            </div>
            <div class="footer_section">
                <div class="footer_subsection">
                    <h5>Links</h5>
                    <a href="/articles">Websites</a>
                    <a href="/articles">Forums</a>
                    <a href="/articles">Associations</a>
                    <a href="/articles">Social</a>
                    <a href="/articles">Partners</a>
                </div>
            </div>
            <div class="footer_largersection">
                <div class="logoblock">
                    <!-- <div class="hide-on-tablet"></div><a href="https://cakephp.org/"><img src="/img/logo-cake.svg" width="100"/></a><a href="https://github.com/VigiePirate/CakeLORD"><img src="/img/logo-github.black.svg" width="60"/></a><a href="https://www.srfa.info"><img src="/img/logo-srfa.black.svg" width="80"/></a> -->
                    <div class="hide-on-tablet"></div><a href="https://cakephp.org/"><img src="/img/logo-cake.svg" width="100"/></a><a href="https://github.com/VigiePirate/CakeLORD"><img src="/img/logo-github.svg" width="60"/></a><a href="https://www.srfa.info"><img src="/img/logo-srfa.svg" width="80"/></a>
                </div>
            <div class="creditline">
                © 2020 – Tous droits réservés<br>
                Textes et images non libres de droits<br>
                Code de l'application distribué sous licence GPL<br>
                Service gratuit hébergé et maintenu par l'association SRFA
            </div>
        </footer>
    </div>
</body>
<script>
  if ('serviceWorker' in navigator) {
    console.log("Will the service worker register?");
    navigator.serviceWorker.register('service-worker.js')
      .then(function(reg){
        console.log("Yes, it did.");
      }).catch(function(err) {
        console.log("No it didn't. This happened: ", err)
      });
  }
</script>
</html>
