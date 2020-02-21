<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RatsSingularity[]|\Cake\Collection\CollectionInterface $ratsSingularities
 */
?>
<div class="ratsSingularities index content">
    <?= $this->Html->link(__('New Rats Singularity'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Rats Singularities') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('rats_id') ?></th>
                    <th><?= $this->Paginator->sort('singularities_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratsSingularities as $ratsSingularity): ?>
                <tr>
                    <td><?= $ratsSingularity->has('rat') ? $this->Html->link($ratsSingularity->rat->id, ['controller' => 'Rats', 'action' => 'view', $ratsSingularity->rat->id]) : '' ?></td>
                    <td><?= $ratsSingularity->has('singularity') ? $this->Html->link($ratsSingularity->singularity->id, ['controller' => 'Singularities', 'action' => 'view', $ratsSingularity->singularity->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ratsSingularity->rats_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ratsSingularity->rats_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ratsSingularity->rats_id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratsSingularity->rats_id)]) ?>
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
