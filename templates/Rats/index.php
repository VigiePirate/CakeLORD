<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat[]|\Cake\Collection\CollectionInterface $rats
 */
?>
<div class="rats index content">
    <?= $this->Html->link(__('New Rat'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Rats') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name_owner') ?></th>
                    <th><?= $this->Paginator->sort('name_pup') ?></th>
                    <th><?= $this->Paginator->sort('sex') ?></th>
                    <th><?= $this->Paginator->sort('pedigree_identifier') ?></th>
                    <th><?= $this->Paginator->sort('date_birth') ?></th>
                    <th><?= $this->Paginator->sort('date_death') ?></th>
                    <th><?= $this->Paginator->sort('death_cause_primary_id') ?></th>
                    <th><?= $this->Paginator->sort('death_cause_secondary_id') ?></th>
                    <th><?= $this->Paginator->sort('death_euthanized') ?></th>
                    <th><?= $this->Paginator->sort('death_diagnosed') ?></th>
                    <th><?= $this->Paginator->sort('death_necropsied') ?></th>
                    <th><?= $this->Paginator->sort('picture') ?></th>
                    <th><?= $this->Paginator->sort('picture_thumbnail') ?></th>
                    <th><?= $this->Paginator->sort('validated') ?></th>
                    <th><?= $this->Paginator->sort('rattery_mother_id') ?></th>
                    <th><?= $this->Paginator->sort('rattery_father_id') ?></th>
                    <th><?= $this->Paginator->sort('mother_id') ?></th>
                    <th><?= $this->Paginator->sort('father_id') ?></th>
                    <th><?= $this->Paginator->sort('litter_id') ?></th>
                    <th><?= $this->Paginator->sort('owner_id') ?></th>
                    <th><?= $this->Paginator->sort('color_id') ?></th>
                    <th><?= $this->Paginator->sort('earset_id') ?></th>
                    <th><?= $this->Paginator->sort('eyecolor_id') ?></th>
                    <th><?= $this->Paginator->sort('dilution_id') ?></th>
                    <th><?= $this->Paginator->sort('coat_id') ?></th>
                    <th><?= $this->Paginator->sort('marking_id') ?></th>
                    <th><?= $this->Paginator->sort('user_creator_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rats as $rat): ?>
                <tr>
                    <td><?= $this->Number->format($rat->id) ?></td>
                    <td><?= h($rat->name_owner) ?></td>
                    <td><?= h($rat->name_pup) ?></td>
                    <td><?= h($rat->sex) ?></td>
                    <td><?= h($rat->pedigree_identifier) ?></td>
                    <td><?= h($rat->date_birth) ?></td>
                    <td><?= h($rat->date_death) ?></td>
                    <td><?= $rat->has('death_causes_primary') ? $this->Html->link($rat->death_causes_primary->id, ['controller' => 'DeathCausesPrimary', 'action' => 'view', $rat->death_causes_primary->id]) : '' ?></td>
                    <td><?= $rat->has('death_causes_secondary') ? $this->Html->link($rat->death_causes_secondary->id, ['controller' => 'DeathCausesSecondary', 'action' => 'view', $rat->death_causes_secondary->id]) : '' ?></td>
                    <td><?= h($rat->death_euthanized) ?></td>
                    <td><?= h($rat->death_diagnosed) ?></td>
                    <td><?= h($rat->death_necropsied) ?></td>
                    <td><?= h($rat->picture) ?></td>
                    <td><?= h($rat->picture_thumbnail) ?></td>
                    <td><?= h($rat->validated) ?></td>
                    <td><?= $this->Number->format($rat->rattery_mother_id) ?></td>
                    <td><?= $rat->has('rattery') ? $this->Html->link($rat->rattery->name, ['controller' => 'Ratteries', 'action' => 'view', $rat->rattery->id]) : '' ?></td>
                    <td><?= $this->Number->format($rat->mother_id) ?></td>
                    <td><?= $rat->has('rat') ? $this->Html->link($rat->rat->id, ['controller' => 'Rats', 'action' => 'view', $rat->rat->id]) : '' ?></td>
                    <td><?= $rat->has('litter') ? $this->Html->link($rat->litter->id, ['controller' => 'Litters', 'action' => 'view', $rat->litter->id]) : '' ?></td>
                    <td><?= $this->Number->format($rat->owner_id) ?></td>
                    <td><?= $rat->has('color') ? $this->Html->link($rat->color->id, ['controller' => 'Colors', 'action' => 'view', $rat->color->id]) : '' ?></td>
                    <td><?= $rat->has('earset') ? $this->Html->link($rat->earset->id, ['controller' => 'Earsets', 'action' => 'view', $rat->earset->id]) : '' ?></td>
                    <td><?= $rat->has('eyecolor') ? $this->Html->link($rat->eyecolor->id, ['controller' => 'Eyecolors', 'action' => 'view', $rat->eyecolor->id]) : '' ?></td>
                    <td><?= $rat->has('dilution') ? $this->Html->link($rat->dilution->id, ['controller' => 'Dilutions', 'action' => 'view', $rat->dilution->id]) : '' ?></td>
                    <td><?= $rat->has('coat') ? $this->Html->link($rat->coat->id, ['controller' => 'Coats', 'action' => 'view', $rat->coat->id]) : '' ?></td>
                    <td><?= $rat->has('marking') ? $this->Html->link($rat->marking->id, ['controller' => 'Markings', 'action' => 'view', $rat->marking->id]) : '' ?></td>
                    <td><?= $rat->has('user') ? $this->Html->link($rat->user->id, ['controller' => 'Users', 'action' => 'view', $rat->user->id]) : '' ?></td>
                    <td><?= h($rat->created) ?></td>
                    <td><?= h($rat->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $rat->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rat->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rat->id)]) ?>
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
