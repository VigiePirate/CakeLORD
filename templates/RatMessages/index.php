<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\RatMessage> $ratMessages
 */
?>

<?php $this->assign('title', __('Rat Messages')) ?>

<div class="ratMessages index content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Back office') ?></div>
    </div>
    <h1><?= __('All Rat Messages') ?></h1>
    <div class="table-responsive">
        <table class="summary highlightable">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('created', __x('message', 'Created')) ?></th>
                    <th><?= $this->Paginator->sort('from_user_id', __x('message', 'Sent by')) ?></th>
                    <th><?= $this->Paginator->sort('Rats.pedigree_identifier', __x('message', 'About')) ?></th>
                    <th class="col-head"><?= __('Usual name') ?></th>
                    <th class="col-head"><?= __x('message', 'Content') ?></th>
                    <th><?= $this->Paginator->sort('is_staff_request', __('Staff?')) ?></th>
                    <th><?= $this->Paginator->sort('is_automatically_generated', __('Auto?')) ?></th>
                    <th class="actions col-head"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ratMessages as $ratMessage): ?>
                    <tr>
                        <td class="nowrap"><?= h($ratMessage->created) ?></td>
                        <td><?= $ratMessage->has('user') ? h($ratMessage->user->username) : '' ?></td>
                        <td><?= $ratMessage->has('rat') ? $this->Html->link($ratMessage->rat->pedigree_identifier, ['controller' => 'Rats', 'action' => 'view', $ratMessage->rat->id]) : '' ?></td>
                        <td><?= h($ratMessage->rat->usual_name) ?></td>
                        <td class="ellipsis" onclick="toggleMessage(this)"><?= h($ratMessage->content) ?></td>
                        <td><?= $ratMessage->is_staff_request ? '✓' : '' ?></td>
                        <td><?= $ratMessage->is_automatically_generated ? '✓' : '' ?></td>
                        <td class="actions">
                            <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                                'url' => ['action' => 'edit', $ratMessage->id],
                                'class' => 'action-icon',
                                'alt' => __('Edit')
                            ])?>
                            <?= $this->Form->postLink(
                                    $this->Html->image('/img/icon-delete.svg', [
                                        'class' => 'action-icon',
                                        'alt' => __('Delete')
                                    ]),
                                    ['action' => 'delete', $ratMessage->id],
                                    ['confirm' => __('Are you sure you want to delete # {0}?', $ratMessage->id), 'escape' => false]
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
