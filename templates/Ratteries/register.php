<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
        </div>
        <div class="side-nav-group">
            <div class="tooltip">
                <?= $this->Html->image('/img/icon-back.svg', [
                    'url' => ['controller' => 'users', 'action' => 'my'],
                    'class' => 'side-nav-icon',
                    'alt' => __('Back')]) ?>
                <span class="tooltiptext"><?= __('Cancel and go back to dashboard') ?></span>
            </div>
        </diV>
    </aside>
    <div class="column-responsive column-90">
        <div class="ratteries form content">
            <h1><?=__('Register your rattery') ?></h1>
            <?= $this->Flash->render() ?>
            <?= $this->Form->create($rattery, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Please enter your rattery information below') ?></legend>
                <?php
                    echo $this->Form->control('prefix', ['error' => ['The provided value is invalid' => __('This prefix is already in use')]]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('birth_year');
                    echo $this->Form->control('district');
                    echo $this->Form->control('zip_code');
                    echo $this->Form->control('country_id', ['options' => $countries]);
                    echo $this->Form->control('website');
                    echo $this->Form->control('comments');
                    echo $this->Form->control('wants_statistic');
                    echo $this->Form->control('picture_file', ['type' => 'file']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
