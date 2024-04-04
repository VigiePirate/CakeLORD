<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>

<?php $this->assign('title', __('Simulate a litter')) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar', ['help_url' => ['controller' => 'Categories', 'action' => 'view', 34]]) ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="litters form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Litters') ?></div>
            </div>
            <h1><?=__('Simulate a litter') ?></h1>

            <?= $this->Flash->render() ?>

            <div class="message default" onclick="this.classList.add('hidden')">
                <?= __('Litter simulation can take several minutes and drain your battery. We do not recommend the use of this feature on smartphones.') ?>
            </div>

            <?= $this->Form->setValueSources(['context', 'data'])->create($litter) ?>

            <fieldset>
                <legend><?= __('Enter potential parents') ?></legend>
                <div class="row">
                    <div class="column-responsive column-50">
                        <?php
                            echo $this->Form->control('mother_name', [
                                'id' => 'jquery-mother-input',
                                'name' => 'mother_name',
                                'label' => __('Mother'),
                                'type' => 'text',
                                'required' => 'required',
                                'placeholder' => __('Type and select the mother’s name or identifier here...'),
                            ]);
                            echo $this->Form->control('mother_id', [
                                'id' => 'jquery-mother-id',
                                'name' => 'mother_id',
                                'label' => [
                                    'class' => 'hide-everywhere',
                                    'text' => 'Hidden field for mother ID'
                                ],
                                'class' => 'hide-everywhere',
                                'type' => 'text',
                            ]);
                        ?>
                    </div>
                    <div class="column-responsive column-50">
                        <?php
                            echo $this->Form->control('father_name', [
                                'id' => 'jquery-father-input',
                                'name' => 'father_name',
                                'label' => __('Father'),
                                'type' => 'text',
                                'required' => 'required',
                                'placeholder' => __('Type and select the father’s name or identifier here...'),
                            ]);
                            echo $this->Form->control('father_id', [
                                'id' => 'jquery-father-id',
                                'name' => 'father_id',
                                'label' => [
                                    'class' => 'hide-everywhere',
                                    'text' => 'Hidden field for mother ID'
                                ],
                                'class' => 'hide-everywhere',
                                'type' => 'text',
                            ]);
                        ?>
                    </div>
                </div>

            </fieldset>

            <?= $this->Form->button(__('Launch simulation')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?= $this->Html->css('jquery.ui.css') ?>
<?= $this->Html->css('ajax.css') ?>
<?= $this->Html->script('jquery.min.js') ?>
<?= $this->Html->script('jquery.ui.min.js') ?>
<?= $this->Html->script('litter.js') ?>
