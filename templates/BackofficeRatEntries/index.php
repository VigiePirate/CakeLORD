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
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('rat_id') ?></th>
                    <th><?= $this->Paginator->sort('rat_name_owner') ?></th>
                    <th><?= $this->Paginator->sort('rat_name_pup') ?></th>
                    <th><?= $this->Paginator->sort('rat_sex') ?></th>
                    <th><?= $this->Paginator->sort('rat_pedigree_identifier') ?></th>
                    <th><?= $this->Paginator->sort('rat_date_birth') ?></th>
                    <th><?= $this->Paginator->sort('rat_date_death') ?></th>
                    <th><?= $this->Paginator->sort('death_cause_primary_id') ?></th>
                    <th><?= $this->Paginator->sort('death_cause_secondary_id') ?></th>
                    <th><?= $this->Paginator->sort('rat_death_euthanized') ?></th>
                    <th><?= $this->Paginator->sort('rat_death_diagnosed') ?></th>
                    <th><?= $this->Paginator->sort('rat_death_necropsied') ?></th>
                    <th><?= $this->Paginator->sort('rat_picture') ?></th>
                    <th><?= $this->Paginator->sort('rat_picture_thumbnail') ?></th>
                    <th><?= $this->Paginator->sort('rat_validated') ?></th>
                    <th><?= $this->Paginator->sort('rattery_mother_id') ?></th>
                    <th><?= $this->Paginator->sort('rattery_father_id') ?></th>
                    <th><?= $this->Paginator->sort('rat_mother_id') ?></th>
                    <th><?= $this->Paginator->sort('rat_father_id') ?></th>
                    <th><?= $this->Paginator->sort('user_owner_id') ?></th>
                    <th><?= $this->Paginator->sort('color_id') ?></th>
                    <th><?= $this->Paginator->sort('earset_id') ?></th>
                    <th><?= $this->Paginator->sort('eyecolor_id') ?></th>
                    <th><?= $this->Paginator->sort('dilution_id') ?></th>
                    <th><?= $this->Paginator->sort('coat_id') ?></th>
                    <th><?= $this->Paginator->sort('marking_id') ?></th>
                    <th><?= $this->Paginator->sort('singularity_id_list') ?></th>
                    <th><?= $this->Paginator->sort('user_creator_id') ?></th>
                    <th><?= $this->Paginator->sort('rat_date_create') ?></th>
                    <th><?= $this->Paginator->sort('rat_date_last_update') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($backofficeRatEntries as $backofficeRatEntry): ?>
                <tr>
                    <td><?= $this->Number->format($backofficeRatEntry->id) ?></td>
                    <td><?= $this->Number->format($backofficeRatEntry->status) ?></td>
                    <td><?= $backofficeRatEntry->has('rat') ? $this->Html->link($backofficeRatEntry->rat->id, ['controller' => 'Rats', 'action' => 'view', $backofficeRatEntry->rat->id]) : '' ?></td>
                    <td><?= h($backofficeRatEntry->rat_name_owner) ?></td>
                    <td><?= h($backofficeRatEntry->rat_name_pup) ?></td>
                    <td><?= h($backofficeRatEntry->rat_sex) ?></td>
                    <td><?= h($backofficeRatEntry->rat_pedigree_identifier) ?></td>
                    <td><?= h($backofficeRatEntry->rat_date_birth) ?></td>
                    <td><?= h($backofficeRatEntry->rat_date_death) ?></td>
                    <td><?= $backofficeRatEntry->has('death_causes_primary') ? $this->Html->link($backofficeRatEntry->death_causes_primary->id, ['controller' => 'DeathCausesPrimary', 'action' => 'view', $backofficeRatEntry->death_causes_primary->id]) : '' ?></td>
                    <td><?= $backofficeRatEntry->has('death_causes_secondary') ? $this->Html->link($backofficeRatEntry->death_causes_secondary->id, ['controller' => 'DeathCausesSecondary', 'action' => 'view', $backofficeRatEntry->death_causes_secondary->id]) : '' ?></td>
                    <td><?= h($backofficeRatEntry->rat_death_euthanized) ?></td>
                    <td><?= h($backofficeRatEntry->rat_death_diagnosed) ?></td>
                    <td><?= h($backofficeRatEntry->rat_death_necropsied) ?></td>
                    <td><?= h($backofficeRatEntry->rat_picture) ?></td>
                    <td><?= h($backofficeRatEntry->rat_picture_thumbnail) ?></td>
                    <td><?= $this->Number->format($backofficeRatEntry->rat_validated) ?></td>
                    <td><?= $this->Number->format($backofficeRatEntry->rattery_mother_id) ?></td>
                    <td><?= $backofficeRatEntry->has('rattery') ? $this->Html->link($backofficeRatEntry->rattery->name, ['controller' => 'Ratteries', 'action' => 'view', $backofficeRatEntry->rattery->id]) : '' ?></td>
                    <td><?= $this->Number->format($backofficeRatEntry->rat_mother_id) ?></td>
                    <td><?= $backofficeRatEntry->has('backoffice_rat_entry') ? $this->Html->link($backofficeRatEntry->backoffice_rat_entry->id, ['controller' => 'BackofficeRatEntries', 'action' => 'view', $backofficeRatEntry->backoffice_rat_entry->id]) : '' ?></td>
                    <td><?= $this->Number->format($backofficeRatEntry->user_owner_id) ?></td>
                    <td><?= $backofficeRatEntry->has('color') ? $this->Html->link($backofficeRatEntry->color->id, ['controller' => 'Colors', 'action' => 'view', $backofficeRatEntry->color->id]) : '' ?></td>
                    <td><?= $backofficeRatEntry->has('earset') ? $this->Html->link($backofficeRatEntry->earset->id, ['controller' => 'Earsets', 'action' => 'view', $backofficeRatEntry->earset->id]) : '' ?></td>
                    <td><?= $backofficeRatEntry->has('eyecolor') ? $this->Html->link($backofficeRatEntry->eyecolor->id, ['controller' => 'Eyecolors', 'action' => 'view', $backofficeRatEntry->eyecolor->id]) : '' ?></td>
                    <td><?= $backofficeRatEntry->has('dilution') ? $this->Html->link($backofficeRatEntry->dilution->id, ['controller' => 'Dilutions', 'action' => 'view', $backofficeRatEntry->dilution->id]) : '' ?></td>
                    <td><?= $backofficeRatEntry->has('coat') ? $this->Html->link($backofficeRatEntry->coat->id, ['controller' => 'Coats', 'action' => 'view', $backofficeRatEntry->coat->id]) : '' ?></td>
                    <td><?= $backofficeRatEntry->has('marking') ? $this->Html->link($backofficeRatEntry->marking->id, ['controller' => 'Markings', 'action' => 'view', $backofficeRatEntry->marking->id]) : '' ?></td>
                    <td><?= h($backofficeRatEntry->singularity_id_list) ?></td>
                    <td><?= $backofficeRatEntry->has('user') ? $this->Html->link($backofficeRatEntry->user->id, ['controller' => 'Users', 'action' => 'view', $backofficeRatEntry->user->id]) : '' ?></td>
                    <td><?= h($backofficeRatEntry->rat_date_create) ?></td>
                    <td><?= h($backofficeRatEntry->rat_date_last_update) ?></td>
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
