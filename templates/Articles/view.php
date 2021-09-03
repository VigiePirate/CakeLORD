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
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($article->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subtitle') ?></th>
                    <td><?= h($article->subtitle) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($article->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($article->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($article->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Content') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($article->content)); ?>
                </blockquote>
            </div>

            <div class="signature">
                &mdash; Created on <?= $article->created->i18nFormat('dd/MM/yyyy') ?> <?= ($rat->modified != $rat->created) ? ', ast modified on ' . $rat->modified->i18nFormat('dd/MM/yyyy') .'.' : '.' ?>
            </div>

        </div>
    </div>
</div>
