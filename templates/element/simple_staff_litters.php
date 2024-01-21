<?php if ($litters->count()) : ?>
    <div class="table-responsive">
        <table class="summary">
          <thead>
              <tr>
                  <th><?= __('State') ?></th>
                  <th><?= __('Litter') ?></th>
                  <th><?= __('Creator') ?></th>
                  <th><?= __('Modified') ?></th>
                  <th><?= __('Last message') ?></th>
                  <th class="actions"><?= __('Actions') ?></th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($litters as $litter): ?>
              <tr>
                  <td><span class="statecolor_<?php echo h($litter->state_id) ?>"><?= h($litter->state->symbol) ?></span></td>
                  <td><?= $this->Html->link($litter->full_name, ['controller' => 'Litters', 'action' => 'view', $litter->id]) ?></td>
                  <td><?= $litter->has('user') ? $this->Html->link($litter->user->username, ['controller' => 'Users', 'action' => 'view', $litter->user->id]) : '' ?></td>
                  <td><?= $litter->modified->i18nFormat('dd/MM/yyyy') ?></td>
                  <td class="ellipsis" onclick="toggleMessage(this)"><?= ! empty($litter->litter_messages) ? h($litter->litter_messages[0]->content) : '' ?></td>
                  <td class="actions">
                      <span class="nowrap">
                          <?php if (! is_null($litter->last_snapshot_id)) :?>
                              <?= $this->Html->image('/img/icon-diff.svg', [
                                  'url' => ['controller' => 'LitterSnapshots', 'action' => 'diff', $litter->last_snapshot_id],
                                  'class' => 'action-icon',
                                  'alt' => __('Diff')])
                              ?>
                          <?php endif; ?>
                          <?php if (! is_null($identity) && $identity->can('delete', $litter)) : ?>
                              <?= $this->Html->image('/img/icon-delete.svg', [
                                  'url' => ['controller' => 'Litters', 'action' => 'delete', $litter->id],
                                  'class' => 'action-icon',
                                  'alt' => __('Delete Litter')
                              ])?>
                          <?php else :?>
                              <span class="disabled">
                                  <?= $this->Html->image('/img/icon-delete.svg', [
                                      'url' => '',
                                      'class' => 'action-icon disabled',
                                      'alt' => __('Delete Litter')])
                                  ?>
                              </span>
                          <?php endif ;?>
                      </span>
                  </td>
              </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
    </div>
<?php endif ; ?>
