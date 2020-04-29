<?php
/**
* CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
* @link          https://cakephp.org CakePHP(tm) Project
* @since         0.10.0
* @license       https://opensource.org/licenses/mit-license.php MIT License
* @var \App\View\AppView $this
*/

$cakeDescription = 'CakeLORD';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>


    <link href="https://fonts.googleapis.com/css?family=Alegreya:400,400i,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima:400" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('lord.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
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
                <?= $this->Form->submit('search.icon.clean.svg'); ?>
            <?= $this->Form->end(); ?>
            <!-- Login or access dashboard -->
            <?=
            ($this->getRequest()->getSession()->check('Auth.id')) ?
            $this->Html->Link(
                $this->getRequest()->getSession()->read('Auth.username'),
                [
                    'controller' => 'Users',
                    'action' => 'view',
                    $this->getRequest()->getSession()->read('Auth.id')
                ])
                :
                $this->Html->Link(
                    'Login',
                    [
                        'controller' => 'Users',
                        'action' => 'login'
                    ])
            ?>
        </div>
        </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
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
            <img src="/img/lord.shield.clean.svg" width="120"/>
            <div class="creditline shieldline">Version 2.2 – “Cake”</div>
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
                <div class="hide-on-tablet"></div><a href="https://cakephp.org/"><img src="/img/logo-cake.svg" width="100"/></a><a href="https://github.com/VigiePirate/CakeLORD"><img src="/img/logo-github.svg" width="60"/></a><a href="https://www.srfa.info"><img src="/img/logo-srfa.svg" width="80"/></a>
            </div>
        <div class="creditline">
            © 2020 – Tous droits réservés<br>
            Textes et images non libres de droits<br>
            Code de l'application distribué sous licence GPL<br>
            Service gratuit hébergé et maintenu par l'association SRFA
        </div>
    </div>
</footer>
</body>
</html>
