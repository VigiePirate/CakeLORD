<table class="summary">
    <thead>
        <tr>
          <th><?= $this->Paginator->sort('state_id', __('State')) ?></th>
          <th><?= $this->Paginator->sort('birth_date', __('Birth date')) ?></th>
          <th><?= __('Prefix') ?></th>
          <th><?= __('Litter') ?></th>
          <th><?= $this->Paginator->sort('Users.username', __('Creator')) ?></th>
          <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
          <th class="col-head"><?= __('Last message') ?></th>
          <th class="actions col-head"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($litters as $litter): ?>
        <tr>
          <td><span class="statecolor_<?php echo h($litter->state_id) ?>"><?= h($litter->state->symbol) ?></span></td>
          <td><?= $litter->birth_date->i18nFormat('dd/MM/yyyy') ?></td>
          <td><?= $litter->contributions[0]->rattery->prefix ?><?= !empty($litter->contributions[1]) ? ('-' . $litter->contributions[1]->rattery->prefix) : '' ?></td>
          <td><?= $this->Html->link(h($litter->parents_name), ['action' => 'view', $litter->id], ['escape' => false]) ?></td>
          <td><?= $litter->has('user') ? $this->Html->link($litter->user->username, ['controller' => 'Users', 'action' => 'view', $litter->user->id]) : '' ?></td>
          <td><?= $litter->modified->i18nFormat('dd/MM/yyyy') ?></td>
          <td><?= ! empty($litter->litter_messages) ? mb_strimwidth($litter->litter_messages[0]->content, 0, 64, '...') : '' ?></td>
          <td class="actions">
              <span class="nowrap">
                  <?= $this->Form->postLink(
                          $this->Html->image('/img/icon-delete.svg', [
                              'class' => 'action-icon',
                              'alt' => __('Delete Litter')
                          ]),
                          ['action' => 'delete', $litter->id],
                          ['confirm' => __('Are you sure you want to delete litter # {0}?', $litter->id), 'escape' => false]
                      )
                  ?>
              </span>
          </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

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
