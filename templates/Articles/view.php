<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'Articles',
                'object' => $article,
                'tooltip' => __('Browse article list'),
                'show_staff' => true,
                'user' => $user
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="articles view content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= h($article->subtitle) ?></div>
            </div>

            <h1><?= h($article->title) ?></h1>

            <div class="markdown">
                    <?= $this->Commonmark->parse($article->content); ?>
            </div>

            <div class="signature">
                &mdash; <?= __('Created on ') ?><?= $article->created->i18nFormat('dd/MM/yyyy') ?><?= ($article->modified != $article->created) ? __(', last modified on ') . $article->modified->i18nFormat('dd/MM/yyyy') . '.' : '.' ?>
            </div>

        </div>
    </div>
</div>
