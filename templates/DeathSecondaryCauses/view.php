<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathSecondaryCause $deathSecondaryCause
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Death Secondary Cause'), ['action' => 'edit', $deathSecondaryCause->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Death Secondary Cause'), ['action' => 'delete', $deathSecondaryCause->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deathSecondaryCause->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Death Secondary Causes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Death Secondary Cause'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deathSecondaryCauses view content">
            <h3><?= h($deathSecondaryCause->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name Fr') ?></th>
                    <td><?= h($deathSecondaryCause->name_fr) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name En') ?></th>
                    <td><?= h($deathSecondaryCause->name_en) ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Primary Cause') ?></th>
                    <td><?= $deathSecondaryCause->has('death_primary_cause') ? $this->Html->link($deathSecondaryCause->death_primary_cause->id, ['controller' => 'DeathPrimaryCauses', 'action' => 'view', $deathSecondaryCause->death_primary_cause->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($deathSecondaryCause->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($deathSecondaryCause->rats)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name Owner') ?></th>
                            <th><?= __('Name Pup') ?></th>
                            <th><?= __('Sex') ?></th>
                            <th><?= __('Pedigree Identifier') ?></th>
                            <th><?= __('Birth Date') ?></th>
                            <th><?= __('Death Date') ?></th>
                            <th><?= __('Death Primary Cause Id') ?></th>
                            <th><?= __('Death Secondary Cause Id') ?></th>
                            <th><?= __('Death Euthanized') ?></th>
                            <th><?= __('Death Diagnosed') ?></th>
                            <th><?= __('Death Necropsied') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('Picture Thumbnail') ?></th>
                            <th><?= __('Comments') ?></th>
                            <th><?= __('Validated') ?></th>
                            <th><?= __('Mother Rattery Id') ?></th>
                            <th><?= __('Father Rattery Id') ?></th>
                            <th><?= __('Mother Rat Id') ?></th>
                            <th><?= __('Father Rat Id') ?></th>
                            <th><?= __('Litter Id') ?></th>
                            <th><?= __('Owner User Id') ?></th>
                            <th><?= __('Color Id') ?></th>
                            <th><?= __('Earset Id') ?></th>
                            <th><?= __('Eyecolor Id') ?></th>
                            <th><?= __('Dilution Id') ?></th>
                            <th><?= __('Coat Id') ?></th>
                            <th><?= __('Marking Id') ?></th>
                            <th><?= __('Creator User Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($deathSecondaryCause->rats as $rats) : ?>
                        <tr>
                            <td><?= h($rats->id) ?></td>
                            <td><?= h($rats->name_owner) ?></td>
                            <td><?= h($rats->name_pup) ?></td>
                            <td><?= h($rats->sex) ?></td>
                            <td><?= h($rats->pedigree_identifier) ?></td>
                            <td><?= h($rats->birth_date) ?></td>
                            <td><?= h($rats->death_date) ?></td>
                            <td><?= h($rats->death_primary_cause_id) ?></td>
                            <td><?= h($rats->death_secondary_cause_id) ?></td>
                            <td><?= h($rats->death_euthanized) ?></td>
                            <td><?= h($rats->death_diagnosed) ?></td>
                            <td><?= h($rats->death_necropsied) ?></td>
                            <td><?= h($rats->picture) ?></td>
                            <td><?= h($rats->picture_thumbnail) ?></td>
                            <td><?= h($rats->comments) ?></td>
                            <td><?= h($rats->validated) ?></td>
                            <td><?= h($rats->mother_rattery_id) ?></td>
                            <td><?= h($rats->father_rattery_id) ?></td>
                            <td><?= h($rats->mother_rat_id) ?></td>
                            <td><?= h($rats->father_rat_id) ?></td>
                            <td><?= h($rats->litter_id) ?></td>
                            <td><?= h($rats->owner_user_id) ?></td>
                            <td><?= h($rats->color_id) ?></td>
                            <td><?= h($rats->earset_id) ?></td>
                            <td><?= h($rats->eyecolor_id) ?></td>
                            <td><?= h($rats->dilution_id) ?></td>
                            <td><?= h($rats->coat_id) ?></td>
                            <td><?= h($rats->marking_id) ?></td>
                            <td><?= h($rats->creator_user_id) ?></td>
                            <td><?= h($rats->created) ?></td>
                            <td><?= h($rats->modified) ?></td>
                            <td><?= h($rats->state_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rats', 'action' => 'view', $rats->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Rats', 'action' => 'edit', $rats->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rats', 'action' => 'delete', $rats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rats->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
