<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-list.svg', [
                        'url' => ['controller' => 'Categories', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('All categories')]) ?>
                    <span class="tooltiptext"><?= __('See all categories') ?></span>
                </div>
            </div>
            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => 'Categories',
                    'object' => $category
                    ])
                ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="categories view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Category') ?></div>
            </div>

            <h1><?= h($category->name) ?></h1>

            <h2><?= __('Reference information') ?></h2>

            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($category->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($category->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($category->position) ?></td>
                </tr>
            </table>

            <h2><? __('Related entries') ?></h2>
            <div class="related">
                <h3><?= __('Related Articles') ?></h3>
                <?php if (!empty($category->articles)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Subtitle') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Manage') ?></th>
                        </tr>
                        <?php foreach ($category->articles as $article) : ?>
                        <tr>
                            <td><?= h($article->id) ?></td>
                            <td><?= h($article->title) ?></td>
                            <td><?= h($article->subtitle) ?></td>
                            <td><?= h($article->created) ?></td>
                            <td><?= h($article->modified) ?></td>
                            <td class="actions">
                                <span class="nowrap">
                                    <?= $this->Html->image('/img/icon-backoffice.svg', [
                                        'url' => ['controller' => 'Articles', 'action' => 'view', $article->id],
                                        'class' => 'action-icon',
                                        'alt' => __('Manage')]) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h3><?= __('Related Faqs') ?></h3>
                <?php if (!empty($category->faqs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Category Id') ?></th>
                            <th><?= __('Question') ?></th>
                            <th><?= __('Answer') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($category->faqs as $faqs) : ?>
                        <tr>
                            <td><?= h($faqs->id) ?></td>
                            <td><?= h($faqs->category_id) ?></td>
                            <td><?= h($faqs->question) ?></td>
                            <td><?= h($faqs->answer) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Faqs', 'action' => 'view', $faqs->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Faqs', 'action' => 'edit', $faqs->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Faqs', 'action' => 'delete', $faqs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $faqs->id)]) ?>
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
