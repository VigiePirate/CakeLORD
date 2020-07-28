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

$cakeDescription = 'CakeLORD: Just Taste it';
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

    <link href="https://fonts.googleapis.com/css?family=Railway:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Imprima:400" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('home.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="48x48" href="/img/favicon-48x48.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <link rel="mask-icon" href="/img/safari-pinned-tab.svg" color="#663300">
    <meta name="msapplication-TileColor" content="#663300">
    <meta name="theme-color" content="#663300">
    <link rel="manifest" href="/manifest.webmanifest">
</head>
<body>
    <header>
        <div class="container text-center">
            <a href="https://cakephp.org/" target="_blank">
                <img alt="CakeLORD" src="/img/lord-logo.png" width="350" />
            </a>
            <h1>
                Welcome to CakeLORD, running on <?php echo Configure::version() ?> Strawberry
            </h1>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="column">
                        <h4>Go to...</h4>
                        <p><?= $this->Html->link('Login and go to dashboard', '/users/home') ?></p>
                        <p><?= $this->Html->link('Users', '/users') ?></p>
                        <p><?= $this->Html->link('Ratteries', '/ratteries') ?></p>
                        <p><?= $this->Html->link('Rats', '/rats') ?></p>
                        <p><?= $this->Html->link('Litters', '/litters') ?></p>
                        <p><?= $this->Html->link('Colors', '/colors') ?> (all physical traits: markings, coats, etc. work the same)</p>
                        <p><?= $this->Html->link('Pending staff action', '/states/view/3') ?> (all objects needing staff action; change number to see sheets in other states, but avoid n°2, there are a lot of them)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="column">
                        <h4>Available finders (copy and edit end of url to customize your search)</h4>
                        <p>Rats:
                            <ul>
                                <li>• By name or pup name: <?= $this->Html->link('https://artefact.kubrick.srfa.info/rats/named/super', '/rats/named/super') ?></li>
                                <li>• By owner username: <?= $this->Html->link('https://artefact.kubrick.srfa.info/rats/owned-by/arte', '/rats/owned-by/arte') ?></li>
                                <li>• By rattery name or prefix: <?= $this->Html->link('https://artefact.kubrick.srfa.info/rats/from-rattery/del', '/rats/from-rattery/del') ?></li>
                                <li>• Born before some date: <?= $this->Html->link('https://artefact.kubrick.srfa.info/rats/born-before/2000-01-01', '/rats/born-before/2000-01-01') ?></li>
                                <li>• Born after some date: <?= $this->Html->link('https://artefact.kubrick.srfa.info/rats/born-after/2020-01-01', '/rats/born-after/2020-01-01') ?></li>
                            </ul>
                        </p>
                        <p>Ratteries:
                            <ul>
                                <li>• By name or prefix: <?= $this->Html->link('https://artefact.kubrick.srfa.info/ratteries/named/aa', '/ratteries/named/aa') ?></li>
                                <li>• By owner username: <?= $this->Html->link('https://artefact.kubrick.srfa.info/ratteries/owned-by/ee', '/ratteries/owned-by/ee') ?></li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="column">
                        <h4>Some other available functions</h4>
                        <p> Attention, en mode debug les fonctions notées avec une * n'envoient pas "vraiment" les mails, ce qui fait pour l'instant bugguer ces fonctions (mais elles marchent quand on fait vraiment envoyer un mail.) </p>
                        <p> Pour accéder aux liens générés et tester la fonction jusqu'au bout, depuis la page d'erreur il faut appuyer sur le gateau en bas à droite, puis sur l'onglet "mail" pour voir le mail qui serait envoyé en environnement de production, copier le lien et l'ouvrir dans une autre page.</p>
                        <p><ul>
                            <li>• <?= $this->Html->link('*Register', '/users/register') ?></li>
                            <li>• <?= $this->Html->link('*Reset Password', '/users/lost-password') ?></li>
                            <li>• <?= $this->Html->link('Register Rattery', '/ratteries/register') ?></li>
                        </ul></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="column">
                        <div class="message default text-center">
                            <small>Please be aware that this page will not be shown if you turn off debug mode unless you replace templates/Pages/home.php with your own version.</small>
                        </div>
                        <!-- <div id="url-rewriting-warning" class="alert url-rewriting">
                            <ul>
                                <li class="bullet problem">
                                    URL rewriting is not properly configured on your server.<br />
                                    1) <a target="_blank" href="https://book.cakephp.org/4/en/installation.html#url-rewriting">Help me configure it</a><br />
                                    2) <a target="_blank" href="https://book.cakephp.org/4/en/development/configuration.html#general-configuration">I don't / can't use URL rewriting</a>
                                </li>
                            </ul>
                        </div> -->
                        <?php Debugger::checkSecurityKeys(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <h4>Environment</h4>
                        <ul>
                        <?php if (version_compare(PHP_VERSION, '7.2.0', '>=')) : ?>
                            <li class="bullet success">Your version of PHP is 7.2.0 or higher (detected <?php echo PHP_VERSION ?>).</li>
                        <?php else : ?>
                            <li class="bullet problem">Your version of PHP is too low. You need PHP 7.2.0 or higher to use CakePHP (detected <?php echo PHP_VERSION ?>).</li>
                        <?php endif; ?>

                        <?php if (extension_loaded('mbstring')) : ?>
                            <li class="bullet success">Your version of PHP has the mbstring extension loaded.</li>
                        <?php else : ?>
                            <li class="bullet problem">Your version of PHP does NOT have the mbstring extension loaded.</li>
                        <?php endif; ?>

                        <?php if (extension_loaded('openssl')) : ?>
                            <li class="bullet success">Your version of PHP has the openssl extension loaded.</li>
                        <?php elseif (extension_loaded('mcrypt')) : ?>
                            <li class="bullet success">Your version of PHP has the mcrypt extension loaded.</li>
                        <?php else : ?>
                            <li class="bullet problem">Your version of PHP does NOT have the openssl or mcrypt extension loaded.</li>
                        <?php endif; ?>

                        <?php if (extension_loaded('intl')) : ?>
                            <li class="bullet success">Your version of PHP has the intl extension loaded.</li>
                        <?php else : ?>
                            <li class="bullet problem">Your version of PHP does NOT have the intl extension loaded.</li>
                        <?php endif; ?>
                        </ul>
                    </div>
                    <div class="column">
                        <h4>Filesystem</h4>
                        <ul>
                        <?php if (is_writable(TMP)) : ?>
                            <li class="bullet success">Your tmp directory is writable.</li>
                        <?php else : ?>
                            <li class="bullet problem">Your tmp directory is NOT writable.</li>
                        <?php endif; ?>

                        <?php if (is_writable(LOGS)) : ?>
                            <li class="bullet success">Your logs directory is writable.</li>
                        <?php else : ?>
                            <li class="bullet problem">Your logs directory is NOT writable.</li>
                        <?php endif; ?>

                        <?php $settings = Cache::getConfig('_cake_core_'); ?>
                        <?php if (!empty($settings)) : ?>
                            <li class="bullet success">The <em><?php echo $settings['className'] ?>Engine</em> is being used for core caching. To change the config edit config/app.php</li>
                        <?php else : ?>
                            <li class="bullet problem">Your cache is NOT working. Please check the settings in config/app.php</li>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column">
                        <h4>Database</h4>
                        <?php
                        try {
                            $connection = ConnectionManager::get('default');
                            $connected = $connection->connect();
                        } catch (Exception $connectionError) {
                            $connected = false;
                            $errorMsg = $connectionError->getMessage();
                            if (method_exists($connectionError, 'getAttributes')) :
                                $attributes = $connectionError->getAttributes();
                                if (isset($errorMsg['message'])) :
                                    $errorMsg .= '<br />' . $attributes['message'];
                                endif;
                            endif;
                        }
                        ?>
                        <ul>
                        <?php if ($connected) : ?>
                            <li class="bullet success">CakePHP is able to connect to the database.</li>
                        <?php else : ?>
                            <li class="bullet problem">CakePHP is NOT able to connect to the database.<br /><?php echo $errorMsg ?></li>
                        <?php endif; ?>
                        </ul>
                    </div>
                    <div class="column">
                        <h4>DebugKit</h4>
                        <ul>
                        <?php if (Plugin::isLoaded('DebugKit')) : ?>
                            <li class="bullet success">DebugKit is loaded.</li>
                        <?php else : ?>
                            <li class="bullet problem">DebugKit is NOT loaded. You need to either install pdo_sqlite, or define the "debug_kit" connection name.</li>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column links">
                        <h3>Getting Started</h3>
                        <a target="_blank" href="https://book.cakephp.org/4/en/">CakePHP Documentation</a>
                        <a target="_blank" href="https://book.cakephp.org/4/en/tutorials-and-examples/cms/installation.html">The 20 min CMS Tutorial</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column links">
                        <h3>Help and Bug Reports</h3>
                        <a target="_blank" href="irc://irc.freenode.net/cakephp">irc.freenode.net #cakephp</a>
                        <a target="_blank" href="http://cakesf.herokuapp.com/">Slack</a>
                        <a target="_blank" href="https://github.com/cakephp/cakephp/issues">CakePHP Issues</a>
                        <a target="_blank" href="http://discourse.cakephp.org/">CakePHP Forum</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column links">
                        <h3>Docs and Downloads</h3>
                        <a target="_blank" href="https://api.cakephp.org/">CakePHP API</a>
                        <a target="_blank" href="https://bakery.cakephp.org">The Bakery</a>
                        <a target="_blank" href="https://book.cakephp.org/4/en/">CakePHP Documentation</a>
                        <a target="_blank" href="https://plugins.cakephp.org">CakePHP plugins repo</a>
                        <a target="_blank" href="https://github.com/cakephp/">CakePHP Code</a>
                        <a target="_blank" href="https://github.com/FriendsOfCake/awesome-cakephp">CakePHP Awesome List</a>
                        <a target="_blank" href="https://www.cakephp.org">CakePHP</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column links">
                        <h3>Training and Certification</h3>
                        <a target="_blank" href="https://cakefoundation.org/">Cake Software Foundation</a>
                        <a target="_blank" href="https://training.cakephp.org/">CakePHP Training</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
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