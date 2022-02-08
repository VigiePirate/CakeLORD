<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
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
                        'url' => ['controller' => 'Articles', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('All articles')]) ?>
                    <span class="tooltiptext"><?= __('See all articles') ?></span>
                </div>
            </div>
            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => 'Articles',
                    'object' => $article
                    ])
                ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="articles view content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= h($article->category->name) ?></div>
            </div>

            <h1><?= h($article->title) ?></h1>

            <div class="markdown">
                <?= $this->Commonmark->parse($article->content); ?>
            </div>

            <div class="signature">
                &mdash; Created on <?= $article->created->i18nFormat('dd/MM/yyyy') ?><?= ($article->modified != $article->created) ? ', last modified on ' . $article->modified->i18nFormat('dd/MM/yyyy') .'.' : '.' ?>
            </div>

        </div>
    </div>
</div>
