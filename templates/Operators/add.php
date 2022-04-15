<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Operator $operator
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'Operators',
                'object' => $operator,
                'tooltip' => __('Browse operator list'),
                'show_staff' => false
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="operators form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Compatibility operators') ?></div>
            </div>
            <h1><?= __('Add Operator') ?></h1>
            <?= $this->Form->create($operator) ?>
            <fieldset>

                <?php
                    echo $this->Form->control('symbol');
                    echo $this->Form->control('meaning');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
