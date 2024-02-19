<?php
/**
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;
use Cake\Error\Debugger;

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error500.php');

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
<?php if ($error instanceof Error) : ?>
	    <strong>Error in: </strong>
	    <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
<?php endif; ?>
<?php
    echo $this->element('auto_table_warning');

    $this->end();
?>

<?php
else :
    $this->layout = 'fullpage';
    $cakeDescription = 'Livre des Origines du Rat Domestique';
    ?>
    <main class="main">
        <div class="container">
            <div class="row row__oopsie">
                <div class="column-responsive column-50">
                    <?= $this->Html->image("oopsie_800x600.jpg", ["alt" => "Jeune rat burmese bleu russe dumbo rex", 'class' => 'oopsie__img']) ?>
                </div>

                <div class="column-responsive">
                    <div class="oopsie__text">
                        <h1><span><?= __('Oh') ?></span><span><?= __('noes!') ?></span></h1>

                        <p class="error">
                            <strong><?= __d('cake', 'Error code') ?>: </strong><?= h($code) ?>
                            <p>
                                <?= __d('cake', 'An internal error has occurred') ?>
                            </p>
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
        </div>
    </main>
    <?php
endif;
?>
