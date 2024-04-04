<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>

<?php $this->assign('title', __('Litters')) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'Litters', 'action' => 'view', $litter->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                        <span class="tooltiptext"><?= __('Back to litter sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Litters') ?></div>
            </div>

            <h1><?= __('Attach rat to litter: #{0}', [$litter->id]) ?></h1>

            <p><label><?= __('The rat you will select will be attached to the following litter: ')?>
                <?= $this->Html->link(h($litter->full_name), ['controller' => 'Litters', 'action' => 'view', $litter->id]); ?></label>
            </p>

            <?php echo $this->Form->create(); ?>
            <fieldset>
                <?php
                    echo $this->Form->control('rat_name', [
                        'id' => 'jquery-rat-input',
                        'name' => 'rat_name',
                        'label' => __('Rat'),
                        'type' => 'text',
                        'placeholder' => __('Type and select the rat’s name or identifier here...'),
                    ]);
                    echo $this->Form->control('rat_id', [
                        'id' => 'jquery-rat-id',
                        'name' => 'rat_id',
                        'label' => [
                            'class' => 'hide-everywhere',
                            'text' => 'Hidden field for rat ID'
                        ],
                        'class' => 'hide-everywhere',
                        'type' => 'text',
                    ]);

                echo $this->Form->control('update_identifier', [
                    'label' => ['text' => __('Update pedigree identifier?')],
                    'type' => 'checkbox',
                    'default' => false,
                ]);
            ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?= $this->Html->css('jquery.ui.css') ?>
<?= $this->Html->css('ajax.css') ?>
<?= $this->Html->script('jquery.min.js') ?>
<?= $this->Html->script('jquery.ui.min.js') ?>
<?= $this->Html->script('rat.js') ?>
