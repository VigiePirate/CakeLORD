<div class="coats index content">
    <?= $this->Html->link($texts['add'], ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= $texts['title'] ?></h1>
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
                    <?php foreach ($varieties as $variety): ?>
                    <tr>
                        <td><?= $this->Number->format($variety->id) ?></td>
                        <td><?= $this->Html->link(h($variety->name), ['action' => 'view', $variety->id]) ?></td>
                        <td><?= h($variety->genotype) ?></td>
                        <td><?= $variety->is_picture_mandatory ? '✓' : '' ?></td>
                        <td class="actions">
                            <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                                'url' => ['controller' => $Varieties, 'action' => 'edit', $variety->id],
                                'class' => 'action-icon',
                                'alt' => $texts['alt_edit']
                            ])?>
                            <?= $this->Form->postLink(
                                    $this->Html->image('/img/icon-delete.svg', [
                                        'class' => 'action-icon',
                                        'alt' => $texts['alt_delete']
                                    ]),
                                    ['action' => 'delete', $variety->id],
                                    ['confirm' => __('Are you sure you want to delete #{0}?', $variety->id), 'escape' => false]
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
</div>
