<div class="side-nav-group">
    <?= $this->element('default_sidebar', ['help_url' => $help_url]) ?>
</div>

<div class="side-nav-group">
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
            'url' => ['controller' => 'Litters', 'action' => 'my', '?sort=birth_date&direction=desc'],
            'class' => 'side-nav-icon',
            'alt' => __('My Litters')]) ?>
        <span class="tooltiptext"><?= __('Manage my litters') ?></span>
    </div>
</div>

<?php if ($user->is_staff) :?>
    <div class="side-nav-group">
        <div class="tooltip-staff">
            <?= $this->Html->image('/img/icon-backoffice.svg', [
                'url' => ['controller' => 'Lord', 'action' => 'my'],
                'class' => 'side-nav-icon',
                'alt' => __('Admin site')]) ?>
            <span class="tooltiptext-staff"><?= __('Admin site') ?></span>
        </div>
    </div>
<?php endif ; ?>
