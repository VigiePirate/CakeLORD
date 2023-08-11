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
                        'url' => ['controller' => 'Rats', 'action' => 'view', $rat->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                        <span class="tooltiptext"><?= __('Back to rat sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats form content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Delete Sheet of') ?></div>
            </div>

            <h1><?= $rat->usual_name ?> (<?= $rat->pedigree_identifier ?>)</h1>

            <?= $this->Flash->render(); ?>

            <?php if ($deletable) : ?>
                <h2 class="staff"><?= __('Review snapshots and messages before suppression') ?></h2>

                <details>
                    <summary class="staff">
                        <?= __('Messages') ?>
                    </summary>
                    <?php if (!empty($rat->rat_messages)) : ?>

                    <div class="table-responsive">
                        <table class="summary">
                            <thead>
                                <th><?= __('Id') ?></th>
                                <th><?= __('From User') ?></th>
                                <th><?= __('Message') ?></th>
                                <th><?= __('Created') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </thead>
                            <?php foreach ($rat->rat_messages as $message) : ?>
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
                    <?php if (!empty($rat->rat_snapshots)) : ?>
                    <div class="table-responsive">
                        <table class="summary">
                            <thead>
                                <th><?= __('Created') ?></th>
                                <th><?= __('Differences with current version') ?></th>
                                <!-- <th><?= __('Data') ?></th> -->
                                <th><?= __('State') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </thead>
                            <?php foreach ($rat->rat_snapshots as $ratSnapshots) : ?>
                            <tr>
                                <td><?= h($ratSnapshots->created) ?></td>
                                <td><?= h($snap_diffs[$ratSnapshots->id]) ?></td>
                                <td><?= h($ratSnapshots->state->symbol) ?></td>
                                <td class="actions">
                                    <span class="nowrap">
                                        <?= $this->Html->image('/img/icon-diff.svg', [
                                            'url' => ['controller' => 'RatSnapshots', 'action' => 'diff', $ratSnapshots->id],
                                            'class' => 'action-icon',
                                            'alt' => __('Compare Versions')])
                                        ?>
                                        <?= $this->Html->image('/img/icon-restore.svg', [
                                            'url' => ['controller' => 'Rats', 'action' => 'restore', $rat->id, $ratSnapshots->id],
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
                    echo $this->Form->button(__('Delete rat sheet'), [
                        'class' => 'button-staff',
                        'confirm' => __('Are you sure you want to delete rat #{0} with all its messages and snapshots?', [$rat->id])
                    ]);
                    echo $this->Form->end();
                ?>
            <?php else : ?>
                <h2 class="staff"><?= __('Review bred litters before the rat sheet can be deleted') ?></h2>
                <?= $this->element('simple_staff_litters', ['litters' => $rat->bred_litters]) ?>
            <?php endif ; ?>
        </div>
    </div>
</div>
