<h3><?= h($rubric) ?></h3>
<div class="table-responsive">
    <table>
        <thead>
                <?php if (! in_array('birth_date', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('birth_date') ?></th>
                <?php endif; ?>
                <?php if (! in_array('dam', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('dam') ?></th>
                <?php endif; ?>
                <?php if (! in_array('sire', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('sire') ?></th>
                <?php endif; ?>
                <?php if (! in_array('pups_number', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('pups_number') ?></th>
                <?php endif; ?>
                <?php if (! in_array('state', $exceptions)): ?>
                    <th><?= $this->Paginator->sort('state') ?></th>
                <?php endif; ?>
        </thead>
        <tbody>
            <?php foreach($litters as $litter): ?>
                <tr>
                    <?php if (! in_array('birth_date', $exceptions)): ?>
                        <td><?= h($litter->birth_date) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('dam', $exceptions)): ?>
                        <td><?= $this->Html->link($litter->dam->name, ['controller' => 'Rats', 'action' => 'view', $litter->dam->id]) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('sire', $exceptions)): ?>
                        <td><?= $this->Html->link($litter->sire->name, ['controller' => 'Rats', 'action' => 'view', $litter->sire->id]) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('pups_number', $exceptions)): ?>
                        <td><?= h($litter->pups_number) ?></td>
                    <?php endif; ?>
                    <?php if (! in_array('state', $exceptions)): ?>
                        <td><?= $litter->has('state') ? $this->Html->link($litter->state->name, ['controller' => 'States', 'action' => 'view', $litter->state->id]) : '' ?></td>
                    <?php endif; ?>
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
