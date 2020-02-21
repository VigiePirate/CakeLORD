<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Earset[]|\Cake\Collection\CollectionInterface $earsets
 */
?>
<div class="earsets index content">
    <?= $this->Html->link(__('New Earset'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Earsets') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name_fr') ?></th>
                    <th><?= $this->Paginator->sort('name_en') ?></th>
                    <th><?= $this->Paginator->sort('picture') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($earsets as $earset): ?>
                <tr>
                    <td><?= $this->Number->format($earset->id) ?></td>
                    <td><?= h($earset->name_fr) ?></td>
                    <td><?= h($earset->name_en) ?></td>
                    <td><?= h($earset->picture) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $earset->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $earset->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $earset->id], ['confirm' => __('Are you sure you want to delete # {0}?', $earset->id)]) ?>
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
