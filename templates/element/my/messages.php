<div class="sheet-heading">
    <h2><?= __('My Messages') ?></h2>

    <div class="button-small">
        <?= $this->Html->link(__('See All Messages'), ['controller' => 'Users', 'action' => 'seeMessages'], ['class' => 'button float-right']) ?>
    </div>
</div>

<?= $this->Flash->render() ?>

<p><?= __('{0, plural, =0{You haven’t received any message} =1{You have received <strong>one</strong> message} other{You have received <strong>#</strong> messages}} since your last connection.', [$total]) ?></p>
