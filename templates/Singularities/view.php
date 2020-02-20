<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Singularity $singularity
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Singularity'), ['action' => 'edit', $singularity->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Singularity'), ['action' => 'delete', $singularity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $singularity->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Singularities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Singularity'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="singularities view content">
            <h3><?= h($singularity->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name Fr') ?></th>
                    <td><?= h($singularity->name_fr) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name En') ?></th>
                    <td><?= h($singularity->name_en) ?></td>
                </tr>
                <tr>
                    <th><?= __('Picture') ?></th>
                    <td><?= h($singularity->picture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($singularity->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($singularity->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($singularity->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
