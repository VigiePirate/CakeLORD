<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>

<?php $this->assign('title',__('All Articles')) ?>

<div class="articles index content">
<h1><?= __('All Articles') ?></h1>
<section id="sitemap">
    <?php foreach ($categories as $category) : ?>
        <?php if (! empty($category->articles)) : ?>
            <div class="sitemap-category">
                <h2><?= h($category->name) ?></h2>
                <ul class="condensed">
                    <?php foreach ($category->articles as $article) : ?>
                        <li><?= $this->Html->link(h($article->title), ['controller' => 'Articles', 'action' => 'view', $article->id], ['escape' => false]) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif ; ?>
    <?php endforeach ; ?>
</section>

</div>
