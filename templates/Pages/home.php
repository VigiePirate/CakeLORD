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

$this->layout = 'fullpage';

$cakeDescription = 'Livre des Origines du Rat Domestique';
?>

<main class="main">
    <section class="hero">
        <div class="container">
            <div class="row row__hero">
                <div class="column-responsive column-40">
                    <div class="hero__left">
                        <div class="hero__text">
                            <?= __('<h1>To better foster <br/> <span>their</span> <span>growth</span> <br/><br/>
                                    We keep track of <br/> <span>their</span> <span>roots</span></h1>') ?>
                        </div>
                        <div class="btn__center hero__btn">
                            <?= $this->Html->link(__('Sign up'), ['controller' => 'Users', 'action' => 'register'], ['class' => 'button']) ?>
                            <?= $this->Html->link(__('Sign in'), ['controller' => 'Users', 'action' => 'login'], ['class' => 'button']) ?>
                        </div>
                    </div>
                </div>
                <div class="column-responsive column-60">
                    <?= $this->Html->image("hero_800x600.jpg", ["alt" => "Jeune rat burmese dumbo rex"]) ?>
                </div>
            </div>
        </div>
    </section>
    <section class="value">
        <div class="container">
            <div class="row row__hero">
                <div class="column-30">
                    <?= $this->Html->image("icon-idcard.png", ["alt" => "Carte d'identité"]) ?>
                    <h3><?= __('Individual records') ?></h3>
                    <ul>
                        <li><?= __('Unique identifier') ?></li>
                        <li><?= __('Printable pedigrees') ?></li>
                        <li><?= __('Origin traceability') ?></li>
                    </ul>
                </div>
                <div class="column-30">
                    <?= $this->Html->image("icon-genealogy.png", ["alt" => "Arbre généalogique"]) ?>
                    <h3><?= __('Bloodline follow-up') ?></h3>
                    <ul>
                        <li><?= __('Litter records') ?></li>
                        <li><?= __('Family trees') ?></li>
                        <li><?= __('Tools for breeders') ?></li>
                    </ul>
                </div>
                <div class="column-30">
                    <?= $this->Html->image("icon-health.png", ["alt" => "Graphique santé"]) ?>
                    <h3><?= __('Population monitoring') ?></h3>
                    <ul>
                        <li><?= __('Health surveillance') ?></li>
                        <li><?= __('Demographic statistics') ?></li>
                        <li><?= __('Epidemiological statistics') ?></li>
                    </ul>
                </div>
        </div>
    </section>
    <section class="parallax">
        <div class="container">
            <div class="row row__parallax text-center">
                <div class="column">
                    <div class="content postit">
                        <h2><?= __('Free and open for everyone') ?></h2>
                    </div>
                    <div class="content postit">
                        <p><?= __('<strong>Regardless of their origin:</strong> pet store, private owner, rattery, lab, rescue... all rats can be registered. Whether you are a breeder or a pet owner, you can register them <strong>for free</strong>.') ?></p>
                    </div>
                    <div class="content postit">
                        <p><?= __('All your data, all your memories are stored <strong>without any time limit</strong> and remain accessible <strong>anywhere, anytime</strong>.') ?></p>
                    </div>
                </div>
                <div class="column">
                    <div class="content postit">
                        <h2><?= __('For the sake of the species') ?></h2>
                    </div>
                    <div class="content postit">
                        <p><?= __('The collected information helps monitoring rat <strong>health</strong> and <strong>mortality</strong>, and contributes to generating automatic <strong>statistics</strong>.') ?></p>
                    </div>
                    <div class="content postit">
                        <p><?= __('Centralizing information assists <strong>studs</strong> in their <strong>breeding</strong> and <strong>selection</strong> programmes; preserving ancestry aids in <strong>controlling the inbreeding</strong> within the herd.') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
