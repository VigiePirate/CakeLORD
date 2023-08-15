<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat $rat
 */
?>

<?php $this->assign('title', __('Delete')) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'Litters', 'action' => 'view', $litter->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                        <span class="tooltiptext"><?= __('Back to litter sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Delete Sheet of') ?></div>
            </div>

            <h1><?= h($litter->full_name) ?></h1>

            <?= $this->Flash->render(); ?>

            <?php if ($deletable) : ?>
                <h2 class="staff"><?= __('Review snapshots and messages before suppression') ?></h2>

                <details>
                    <summary class="staff">
                        <?= __('Messages') ?>
                    </summary>
                    <?php if (!empty($litter->litter_messages)) : ?>

                    <div class="table-responsive">
                        <table class="summary">
                            <thead>
                                <th><?= __('Id') ?></th>
                                <th><?= __('From User') ?></th>
                                <th><?= __('Message') ?></th>
                                <th><?= __('Created') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </thead>
                            <?php foreach ($litter->litter_messages as $message) : ?>
                            <tr>
                                <td><?= h($message->id) ?></td>
                                <td><?= h($message->from_user_id) ?></td>
                                <td><?= h($message->content) ?></td>
                                <td><?= h($message->created->i18nFormat('dd/MM/yyyy')) ?></td>
                                <td class="actions">
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <?php endif; ?>
                </details>

                <details>
                    <summary class="staff">
                        <?= __('Snapshots') ?>
                    </summary>
                    <?php if (!empty($litter->litter_snapshots)) : ?>
                    <div class="table-responsive">
                        <table class="summary">
                            <thead>
                                <th><?= __('Created') ?></th>
                                <th><?= __('Differences with current version') ?></th>
                                <!-- <th><?= __('Data') ?></th> -->
                                <th><?= __('State') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </thead>
                            <?php foreach ($litter->litter_snapshots as $litterSnapshots) : ?>
                            <tr>
                                <td><?= h($litterSnapshots->created) ?></td>
                                <td><?= h($snap_diffs[$litterSnapshots->id]) ?></td>
                                <td><?= h($litterSnapshots->state->symbol) ?></td>
                                <td class="actions">
                                    <span class="nowrap">
                                        <?= $this->Html->image('/img/icon-diff.svg', [
                                            'url' => ['controller' => 'LitterSnapshots', 'action' => 'diff', $litterSnapshots->id],
                                            'class' => 'action-icon',
                                            'alt' => __('Compare Versions')])
                                        ?>
                                        <?= $this->Html->image('/img/icon-restore.svg', [
                                            'url' => ['controller' => 'Litters', 'action' => 'restore', $litter->id, $litterSnapshots->id],
                                            'class' => 'action-icon',
                                            'alt' => __('Restore Snapshot')]) ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <?php endif; ?>
                </details>

                <?php
                    echo $this->Form->create(null);
                    echo $this->Form->button(__('Delete litter sheet'), [
                        'class' => 'button-staff',
                        'confirm' => __('Are you sure you want to delete litter #{0} with all its messages and snapshots?', [$litter->id])
                    ]);
                    echo $this->Form->end();
                ?>
            <?php else : ?>
                <h2 class="staff"><?= __('Review offspring before the litter sheet can be deleted') ?></h2>
                <?= $this->element('simple_staff_rats', ['rats' => $litter->offspring_rats, 'user' => $identity]) ?>
            <?php endif ; ?>
        </div>
    </div>
</div>
