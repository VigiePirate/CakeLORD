<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issue $issue
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $issue->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $issue->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Issues'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="issues form content">
            <?= $this->Form->create($issue) ?>
            <fieldset>
                <legend><?= __('Edit Issue') ?></legend>
                <?php
                    echo $this->Form->control('is_open');
                    echo $this->Form->control('url');
                    echo $this->Form->control('complaint');
                    echo $this->Form->control('handling');
                    echo $this->Form->control('closed', ['empty' => true]);
                    echo $this->Form->control('from_user_id');
                    echo $this->Form->control('closing_user_id', ['options' => $users, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
