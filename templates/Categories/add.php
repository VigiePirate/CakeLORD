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
                    <?= $this->Html->image('/img/icon-list.svg', [
                        'url' => ['controller' => 'Categories', 'action' => 'index'],
                        'class' => 'side-nav-icon',
                        'alt' => __('All categories')]) ?>
                    <span class="tooltiptext"><?= __('See all categories') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="categories form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Categories') ?></div>
            </div>
            <h1><?= __('Add Category') ?></h1>
            <?= $this->Form->create($category) ?>
            <fieldset>

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
