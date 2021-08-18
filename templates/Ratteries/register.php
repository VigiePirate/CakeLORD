<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->element('default_sidebar') ?>
            <?= $this->Html->link(__('List Ratteries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratteries form content">
            <h1><?=__('Register your rattery') ?></h1>
            <?= $this->Flash->render() ?>
            <?= $this->Form->create($rattery,['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Please enter your rattery information below') ?></legend>
                <?php
                    echo $this->Form->control('prefix', ['error' => [ 'The provided value is invalid' => __('This prefix is already in use')]]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('birth_year');
                    echo $this->Form->control('district');
                    echo $this->Form->control('zip_code');
                    echo $this->Form->control('country_id', ['options' => $countries]);
                    echo $this->Form->control('website');
                    echo $this->Form->control('comments');
                    echo $this->Form->control('wants_statistic');
                    echo $this->Form->control('picture_file',['type' => 'file']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
