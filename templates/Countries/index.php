<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Country[]|\Cake\Collection\CollectionInterface $countries
 */
?>
<div class="countries index content">
    <?= $this->Html->link(__('New Country'), ['action' => 'add'], ['class' => 'button button-staff float-right']) ?>
    <h1><?= __('All Available Countries') ?></h1>
    <div class="table-responsive">
        <table class="condensed">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('iso3166') ?></th>
                    <th class="actions col-head"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($countries as $country): ?>
                <tr>
                    <td><?= $this->Number->format($country->id) ?></td>
                    <td><?= $this->Html->link(h($country->name), ['action' => 'view', $country->id]) ?></td>
                    <td><?= h($country->iso3166) ?></td>
                    <td class="actions">
                        <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                            'url' => ['controller' => 'Country', 'action' => 'edit', $country->id],
                            'class' => 'action-icon',
                            'alt' => __('Edit Country')
                        ])?>
                        <?= $this->Form->postLink(
                                $this->Html->image('/img/icon-delete.svg', [
                                    'class' => 'action-icon',
                                    'alt' => __('Delete Country')
                                ]),
                                ['action' => 'delete', $country->id],
                                ['confirm' => __('Are you sure you want to delete country # {0}?', $country->id), 'escape' => false]
                            )
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
