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
                'tooltip' => __('See all FAQs'),
                'show_staff' => false
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="faqs form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Frequently asked questions') ?></div>
            </div>
            <h1><?= __('Add an FAQ') ?></h1>
            <?= $this->Form->create($faq) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('category_id', ['options' => $categories]);
                    echo $this->Form->control('question');
                    echo $this->Form->control('answer', [
                        'type'=> 'textarea',
                        'id' => 'answer',
                        'name' => 'answer',
                        'default' => ' ' ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- Easy MDE -->
<?= $this->Html->css('easymde.css') ?>
<?= $this->Html->script('easymde.min.js') ?>
<?= $this->Html->script('easymde-light.js') ?>
