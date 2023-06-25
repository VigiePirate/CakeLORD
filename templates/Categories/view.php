<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>

<?php $this->assign('title', h($category->name)) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav-group">
            <?= $this->element('default_sidebar') ?>
        </div>
        <div class="side-nav-group">
            <div class="tooltip">
                <?= $this->Html->image('/img/icon-back.svg', [
                    'url' => 'javascript:history.back()',
                    'class' => 'side-nav-icon',
                    'alt' => __('Back')]) ?>
                    <span class="tooltiptext"><?= __('Back') ?></span>
                </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="categories view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Guides') ?></div>
            </div>

            <h1><?= h($category->name) ?></h1>

            <h2><?= __('FAQs') ?></h2>
            <?php if (!empty($category->faqs)) : ?>
                <ul class="condensed">
                    <?php foreach ($category->faqs as $faq) : ?>
                        <li><?= $this->Html->link(h($faq->question), ['controller' => 'Faqs', 'action' => 'view', $faq->id], ['escape' => false]) ?></li>
                    <?php endforeach; ?>
                </ul>

            <?php else: ?>
                <div class="message warning">
                    <?= __('There is no FAQ related to this category.') ?>
                </div>
            <?php endif; ?>

            <h2><?= __('Full guides') ?></h2>
            <?php if (!empty($category->articles)) : ?>
                <ul class="condensed">
                    <?php foreach ($category->articles as $article) : ?>
                        <li><?= $this->Html->link(h($article->title), ['controller' => 'Articles', 'action' => 'view', $article->id], ['escape' => false]) ?></li>
                    <?php endforeach; ?>
                </ul>

            <?php else: ?>
                <div class="message warning">
                    <?= __('There is no article related to this category.') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
