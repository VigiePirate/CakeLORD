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

//$this->disableAutoLayout();
$this->layout = 'fullpage';

// if (!Configure::read('debug')) :
//     throw new NotFoundException(
//         'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
//     );
// endif;

$cakeDescription = 'Livre des Origines du Rat Domestique';
?>

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
                    <h3>Fiches individuelles</h3>
                    <ul>
                        <li>Identifiant unique</li>
                        <li>Pedigree imprimable</li>
                        <li>Traçabilité des origines</li>
                    </ul>
                </div>
                <div class="column-30">
                    <?= $this->Html->image("icon-genealogy.png", ["alt" => "Arbre généalogique"]) ?>
                    <h3>Suivi des familles</h3>
                    <ul>
                        <li>Fiches portées</li>
                        <li>Arbres généalogiques</li>
                        <li>Outils pour les rateries</li>
                    </ul>
                </div>
                <div class="column-30">
                    <?= $this->Html->image("icon-health.png", ["alt" => "Graphique santé"]) ?>
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
