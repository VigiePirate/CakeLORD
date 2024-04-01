<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => $Varieties,
                'object' => $variety,
                'tooltip' => $tooltip,
                'show_staff' => false
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="coats form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Varieties') ?></div>
            </div>
            <h1><?= __('Add a new ') . __($Variety) ?></h1>
            <?= $this->Form->create($variety, ['type' => 'file']) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('genotype');
                    echo $this->Form->control('picture_file', ['type' => 'file', 'label' => __('Reference picture')]);
                    echo $this->Form->control('description', [
                        'type'=> 'textarea',
                        'id' => 'description',
                        'name' => 'description',
                        'default' => '.'
                    ]);
                    echo $this->Form->control('is_picture_mandatory', ['label' => __('Require picture from user?')]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- Easy MDE -->
<?= $this->Html->css('easymde.css') ?>
<?= $this->Html->script('easymde.min.js') ?>
<?= $this->Html->script('easymde-staff.js') ?>
