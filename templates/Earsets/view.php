<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Earset $earset
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
            <?= $this->Html->link(__('Edit Earset'), ['action' => 'edit', $earset->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Earset'), ['action' => 'delete', $earset->id], ['confirm' => __('Are you sure you want to delete # {0}?', $earset->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Earsets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Earset'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="earsets view content">
            <div class="row">
            <?php if ($earset->picture != '') : ?> <!-- should become unnecessary: we should have pictures for all varieties -->
                <div class="column-responsive column-66">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('Earset') ?></div>
                    </div>
                    <h1><?= h($earset->name) ?></h1>
                    <h2><?= __('Reference information') ?></h2>
                    <table class="condensed stats">
            <?php else : ?>
                <div class="column-responsive column-100">
                    <div class="sheet-heading">
                        <div class="sheet-title pretitle"><?= __('earset') ?></div>
                    </div>
                    <h1><?= h($earset->name) ?></h1>
                    <table class="condensed">
            <?php endif ?>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($earset->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Genotype') ?></th>
                            <td><?= h($earset->genotype) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Is Picture Mandatory') ?></th>
                            <td><?= $earset->is_picture_mandatory ? __('Yes') : __('No'); ?></td>
                        </tr>
                    </table>
                </div>
                <?php if ($earset->picture != '') : ?>
                    <div class="column footer-center">
                        <?= $this->Html->image('uploads/' . $earset->picture, ['alt' => $earset->name]) ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($earset->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
