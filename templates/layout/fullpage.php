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

// if (!Configure::read('debug')) :
//     throw new NotFoundException(
//         'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
//     );
// endif;

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
                            'controller' => 'Lord',
                            'action' => 'search'],
                        'type' => 'post',
                        'method' => 'post',
                        'class' => 'searchbar'],
                    ); ?>
                        <?= $this->Form->control('name', ['type' => 'text','label' => false,'placeholder' => __('Search...')]); ?>
                        <?= $this->Form->submit(); ?>
                    <?= $this->Form->end(); ?>
                    <!-- Login or access dashboard -->
                    <?= ($this->getRequest()->getSession()->check('Auth.id')) ?
                        $this->Html->Link(
                            // $this->getRequest()->getSession()->read('Auth.username'),
                            $this->Html->image("/img/icon-home-open.svg", ["alt" => "Dashboard", "title" => "Dashboard", "width" => "40"]),
                            ['controller' => 'Users', 'action' => 'home'],
                            ['escape' => false])
                        :
                        $this->Html->Link(
                            // $this->getRequest()->getSession()->read('Auth.username'),
                            $this->Html->image("/img/icon-home-closed.svg", ["alt" => __('Dashboard'), "title" => __('Dashboard'), "width" => "40"]),
                            ['controller' => 'Users', 'action' => 'home'],
                            ['escape' => false])
                    ?>
                    <?= ($this->getRequest()->getSession()->check('Auth.id')) ?
                        $this->Html->Link(
                            $this->Html->image("/img/icon-key.svg", ["alt" => __('Log out'), "title" => __('Log out'), "width" => "40"]),
                            ['controller' => 'Users', 'action' => 'logout'],
                            ['escape' => false])
                        :
                        $this->Html->Link(
                            $this->Html->image("/img/icon-key.svg", ["alt" => __('Log in'), "title" => __('Log in'), "width" => "40"]),
                            ['controller' => 'Users', 'action' => 'login'],
                            ['escape' => false])
                    ?>
                </div>
            </nav>
        </div>
    </header>

    <!-- <?= $this->Flash->render() ?> -->
    <?= $this->fetch('content') ?>

    <div class="footer_container">
        <footer>
            <div class="footer_section">
                <h5><?= __('Guides') ?></h5>
                <a href="/faqs/all"><?= __('F.A.Q.') ?></a>
                <a href="/articles/all"><?= __('Full guides') ?></a>
                <a href="/articles/all"><?= __('Code of conduct') ?></a>
                <a href="/articles/all"><?= __('Contributing') ?></a>
                <a href="/articles/all"><?= __('I want a LORD') ?></a>
            </div>
            <div class="footer_section">
                <h5><?= __('About') ?></h5>
                <a href="/articles/all"><?= __('History') ?></a>
                <a href="/articles/all"><?= __('What’s New?') ?></a>
                <a href="/articles/all"><?= __('Staff') ?></a>
                <a href="/articles/all"><?= __('Credits') ?></a>
                <a href="/articles/all"><?= __('Legal Notice') ?></a>
            </div>
            <div class="footer_section">
                <h5><?= __('Statistics') ?></h5>
                <div class="footer_subsection">
                    <a href="/lord/webstats"><?= __('Site statistics') ?></a>
                    <a href="/lord/stats"><?= __('Rat statistics') ?></a>
                </div>
                <h5><a href="/ratteries/locate/"><?= __('Rattery map') ?></a></h5>
                <h5><?= __('Contact') ?></h5>
            </div>
            <div class="footer_center hide-on-tablet">
                <!--<img src="/img/lord.footer.svg" width="105"/>-->
                <img src="/img/lord.shield.clean.svg" width="110"/>
                <div class="shieldline">Livre des Origines<br>du <span>Rat</span> Domestique</div>
                <div class="versionline">Version 2.2 – “Cake”</div>
            </div>
            <div class="footer_section">
                <div class="footer_subsection">
                    <h5><?= __('Links') ?></h5>
                    <a href="/articles/all"><?= __('Websites') ?></a>
                    <a href="/articles/all"><?= __('Forums') ?></a>
                    <a href="/articles/all"><?= __('Associations') ?></a>
                    <a href="/articles/all"><?= __('Social') ?></a>
                    <a href="/articles/all"><?= __('Partners') ?></a>
                </div>
            </div>
            <div class="footer_largersection">
                <div class="logoblock">
                    <!-- <div class="hide-on-tablet"></div><a href="https://cakephp.org/"><img src="/img/logo-cake.svg" width="100"/></a><a href="https://github.com/VigiePirate/CakeLORD"><img src="/img/logo-github.black.svg" width="60"/></a><a href="https://www.srfa.info"><img src="/img/logo-srfa.black.svg" width="80"/></a> -->
                    <div class="hide-on-tablet"></div><a href="https://cakephp.org/"><img src="/img/logo-cake.svg" width="100"/></a><a href="https://github.com/VigiePirate/CakeLORD"><img src="/img/logo-github.svg" width="60"/></a><a href="https://www.srfa.info"><img src="/img/logo-srfa.svg" width="80"/></a>
                </div>
            <div class="creditline">
                © <?= h(date("Y")) ?> – Tous droits réservés<br>
                Textes et images non libres de droits<br>
                Code de l'application distribué sous licence GPL<br>
                Service gratuit hébergé et maintenu par l'association SRFA
            </div>
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
