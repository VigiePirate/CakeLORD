<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq $faq
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
                        'url' => ['controller' => 'Faqs', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('All frequently asked questions')]) ?>
                    <span class="tooltiptext"><?= __('See all frequently asked questions') ?></span>
                </div>
            </div>
            <div class="side-nav-group">
                <?= $this->element('staff_sidebar', [
                    'controller' => 'Faqs',
                    'object' => $faq
                    ])
                ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="faqs view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= h($faq->category->name) ?></div>
            </div>

            <h1><?= h($faq->question) ?></h1>
            <h2><?= __('Answer') ?></h2>
            <div class="markdown answer sanitized-md">
                <?= $this->Commonmark->sanitize($faq->answer); ?>
            </div>
        </div>
    </div>
</div>
