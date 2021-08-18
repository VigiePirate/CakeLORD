<div class="side-nav">
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
</div>
