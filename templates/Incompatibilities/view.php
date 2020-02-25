<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Incompatibility $incompatibility
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Incompatibility'), ['action' => 'edit', $incompatibility->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Incompatibility'), ['action' => 'delete', $incompatibility->id], ['confirm' => __('Are you sure you want to delete # {0}?', $incompatibility->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Incompatibilities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Incompatibility'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="incompatibilities view content">
            <h3><?= h($incompatibility->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Genotype1') ?></th>
                    <td><?= h($incompatibility->genotype1) ?></td>
                </tr>
                <tr>
                    <th><?= __('Genotype2') ?></th>
                    <td><?= h($incompatibility->genotype2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($incompatibility->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comments') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($incompatibility->comments)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
