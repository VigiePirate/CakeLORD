<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => $Varieties,
                'object' => $variety,
                'tooltip' => $tooltip,
                'can_cancel' => true,
                'show_staff' => $show_staff
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= $Varieties ?></div>
            </div>
            <h1><?= __('Edit') . ' ' . $Variety ?></h1>
            <?= $this->Form->create($variety) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('picture');
                    echo $this->Form->control('genotype');
                    echo $this->Form->control('description', [
                        'type'=> 'textarea',
                        'id' => 'description',
                        'name' => 'description',
                        'default' => ' '
                    ]);
                    echo $this->Form->control('is_picture_mandatory', ['label' => __('Mandatory picture?')]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
