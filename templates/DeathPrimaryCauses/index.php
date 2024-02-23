<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathPrimaryCause[]|\Cake\Collection\CollectionInterface $deathPrimaryCauses
 */
?>
<?php $this->assign('title', __('Death Categories')) ?>

<div class="deathPrimaryCauses index content">
    <?= $this->Html->link(__('New Death Category'), ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= __('Death Categories') ?></h1>
    <div class="table-responsive">
        <table class="condensed">
            <thead>
                <tr>
                    <!-- <th><?= $this->Paginator->sort('id') ?></th> -->
                    <th><?= $this->Paginator->sort($sort_fields['name'], __('Name')) ?></th>
                    <th><?= $this->Paginator->sort('is_infant', __('Infant?')) ?></th>
                    <th><?= $this->Paginator->sort('is_accident', __('Accidental?')) ?></th>
                    <th><?= $this->Paginator->sort('is_oldster', __('Old age?')) ?></th>
                    <th class="actions-title col-head"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deathPrimaryCauses as $deathPrimaryCause): ?>
                <tr>
                    <td><?= $this->Html->link(
                        h($deathPrimaryCause->name),
                        ['action' => 'view', $deathPrimaryCause->id]
                    )?></td>
                    <td><?= $deathPrimaryCause->is_infant ? '✓' : '' ?></td>
                    <td><?= $deathPrimaryCause->is_accident ? '✓' : '' ?></td>
                    <td><?= $deathPrimaryCause->is_oldster ? '✓' : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                            'url' => ['controller' => 'DeathPrimaryCauses', 'action' => 'edit', $deathPrimaryCause->id],
                            'class' => 'action-icon',
                            'alt' => __('See Death Category')]) ?>
                        <?= $this->Form->postLink(
                                $this->Html->image('/img/icon-delete.svg', [
                                    'class' => 'action-icon',
                                    'alt' => __('Delete Death Category')
                                ]),
                                ['action' => 'delete', $deathPrimaryCause->id],
                                ['confirm' => __('Are you sure you want to delete country # {0}?', $deathPrimaryCause->id), 'escape' => false]
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
