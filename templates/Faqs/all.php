<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq[]|\Cake\Collection\CollectionInterface $faqs
 */
?>
<div class="faqs index content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Guides') ?></div>
    </div>
    <h1><?= __('Frequently Asked Questions') ?></h1>
    <div class="message">
        <?= __('Please click on a question to reveal the answer. For further help, you can also read our full guides or join us on the support forum.') ?>
    </div>
    <?php foreach ($categories as $category): ?>
        <?php if (! empty($category->faqs)) : ?>
            <h2><?= $category->name ?></h2>
            <?php foreach ($category->faqs as $faq): ?>
                <details>
                    <summary><?= $faq->question ?></summary>
                    <div class="markdown answer sanitized-md">
                        <?= $this->Commonmark->sanitize($faq->answer); ?>
                    </div>
                </details>
            <?php endforeach; ?>
            <div class="spacer"></div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
