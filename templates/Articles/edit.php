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
        <div class="articles form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Articles') ?></div>
            </div>
            <h1><?= __('Edit Article') ?></h1>
            <?= $this->Form->create($article) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('category_id', ['options' => $categories]);
                    echo $this->Form->control('subtitle', ['label' => __('Overtitle')]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('content', [
                        'type' => 'textarea',
                        'id' => 'content',
                        'name' => 'content',
                        'default' => $article->content
                    ]);
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
<?= $this->Html->script('easymde-staff.js') ?>
