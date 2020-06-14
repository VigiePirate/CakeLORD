<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathPrimaryCause $deathPrimaryCause
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->image('/img/icon-fa-alert.svg', [
          'url' => ['controller' => 'Conversations', 'action' => 'add'],
          'class' => 'side-nav-icon',
          'alt' => __('Report')]) ?>
      <?= $this->Html->image('/img/icon-help.svg', [
              'url' => ['controller' => 'Articles', 'action' => 'index'],
              'class' => 'side-nav-icon',
              'alt' => __('Help')]) ?>
            <?= $this->Html->link(__('Edit Death Primary Cause'), ['action' => 'edit', $deathPrimaryCause->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Death Primary Cause'), ['action' => 'delete', $deathPrimaryCause->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deathPrimaryCause->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Death Primary Causes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Death Primary Cause'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="deathPrimaryCauses view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Death Primary Cause') ?></div>
            </div>
            <h1><?= h($deathPrimaryCause->name) ?></h1>
            <h2><? __('Information') ?></h2>
            <table class="condensed">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($deathPrimaryCause->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= $this->Number->format($deathPrimaryCause->id) ?></td>
                </tr>
            </table>
            <h2><?= __('Description') ?></h2>
            <div class="text">
                <blockquote>
                    <?= $this->Text->autoParagraph(h($deathPrimaryCause->description)); ?>
                </blockquote>
            </div>
            <div class="spacer"> </div>
            <h2><?= __('Related information') ?></h2>
            <div class="related">
                <h3><?= __('Related Death Secondary Causes') ?></h3>
                <?php if (!empty($deathPrimaryCause->death_secondary_causes)) : ?>
                <div class="table-responsive summary">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($deathPrimaryCause->death_secondary_causes as $deathSecondaryCauses) : ?>
                        <tr>
                            <td><?= h($deathSecondaryCauses->id) ?></td>
                            <td><?= h($deathSecondaryCauses->name) ?></td>
                            <td><?= h($deathSecondaryCauses->description) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'DeathSecondaryCauses', 'action' => 'view', $deathSecondaryCauses->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'DeathSecondaryCauses', 'action' => 'edit', $deathSecondaryCauses->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'DeathSecondaryCauses', 'action' => 'delete', $deathSecondaryCauses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deathSecondaryCauses->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h3><?= __('Statistics') ?></h3>
            </div>
        </div>
    </div>
</div>
