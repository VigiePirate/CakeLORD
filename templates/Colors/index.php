<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color[]|\Cake\Collection\CollectionInterface $colors
 */
?>
<div class="colors index content">
    <?= $this->Html->link(__('New Color'), ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= __('All Colors') ?></h1>
    <div class="table-responsive">
        <table class="condensed">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('genotype') ?></th>
                    <th><?= $this->Paginator->sort('is_picture_mandatory', __('Mandatory picture?')) ?></th>
                    <th class="actions col-head"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($colors as $color): ?>
                <tr>
                    <td><?= $this->Number->format($color->id) ?></td>
                    <td><?= h($color->name) ?></td>
                    <td><?= h($color->genotype) ?></td>
                    <td><?= $color->is_picture_mandatory ? '✓' : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                            'url' => ['controller' => 'Colors', 'action' => 'edit', $color->id],
                            'class' => 'action-icon',
                            'alt' => __('Edit Color')
                        ])?>
                        <?= $this->Form->postLink(
                                $this->Html->image('/img/icon-delete.svg', [
                                    'class' => 'action-icon',
                                    'alt' => __('Delete Color')
                                ]),
                                ['action' => 'delete', $color->id],
                                ['confirm' => __('Are you sure you want to delete coolor # {0}?', $color->id), 'escape' => false]
                            )
                        ?>
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
