
<?= $this->Html->image('/img/icon-profile.svg', [
    'url' => ['controller' => 'Users', 'action' => 'my'],
    'class' => 'side-nav-icon',
    'alt' => __('My profile')]) ?>

<div class="spacer"> </div>

<?= $this->Html->image('/img/icon-three-rats.svg', [
    'url' => ['controller' => 'Rats', 'action' => 'my'],
    'class' => 'side-nav-icon',
    'alt' => __('All my rats')]) ?>

<?= $this->Html->image('/img/icon-search-females.svg', [
    'url' => ['controller' => 'Rats', 'action' => 'my'],
    'class' => 'side-nav-icon',
    'alt' => __('My females')]) ?>

<?= $this->Html->image('/img/icon-search-males.svg', [
    'url' => ['controller' => 'Rats', 'action' => 'my'],
    'class' => 'side-nav-icon',
    'alt' => __('My males')]) ?>

<?= $this->Html->image('/img/icon-search-deceased.svg', [
    'url' => ['controller' => 'Rats', 'action' => 'my'],
    'class' => 'side-nav-icon',
    'alt' => __('My deceased')]) ?>

<div class="spacer"> </div>

<?= $this->Html->image('/img/icon-rattery.svg', [
    'url' => ['controller' => 'Ratteries', 'action' => 'my'],
    'class' => 'side-nav-icon',
    'alt' => __('My ratteries')]) ?>

<div class="spacer"> </div>

<?= $this->Html->image('/img/icon-fa-baby.svg', [
    'url' => ['controller' => 'Litters', 'action' => 'my'],
    'class' => 'side-nav-icon',
    'alt' => __('My Litters')]) ?>

<div class="spacer"> </div>

<?= $this->Html->image('/img/icon-backoffice.svg', [
    'url' => ['controller' => 'Litters', 'action' => 'my'],
    'class' => 'side-nav-icon',
    'alt' => __('Admin site')]) ?>
