<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'Categories',
                'object' => $category,
                'tooltip' => __('Browse documentation category list'),
                'show_staff' => true,
                'user' => $user
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="categories view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Documentation category') ?></div>
            </div>

            <h1><?= h($category->name) ?></h1>

            <h2><?= __('Reference information') ?></h2>

            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($category->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($category->position) ?>/<?= $this->Number->format($category_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($category->name) ?></td>
                </tr>
            </table>

            <h2><? __('Related entries') ?></h2>
            <div class="related">
                <h3><?= __('Related Articles') ?></h3>
                <?php if (!empty($category->articles)) : ?>
                <div class="table-responsive">
                    <table class="summary">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Overtitle') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions-title"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($category->articles as $article) : ?>
                        <tr>
                            <td><?= h($article->id) ?></td>
                            <td><?= h($article->subtitle) ?></td>
                            <td><?= $this->Html->link(h($article->title), ['controller' => 'Articles', 'action' => 'view', $article->id]) ?></td>
                            <td><?= h($article->created) ?></td>
                            <td><?= h($article->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                                    'url' => ['controller' => 'Articles', 'action' => 'edit', $article->id],
                                    'class' => 'action-icon',
                                    'alt' => __('Edit Category')
                                ])?>
                                <?= $this->Form->postLink(
                                        $this->Html->image('/img/icon-delete.svg', [
                                            'class' => 'action-icon',
                                            'alt' => __('Delete Article')
                                        ]),
                                        ['action' => 'delete', $article->id],
                                        ['confirm' => __('Are you sure you want to delete # {0}?', $article->id), 'escape' => false]
                                    )
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    <div class="message warning">
                        <?= __('There is no article related to this category.') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h3><?= __('Related FAQs') ?></h3>
                <?php if (!empty($category->faqs)) : ?>
                <div class="table-responsive">
                    <table class="summary">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Question') ?></th>
                            <th><?= __('Answer') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($category->faqs as $faq) : ?>
                        <tr>
                            <td><?= h($faq->id) ?></td>
                            <td><?= h($faq->question) ?></td>
                            <td><?= h($faq->answer) ?></td>
                            <span class="nowrap">
                                <td class="actions">
                                    <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                                        'url' => ['controller' => 'Faqs', 'action' => 'edit', $faq->id],
                                        'class' => 'action-icon',
                                        'alt' => __('Edit Category')
                                    ])?>
                                    <?= $this->Form->postLink(
                                            $this->Html->image('/img/icon-delete.svg', [
                                                'class' => 'action-icon',
                                                'alt' => __('Delete Article')
                                            ]),
                                            ['action' => 'delete', $faq->id],
                                            ['confirm' => __('Are you sure you want to delete # {0}?', $faq->id), 'escape' => false]
                                        )
                                    ?>
                                </td>
                            </span>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    <div class="message warning">
                        <?= __('There is no FAQ related to this category.') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
