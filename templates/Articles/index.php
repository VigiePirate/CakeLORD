<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<div class="articles index content">
    <?= $this->Html->link(__('New Article'), ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= __('All Articles') ?></h1>
    <div class="table-responsive">
        <table class="condensed">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('Categories.name', __('Category')) ?></th>
                    <th><?= $this->Paginator->sort('subtitle', __('Overtitle')) ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions col-head"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= $this->Number->format($article->id) ?></td>
                    <td><?= $this->Html->link($article->category->name, ['controller' => 'Categories', 'action' => 'view', $article->category->id]) ?></td>
                    <td><?= h($article->subtitle) ?></td>
                    <td><?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?></td>
                    <td><?= h($article->created) ?></td>
                    <td><?= h($article->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                            'url' => ['controller' => 'Articles', 'action' => 'edit', $article->id],
                            'class' => 'action-icon',
                            'alt' => __('Edit Article')
                        ])?>
                        <?= $this->Html->image('/img/icon-delete.svg', [
                            'url' => ['controller' => 'Articles', 'action' => 'delete', $article->id],
                            'class' => 'action-icon',
                            'alt' => __('Delete Article')
                        ])?>
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
