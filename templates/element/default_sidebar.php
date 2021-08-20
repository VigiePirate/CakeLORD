<div class="tooltip">
    <?= $this->Html->image('/img/icon-report.svg', [
        'url' => ['controller' => 'Conversations', 'action' => 'add'],
        'class' => 'side-nav-icon',
        'alt' => __('Report')]) ?>
    <span class="tooltiptext"><?= __('Report a problem') ?></span>
</div>

<div class="tooltip">
    <?= $this->Html->image('/img/icon-help.svg', [
        'url' => ['controller' => 'Articles', 'action' => 'index'],
        'class' => 'side-nav-icon',
        'alt' => __('Help')]) ?>
    <span class="tooltiptext"><?= __('Get help') ?></span>
</div>

<div class="tooltip">
    <?= $this->Html->image('/img/icon-add-rat.svg', [
        'url' => ['controller' => 'Rats', 'action' => 'add'],
        'class' => 'side-nav-icon',
        'alt' => __('Help')]) ?>
    <span class="tooltiptext"><?= __('Add a rat') ?></span>
</div>

<div class="tooltip">
    <?= $this->Html->image('/img/icon-litter.svg', [
        'url' => ['controller' => 'Litters', 'action' => 'index'],
        'class' => 'side-nav-icon',
        'alt' => __('Help')]) ?>
    <span class="tooltiptext"><?= __('Browse litters') ?></span>
</div>

<div class="tooltip">
    <?= $this->Html->image('/img/icon-add-litter.svg', [
        'url' => ['controller' => 'Litters', 'action' => 'add'],
        'class' => 'side-nav-icon',
        'alt' => __('Help')]) ?>
    <span class="tooltiptext tooltiptext-staff"><?= __('Add a rat') ?></span>
</div>
