<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
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
                        'url' => ['controller' => 'Categories', 'action' => 'view', $category->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                    <span class="tooltiptext"><?= __('Cancel and go back') ?></span>
                </div>
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-list.svg', [
                        'url' => ['controller' => 'Categories', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('All categories')]) ?>
                    <span class="tooltiptext"><?= __('See all categories') ?></span>
                </div>
            </div>

            <div class="side-nav-group">
                <div class="tooltip-staff">
                    <?= $this->Html->image('/img/icon-delete.svg', [
                        'class' => 'side-nav-icon',
                        'alt' => __('Delete Category')]) ?>
                    <span class="tooltiptext-staff"><?= __('Delete category') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="categories form content">
            <h1><?= __('Edit Category') ?></h1>
            <?= $this->Form->create($category) ?>
            <fieldset>
                <legend></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('position');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
