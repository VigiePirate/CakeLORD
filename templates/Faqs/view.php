<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq $faq
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'Faqs',
                'object' => $faq,
                'tooltip' => __('Browse documentation category list'),
                'show_staff' => true,
                'user' => $user
            ])
        ?>
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
