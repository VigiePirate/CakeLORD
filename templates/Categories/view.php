<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="categories view content">
            <h3><?= h($category->name) ?></h3>
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
            <div class="related">
                <h4><?= __('Related Articles') ?></h4>
                <?php if (!empty($category->articles)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Subtitle') ?></th>
                            <th><?= __('Content') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Category Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($category->articles as $articles) : ?>
                        <tr>
                            <td><?= h($articles->id) ?></td>
                            <td><?= h($articles->title) ?></td>
                            <td><?= h($articles->subtitle) ?></td>
                            <td><?= h($articles->content) ?></td>
                            <td><?= h($articles->created) ?></td>
                            <td><?= h($articles->modified) ?></td>
                            <td><?= h($articles->category_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Articles', 'action' => 'view', $articles->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Articles', 'action' => 'edit', $articles->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Articles', 'action' => 'delete', $articles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articles->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Faqs') ?></h4>
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
