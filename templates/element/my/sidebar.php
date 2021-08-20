<div class="tooltip">
    <?= $this->Html->image('/img/icon-user.svg', [
        'url' => ['controller' => 'Users', 'action' => 'my'],
        'class' => 'side-nav-icon',
        'alt' => __('My profile')]) ?>
    <span class="tooltiptext"><?= __('Manage my profile') ?></span>
</div>

<div class="tooltip">
    <?= $this->Html->image('/img/icon-rat.svg', [
        'url' => ['controller' => 'Rats', 'action' => 'my'],
        'class' => 'side-nav-icon',
        'alt' => __('My rats')]) ?>
    <span class="tooltiptext"><?= __('Manage my rats') ?></span>
</div>

<div class="tooltip">
    <?= $this->Html->image('/img/icon-rattery.svg', [
        'url' => ['controller' => 'Ratteries', 'action' => 'my'],
        'class' => 'side-nav-icon',
        'alt' => __('My ratteries')]) ?>
        <span class="tooltiptext"><?= __('Manage my ratteries') ?></span>
</div>

<div class="tooltip">
    <?= $this->Html->image('/img/icon-litter.svg', [
        'url' => ['controller' => 'Litters', 'action' => 'my'],
        'class' => 'side-nav-icon',
        'alt' => __('My Litters')]) ?>
    <span class="tooltiptext"><?= __('Manage my litters') ?></span>
</div>


<div class="spacer"> </div>
<div class="tooltip-staff">
    <?= $this->Html->image('/img/icon-backoffice.svg', [
        'url' => ['controller' => 'States', 'action' => 'index'],
        'class' => 'side-nav-icon',
        'alt' => __('Admin site')]) ?>
    <span class="tooltiptext-staff"><?= __('Admin site') ?></span>
</div>
