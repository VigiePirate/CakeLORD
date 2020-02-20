<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Singularity[]|\Cake\Collection\CollectionInterface $singularities
 */
?>
<div class="singularities index content">
    <?= $this->Html->link(__('New Singularity'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Singularities') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name_fr') ?></th>
                    <th><?= $this->Paginator->sort('name_en') ?></th>
                    <th><?= $this->Paginator->sort('picture') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($singularities as $singularity): ?>
                <tr>
                    <td><?= $this->Number->format($singularity->id) ?></td>
                    <td><?= h($singularity->name_fr) ?></td>
                    <td><?= h($singularity->name_en) ?></td>
                    <td><?= h($singularity->picture) ?></td>
                    <td><?= h($singularity->created) ?></td>
                    <td><?= h($singularity->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $singularity->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $singularity->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $singularity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $singularity->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
