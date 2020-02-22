<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BackofficeRatEntry[]|\Cake\Collection\CollectionInterface $backofficeRatEntries
 */
?>
<div class="backofficeRatEntries index content">
    <?= $this->Html->link(__('New Backoffice Rat Entry'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Backoffice Rat Entries') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('rat_id') ?></th>
                    <th><?= $this->Paginator->sort('owner_name') ?></th>
                    <th><?= $this->Paginator->sort('pup_name') ?></th>
                    <th><?= $this->Paginator->sort('sex') ?></th>
                    <th><?= $this->Paginator->sort('pedigree_identifier') ?></th>
                    <th><?= $this->Paginator->sort('birth_date') ?></th>
                    <th><?= $this->Paginator->sort('death_date') ?></th>
                    <th><?= $this->Paginator->sort('primary_death_cause_id') ?></th>
                    <th><?= $this->Paginator->sort('secondary_death_cause_id') ?></th>
                    <th><?= $this->Paginator->sort('death_euthanized') ?></th>
                    <th><?= $this->Paginator->sort('death_diagnosed') ?></th>
                    <th><?= $this->Paginator->sort('death_necropsied') ?></th>
                    <th><?= $this->Paginator->sort('picture') ?></th>
                    <th><?= $this->Paginator->sort('picture_thumbnail') ?></th>
                    <th><?= $this->Paginator->sort('validated') ?></th>
                    <th><?= $this->Paginator->sort('mother_rattery_id') ?></th>
                    <th><?= $this->Paginator->sort('father_rattery_id') ?></th>
                    <th><?= $this->Paginator->sort('mother_rat_id') ?></th>
                    <th><?= $this->Paginator->sort('father_rat_id') ?></th>
                    <th><?= $this->Paginator->sort('owner_user_id') ?></th>
                    <th><?= $this->Paginator->sort('color_id') ?></th>
                    <th><?= $this->Paginator->sort('earset_id') ?></th>
                    <th><?= $this->Paginator->sort('eyecolor_id') ?></th>
                    <th><?= $this->Paginator->sort('dilution_id') ?></th>
                    <th><?= $this->Paginator->sort('coat_id') ?></th>
                    <th><?= $this->Paginator->sort('marking_id') ?></th>
                    <th><?= $this->Paginator->sort('creator_user_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('state_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($backofficeRatEntries as $backofficeRatEntry): ?>
                <tr>
                    <td><?= $this->Number->format($backofficeRatEntry->id) ?></td>
                    <td><?= $backofficeRatEntry->has('rat') ? $this->Html->link($backofficeRatEntry->rat->id, ['controller' => 'Rats', 'action' => 'view', $backofficeRatEntry->rat->id]) : '' ?></td>
                    <td><?= h($backofficeRatEntry->owner_name) ?></td>
                    <td><?= h($backofficeRatEntry->pup_name) ?></td>
                    <td><?= h($backofficeRatEntry->sex) ?></td>
                    <td><?= h($backofficeRatEntry->pedigree_identifier) ?></td>
                    <td><?= h($backofficeRatEntry->birth_date) ?></td>
                    <td><?= h($backofficeRatEntry->death_date) ?></td>
                    <td><?= $this->Number->format($backofficeRatEntry->primary_death_cause_id) ?></td>
                    <td><?= $this->Number->format($backofficeRatEntry->secondary_death_cause_id) ?></td>
                    <td><?= h($backofficeRatEntry->death_euthanized) ?></td>
                    <td><?= h($backofficeRatEntry->death_diagnosed) ?></td>
                    <td><?= h($backofficeRatEntry->death_necropsied) ?></td>
                    <td><?= h($backofficeRatEntry->picture) ?></td>
                    <td><?= h($backofficeRatEntry->picture_thumbnail) ?></td>
                    <td><?= h($backofficeRatEntry->validated) ?></td>
                    <td><?= $this->Number->format($backofficeRatEntry->mother_rattery_id) ?></td>
                    <td><?= $this->Number->format($backofficeRatEntry->father_rattery_id) ?></td>
                    <td><?= $this->Number->format($backofficeRatEntry->mother_rat_id) ?></td>
                    <td><?= $this->Number->format($backofficeRatEntry->father_rat_id) ?></td>
                    <td><?= $this->Number->format($backofficeRatEntry->owner_user_id) ?></td>
                    <td><?= $backofficeRatEntry->has('color') ? $this->Html->link($backofficeRatEntry->color->id, ['controller' => 'Colors', 'action' => 'view', $backofficeRatEntry->color->id]) : '' ?></td>
                    <td><?= $backofficeRatEntry->has('earset') ? $this->Html->link($backofficeRatEntry->earset->id, ['controller' => 'Earsets', 'action' => 'view', $backofficeRatEntry->earset->id]) : '' ?></td>
                    <td><?= $backofficeRatEntry->has('eyecolor') ? $this->Html->link($backofficeRatEntry->eyecolor->id, ['controller' => 'Eyecolors', 'action' => 'view', $backofficeRatEntry->eyecolor->id]) : '' ?></td>
                    <td><?= $backofficeRatEntry->has('dilution') ? $this->Html->link($backofficeRatEntry->dilution->id, ['controller' => 'Dilutions', 'action' => 'view', $backofficeRatEntry->dilution->id]) : '' ?></td>
                    <td><?= $backofficeRatEntry->has('coat') ? $this->Html->link($backofficeRatEntry->coat->id, ['controller' => 'Coats', 'action' => 'view', $backofficeRatEntry->coat->id]) : '' ?></td>
                    <td><?= $backofficeRatEntry->has('marking') ? $this->Html->link($backofficeRatEntry->marking->id, ['controller' => 'Markings', 'action' => 'view', $backofficeRatEntry->marking->id]) : '' ?></td>
                    <td><?= $this->Number->format($backofficeRatEntry->creator_user_id) ?></td>
                    <td><?= h($backofficeRatEntry->created) ?></td>
                    <td><?= h($backofficeRatEntry->modified) ?></td>
                    <td><?= $backofficeRatEntry->has('state') ? $this->Html->link($backofficeRatEntry->state->name, ['controller' => 'States', 'action' => 'view', $backofficeRatEntry->state->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $backofficeRatEntry->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $backofficeRatEntry->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $backofficeRatEntry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $backofficeRatEntry->id)]) ?>
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
