<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatsSingularity $ratsSingularity
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Rats Singularity'), ['action' => 'edit', $ratsSingularity->rats_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rats Singularity'), ['action' => 'delete', $ratsSingularity->rats_id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratsSingularity->rats_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Rats Singularities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rats Singularity'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ratsSingularities view content">
            <h3><?= h($ratsSingularity->rats_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rat') ?></th>
                    <td><?= $ratsSingularity->has('rat') ? $this->Html->link($ratsSingularity->rat->id, ['controller' => 'Rats', 'action' => 'view', $ratsSingularity->rat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Singularity') ?></th>
                    <td><?= $ratsSingularity->has('singularity') ? $this->Html->link($ratsSingularity->singularity->id, ['controller' => 'Singularities', 'action' => 'view', $ratsSingularity->singularity->id]) : '' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
