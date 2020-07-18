<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq[]|\Cake\Collection\CollectionInterface $faqs
 */
?>
<div class="faqs index content">
    <?= $this->Html->link(__('New Faq'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Faqs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('category_id') ?></th>
                    <th><?= $this->Paginator->sort('question') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($faqs as $faq): ?>
                <tr>
                    <td><?= $this->Number->format($faq->id) ?></td>
                    <td><?= $faq->has('category') ? $this->Html->link($faq->category->name, ['controller' => 'Categories', 'action' => 'view', $faq->category->id]) : '' ?></td>
                    <td><?= h($faq->question) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $faq->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $faq->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $faq->id], ['confirm' => __('Are you sure you want to delete # {0}?', $faq->id)]) ?>
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
