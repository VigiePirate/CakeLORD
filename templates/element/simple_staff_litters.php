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
                      <td><?= ! empty($litter->litter_messages) ? mb_strimwidth($litter->litter_messages[0]->content, 0, 48, '...') : '' ?></td>
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
