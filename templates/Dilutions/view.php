<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dilution $dilution
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Dilution'), ['action' => 'edit', $dilution->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Dilution'), ['action' => 'delete', $dilution->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dilution->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Dilutions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Dilution'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="dilutions view content">
            <h3><?= h($dilution->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($dilution->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Picture') ?></th>
                    <td><?= h($dilution->picture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Genotype') ?></th>
                    <td><?= h($dilution->genotype) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($dilution->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($dilution->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Rats') ?></h4>
                <?php if (!empty($dilution->rats)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Pup Name') ?></th>
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
                            <th><?= __('Is Alive') ?></th>
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
                            <th><?= __('Rattery Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($dilution->rats as $rats) : ?>
                        <tr>
                            <td><?= h($rats->id) ?></td>
                            <td><?= h($rats->name) ?></td>
                            <td><?= h($rats->pup_name) ?></td>
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
                            <td><?= h($rats->is_alive) ?></td>
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
                            <td><?= h($rats->rattery_id) ?></td>
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
