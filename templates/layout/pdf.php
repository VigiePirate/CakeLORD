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

$cakeDescription = 'LORD';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?> -
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css2?family=Imprima&family=Alegreya:ital,wght@0,300;0,400;0,500;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('pdf.css') ?>

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
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="/">Livre des Origines <br>du <span>Rat</span> Domestique</td></a>
            <a href="/"><img alt="LORD Logo: Book with a Rat Tail" title="Landing page" src="/img/lord.footer.svg" /></a>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <!--     <footer>
    <div class="footer_section">

        </div>
        <div class="footer_section">

        </div>
        <div class="footer_section">

        </div>
        <div class="footer_center hide-on-tablet">
            <img src="/img/lord.shield.clean.svg" width="110"/>
            <div class="shieldline">Livre des Origines<br>du <span>Rat</span> Domestique</div>
            <div class="versionline">Version 2.2 – “Cake”</div>
        </div>
        <div class="footer_section">

        </div>
        <div class="footer_largersection">
            <div class="logoblock">
                <div class="hide-on-tablet"></div><a href="https://cakephp.org/"><img src="/img/logo-cake.svg" width="100"/></a><a href="https://github.com/VigiePirate/CakeLORD"><img src="/img/logo-github.svg" width="60"/></a><a href="https://www.srfa.info"><img src="/img/logo-srfa.svg" width="80"/></a>
            </div>
        <div class="creditline">
            © <?= h(date("Y")) ?> – Tous droits réservés<br>
            Textes et images non libres de droits<br>
            Code de l'application distribué sous licence GPL<br>
            Service gratuit hébergé et maintenu par l'association SRFA
        </div>
    </div>
</footer>  -->
</body>
</html>
