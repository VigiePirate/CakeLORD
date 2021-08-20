
<?= $this->Html->image('/img/icon-user.svg', [
    'url' => ['controller' => 'Users', 'action' => 'my'],
    'class' => 'side-nav-icon',
    'alt' => __('My profile')]) ?>

<?= $this->Html->image('/img/icon-rat.svg', [
    'url' => ['controller' => 'Rats', 'action' => 'my'],
    'class' => 'side-nav-icon',
    'alt' => __('My rats')]) ?>

<?= $this->Html->image('/img/icon-rattery.svg', [
    'url' => ['controller' => 'Ratteries', 'action' => 'my'],
    'class' => 'side-nav-icon',
    'alt' => __('My ratteries')]) ?>


<?= $this->Html->image('/img/icon-fa-baby.svg', [
    'url' => ['controller' => 'Litters', 'action' => 'my'],
    'class' => 'side-nav-icon',
    'alt' => __('My Litters')]) ?>

<div class="spacer"> </div>

<?= $this->Html->image('/img/icon-backoffice.svg', [
    'url' => ['controller' => 'Users', 'action' => 'myBackOffice'],
    'class' => 'side-nav-icon',
    'alt' => __('Admin site')]) ?>
