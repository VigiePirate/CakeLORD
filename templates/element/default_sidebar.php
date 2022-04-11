<div class="tooltip">
    <?= $this->Html->image('/img/icon-report.svg', [
        'url' => ['controller' => 'Conversations', 'action' => 'add'],
        'class' => 'side-nav-icon',
        'alt' => __('Report')]) ?>
    <span class="tooltiptext"><?= __('Report a problem') ?></span>
</div>

<div class="tooltip">
    <?= $this->Html->image('/img/icon-help.svg', [
        'url' => isset($help_url) ? $help_url : ['controller' => 'Faqs', 'action' => 'all'],
        'class' => 'side-nav-icon',
        'alt' => __('Help')]) ?>
    <span class="tooltiptext"><?= __('Get help') ?></span>
</div>
