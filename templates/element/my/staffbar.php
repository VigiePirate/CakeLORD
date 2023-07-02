<div class="side-nav-group">
    <div class="tooltip-staff">
        <?= $this->Html->image('/img/icon-staff-report.svg', [
            'url' => ['controller' => 'Issues', 'action' => 'index'],
            'class' => 'side-nav-icon filter-staff',
            'alt' => __('List all issues')]) ?>
        <span class="tooltiptext-staff"><?= __('See all issues') ?></span>
    </div>

    <div class="tooltip-staff">
        <?= $this->Html->image('/img/icon-staff-help.svg', [
            'url' => isset($help_url) ? $help_url : ['controller' => 'Articles', 'action' => 'index'],
            'class' => 'side-nav-icon',
            'alt' => __('List all articles')]) ?>
        <span class="tooltiptext-staff"><?= __('See all articles') ?></span>
    </div>
</div>

<div class="side-nav-group">
    <div class="tooltip-staff">
        <?= $this->Html->image('/img/icon-staff-user.svg', [
            'url' => ['controller' => 'Users', 'action' => 'index'],
            'class' => 'side-nav-icon',
            'alt' => __('List all users')]) ?>
        <span class="tooltiptext-staff"><?= __('See all users') ?></span>
    </div>

    <div class="tooltip-staff">
        <?= $this->Html->image('/img/icon-staff-rat.svg', [
            'url' => ['controller' => 'Rats', 'action' => 'index'],
            'class' => 'side-nav-icon',
            'alt' => __('List all rats')]) ?>
        <span class="tooltiptext-staff"><?= __('See all rats') ?></span>
    </div>

    <div class="tooltip-staff">
        <?= $this->Html->image('/img/icon-staff-rattery.svg', [
            'url' => ['controller' => 'Ratteries', 'action' => 'index'],
            'class' => 'side-nav-icon',
            'alt' => __('List all ratteries')]) ?>
            <span class="tooltiptext-staff"><?= __('See all ratteries') ?></span>
    </div>

    <div class="tooltip-staff">
        <?= $this->Html->image('/img/icon-staff-litter.svg', [
            'url' => ['controller' => 'Litters', 'action' => 'index'],
            'class' => 'side-nav-icon',
            'alt' => __('List all litters')]) ?>
        <span class="tooltiptext-staff"><?= __('See all litters') ?></span>
    </div>
</div>
<div class="side-nav-group">
    <div class="tooltip">
        <?= $this->Html->image('/img/icon-staff-home.svg', [
            'url' => ['controller' => 'Users', 'action' => 'home'],
            'class' => 'side-nav-icon',
            'alt' => __('My dashboard')]) ?>
        <span class="tooltiptext"><?= __('Dashboard') ?></span>
    </div>
</div>
