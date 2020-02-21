<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eyecolor[]|\Cake\Collection\CollectionInterface $eyecolors
 */
?>
<div class="eyecolors index content">
    <?= $this->Html->link(__('New Eyecolor'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Eyecolors') ?></h3>
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
                <?php foreach ($eyecolors as $eyecolor): ?>
                <tr>
                    <td><?= $this->Number->format($eyecolor->id) ?></td>
                    <td><?= h($eyecolor->name_fr) ?></td>
                    <td><?= h($eyecolor->name_en) ?></td>
                    <td><?= h($eyecolor->picture) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $eyecolor->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $eyecolor->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eyecolor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eyecolor->id)]) ?>
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
