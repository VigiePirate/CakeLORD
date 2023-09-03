<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>

<?php $this->assign('title', h($litter->full_name)) ?>

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
                        'alt' => __('Full Screen')]) ?>
                        <span class="tooltiptext"><?= __('Back to litter sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Manage Litter Contributions of') ?></div>
                <div class="sheet-markers">
                    <div class="tooltip-state">
                        <div class="current-statemark statecolor_<?php echo h($litter->state_id) ?>"><?= h($litter->state->symbol) ?></div>
                        <span class="tooltiptext-state hide-on-mobile"><?= h($litter->state->name) ?></span>
                    </div>
                </div>
            </div>

            <h1><?= h($litter->full_name) ?></h1>

            <?= $this->Flash->render() ?>

            <?php echo $this->Form->setValueSources(['context', 'data'])->create($litter); ?>
            <fieldset>
                <?php foreach($contribution_types as $type) : ?>
                    <?php if($type->id == '1') : ?>
                        <?php if ($user->can('staffEdit', $litter)) : ?>
                            <h2 class="staff"><?= __('Staff-only') ?></h2>
                            <?php
                                echo $this->Form->control('rattery_name_contribution_' . $type->id, [
                                    'id' => 'jquery-rattery-input-' . $type->id,
                                    'name' => 'rattery_name_contribution_' . $type->id,
                                    'label' => $type->name,
                                    'type' => 'text',
                                    'required' => 'true',
                                    'default' => ! empty($previous[$type->id]) ? $previous[$type->id]['name'] : __('Type and select the rattery’s name or prefix here...')
                                ]);

                                echo $this->Form->control('rattery_id_contribution_' . $type->id, [
                                    'id' => 'jquery-rattery-id-' . $type->id,
                                    'name' => 'rattery_id_contribution_' . $type->id,
                                    'label' => [
                                        'class' => 'hide-everywhere',
                                        'text' => 'Hidden field for rattery ID'
                                    ],
                                    'class' => 'hide-everywhere',
                                    'type' => 'text',
                                    'default' => ! empty($previous[$type->id]) ? $previous[$type->id]['id'] : null
                                ]);
                            ?>
                            <?= $this->element('side_message_control', ['sheet' => $litter]) ?>
                            <div class="spacer"></div>
                            <h2><?= __('Other contributions') ?></h2>
                        <?php else: ?>
                            <?php
                                echo $this->Form->control('rattery_name_contribution_' . $type->id, [
                                    'id' => 'jquery-rattery-input-' . $type->id,
                                    'name' => 'rattery_name_contribution_' . $type->id,
                                    'label' => $type->name,
                                    'type' => 'text',
                                    'value' => $previous[$type->id]['name'],
                                    'required' => 'true',
                                    'readonly' => true,
                                ]);

                                echo $this->Form->control('rattery_id_contribution_' . $type->id, [
                                    'id' => 'jquery-rattery-id-' . $type->id,
                                    'name' => 'rattery_id_contribution_' . $type->id,
                                    'label' => [
                                        'class' => 'hide-everywhere',
                                        'text' => 'Hidden field for rattery ID'
                                    ],
                                    'class' => 'hide-everywhere',
                                    'type' => 'text',
                                    'default' => $previous[$type->id]['id']
                                ]);
                            ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach ; ?>

                <?php foreach($contribution_types as $type) : ?>
                    <?php if ($type->id != '1') {
                        echo $this->Form->control('rattery_name_contribution_' . $type->id, [
                            'id' => 'jquery-rattery-input-' . $type->id,
                            'name' => 'rattery_name_contribution_' . $type->id,
                            'label' => $type->name,
                            'type' => 'text',
                            'class' => 'placeholder',
                            'default' => ! empty($previous[$type->id]) ? $previous[$type->id]['name'] : __('Type and select the rattery’s name or prefix here...'),
                            'placeholder' => __('Type and select the rattery’s name or prefix here...')
                        ]);

                        echo $this->Form->control('rattery_id_contribution_' . $type->id, [
                            'id' => 'jquery-rattery-id-' . $type->id,
                            'name' => 'rattery_id_contribution_' . $type->id,
                            'label' => [
                                'class' => 'hide-everywhere',
                                'text' => 'Hidden field for rattery ID'
                            ],
                            'class' => 'hide-everywhere',
                            'type' => 'text',
                            'default' => ! empty($previous[$type->id]) ? $previous[$type->id]['id'] : null
                        ]);
                    }
                    ?>
                <?php endforeach ; ?>

                <!-- also pass litter id to marshal contributions with replace strategy -->
                <?php
                    echo $this->Form->control('litter_id', [
                            'type' => 'hidden',
                            'value' => $litter->id,
                        ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Update Contributions')); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>

<?php $this->append('css');?>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
<?php $this->end();?>
<?= $this->Html->css('statebar.css') ?>
<?= $this->Html->css('ajax.css') ?>

<?php $this->append('script');?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <?= $this->Html->script('forms') ?>
    <script>
        $(function () {
            var types = <?= json_encode($contribution_types->all()->extract('id')->toList()); ?>;
            for (var i = 0; i < types.length; i++) {
                autocompleteRattery("#jquery-rattery-input-"+types[i], "#jquery-rattery-id-"+types[i]);
            }
        });
    </script>
<?php $this->end(); ?>
