<?php
/**
* @var \App\View\AppView $this
*/
use Cake\Core\Configure;
use Cake\Error\Debugger;

//$this->layout = 'error';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.php');

    $this->start('file');
    ?>
    <?php if (!empty($error->queryString)) : ?>
        <p class="notice">
            <strong>SQL Query: </strong>
            <?= h($error->queryString) ?>
        </p>
    <?php endif; ?>
    <?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
    <?php endif; ?>
    <?= $this->element('auto_table_warning') ?>
    <?php

    $this->end();
    ?>

<?php else :
    $this->layout = 'fullpage';
    $cakeDescription = 'Livre des Origines du Rat Domestique';
    ?>
        <div class="row row__oopsie">
            <div class="column-responsive column-50">
                <?= $this->Html->image("oopsie_800x600.jpg", ["alt" => "Jeune rat burmese bleu russe dumbo rex", 'class' => 'oopsie__img']) ?>
            </div>

            <div class="column-responsive">
                <div class="oopsie__text">
                    <h1><?= __('Oh') ?> <span><?= __('noes!') ?></span></h1>

                    <p class="error">
                        <strong><?= __d('cake', 'Error code') ?>: </strong><?= h($code) ?>
                        <?php if ($code == '404') : ?>
                            <p>
                                <?= __d('cake', 'The requested address {0} was not found on this server.', "<strong>'{$url}'</strong>") ?>
                            </p>
                        <?php elseif ($code == '403') : ?>
                            <p>
                                <?= __d('cake', 'You are not allowed to access the page {0}.', "<strong>'{$url}'</strong>") ?>
                            </p>
                        <?php else : ?>
                            <p>
                                <?= __d('cake', 'Some issue occurred while trying to access the page {0}.', "<strong>'{$url}'</strong>") ?>
                            </p>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="btn__center hero__text">
                    <p>
                        <?= $this->Html->link(__('Go Back'), 'javascript:history.back()', ['class' => 'button']) ?>
                        <?= $this->Html->link(__('Get Help'), ['controller' => 'Faqs', 'action' => 'all'], ['class' => 'button']) ?>
                    </p>
                </div>
            </div>
        </div>
    <?php
endif;
?>
