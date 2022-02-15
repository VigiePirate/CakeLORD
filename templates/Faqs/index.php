<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq[]|\Cake\Collection\CollectionInterface $faqs
 */
?>
<div class="faqs index content">
    <?= $this->Html->link(__('New Faq'), ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= __('All FAQs') ?></h1>
    <div class="table-responsive">
        <table class="condensed">
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
                    <td><?= $this->Html->link($faq->question, ['action' => 'view', $faq->id]) ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-edit.svg', [
                            'url' => ['controller' => 'Faqs', 'action' => 'edit', $faq->id],
                            'class' => 'action-icon',
                            'alt' => __('Edit FAQ')
                        ])?>
                        <?= $this->Form->postLink(
                                $this->Html->image('/img/icon-delete.svg', [
                                    'class' => 'action-icon',
                                    'alt' => __('Delete FAQ')
                                ]),
                                ['action' => 'delete', $faq->id],
                                ['confirm' => __('Are you sure you want to delete # {0}?', $faq->id), 'escape' => false]
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
