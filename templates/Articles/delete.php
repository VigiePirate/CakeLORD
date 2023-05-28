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
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'Articles', 'action' => 'view', $article->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Cancel')]) ?>
                    <span class="tooltiptext"><?= __('Cancel and go back to article') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="articles view content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Articles') ?></div>
            </div>

            <h1><?= __x('article', 'Delete “{0}”', [h($article->title)]) ?></h1>

            <details>
                <summary>
                    <?= __('Review article contents before suppression') ?>
                </summary>

                <table class="review">
                    <tr>
                        <th><?= __('Category') ?></th>
                        <td><?= h($article->category->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Overtitle') ?></th>
                        <td><?= h($article->subtitle) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Title') ?></th>
                        <td><?= h($article->title) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created') ?></th>
                        <td><?= $article->created->i18nFormat('dd/MM/yyyy') ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Modified') ?></th>
                        <td><?= $article->modified->i18nFormat('dd/MM/yyyy') ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Contents') ?></th>
                        <td><?= $this->Commonmark->parse($article->content); ?></td>
                    </tr>
                </table>
            </details>
            <?= $this->Form->create($article) ?>
            <?= $this->Form->button(__('Confirm suppression')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
