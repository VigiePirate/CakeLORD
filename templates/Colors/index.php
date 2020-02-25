<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color[]|\Cake\Collection\CollectionInterface $colors
 */
?>
<div class="colors index content">
    <?= $this->Html->link(__('New Color'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Colors') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('genotype') ?></th>
                    <th><?= $this->Paginator->sort('picture') ?></th>
                    <th><?= $this->Paginator->sort('eyecolor_id') ?></th>
                    <th><?= $this->Paginator->sort('is_picture_mandatory') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($colors as $color): ?>
                <tr>
                    <td><?= $this->Number->format($color->id) ?></td>
                    <td><?= h($color->name) ?></td>
                    <td><?= h($color->genotype) ?></td>
                    <td><?= h($color->picture) ?></td>
                    <td><?= $color->has('eyecolor') ? $this->Html->link($color->eyecolor->name, ['controller' => 'Eyecolors', 'action' => 'view', $color->eyecolor->id]) : '' ?></td>
                    <td><?= h($color->is_picture_mandatory) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $color->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $color->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $color->id], ['confirm' => __('Are you sure you want to delete # {0}?', $color->id)]) ?>
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
