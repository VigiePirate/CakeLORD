<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<div class="content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Contact') ?></div>
    </div>
    <h1><?= __('Message follow-up') ?></h1>

    <div class="message success">
        <?= __('Your email was sent to the LORD shared mailbox. Your request be processed next time a staff member will check it. Thank you for your patience.');?>
    </div>

    <p class="helper"><?= __('Here is the message you sent. A carbon copy was sent to your address.') ?></p>

    <div class="text message-text">
        <blockquote>
            <?= h($message); ?>
        </blockquote>
    </div>

    <div class="helper">
        <?=
        __('We remind you that you can also seek help in our <a href="{0}">FAQ</a> or on our <a href="{1}">support forum</a>.',
        [\Cake\Routing\Router::Url(['controller' => 'Faqs', 'action' => 'all']), 'https://www.srfa.info/forums/229-lord'],
        ['escape' => false]
        )
        ?>
    </div>

    <div class="message-button">
            <?= $this->Html->link(__('Back to Home'), '/', ['class' => 'button']) ?>
    </div>
</div>
