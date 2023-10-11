<div class="sheet-heading">
    <h2><?= __('My Messages') ?></h2>

    <div class="button-small">
        <?= $this->Html->link(__('See All Messages'), ['controller' => 'Users', 'action' => 'seeMessages'], ['class' => 'button float-right']) ?>
    </div>
</div>

<?= $this->Flash->render() ?>

<p><?= __('<strong>{0, plural, =0{You haven’t received any message} =1{You have received one message} other{You have received # messages}} since your last connection.', [$total]) ?></p>
