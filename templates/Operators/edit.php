<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Operator $operator
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'OPerators',
                'object' => $operator,
                'tooltip' => __('Browse operator list'),
                'show_staff' => true
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="operators form content">
            <?= $this->Form->create($operator) ?>
            <fieldset>
                <legend><?= __('Edit Operator') ?></legend>
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
