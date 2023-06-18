<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathPrimaryCause $deathPrimaryCause
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'DeathPrimaryCauses',
                'object' => $deathPrimaryCause,
                'tooltip' => __('Browse death category list'),
                'help_url' => ['controller' => 'Articles', 'action' => 'view', 20],
                'show_staff' => $show_staff
            ])
        ?>
    </aside>

    <div class="column-responsive column-90">
        <div class="deathPrimaryCauses view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Death category') ?></div>
            </div>
            <h1><?= h($deathPrimaryCause->name) ?></h1>

            <h2><?= __('Reference information') ?></h2>

            <table class="condensed">
                <tr>
                    <th><?= __('Identification code') ?></th>
                    <td><?= $this->Number->format($deathPrimaryCause->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Happens only to infant rats?') ?></th>
                    <td><?= $deathPrimaryCause->is_infant ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Accidental cause?') ?></th>
                    <td><?= $deathPrimaryCause->is_accident ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Happens only to elderly rats?') ?></th>
                    <td><?= $deathPrimaryCause->is_oldster ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

            <h2><?= __('Description') ?></h2>
            <div class="text">
                <!-- no h because this might store a few markups, but we do not want md here -->
                <table class="condensed"><tr><td><?= $deathPrimaryCause->description ?></td></tr></table>
            </div>

            <h2><?= __('Related Information') ?>
            <?php if (!empty($deathPrimaryCause->death_secondary_causes)) : ?>
            <h3><?= __('Related Death Causes') ?></h3>
            <div class="table-responsive">
                <table class="summary">
                    <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Tumor?') ?></th>
                            <th class="actions-icon col-head"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <?php foreach ($deathPrimaryCause->death_secondary_causes as $deathSecondaryCause) : ?>
                    <tr>
                        <td><?= h($deathSecondaryCause->id) ?></td>
                        <td><?= $this->Html->link(h($deathSecondaryCause->name), ['controller' => 'DeathSecondaryCauses', 'action' => 'view', $deathSecondaryCause->id]) ?></td>
                        <td><?= $deathSecondaryCause->is_tumor ? '✓' : '' ?></td>
                        <td class="actions">
                            <?= $this->Html->image('/img/icon-edit-as-staff-mini.svg', [
                                'url' => ['controller' => 'DeathSecondaryCauses', 'action' => 'edit', $deathSecondaryCause->id],
                                'class' => 'action-icon',
                                'alt' => __('Edit Death Cause')]) ?>
                            <?= $this->Form->postLink(
                                    $this->Html->image('/img/icon-delete.svg', [
                                        'class' => 'action-icon',
                                        'alt' => __('Delete Death Cause')
                                    ]),
                                    ['action' => 'delete', $deathSecondaryCause->id],
                                    ['confirm' => __('Are you sure you want to delete country # {0}?', $deathSecondaryCause->id), 'escape' => false]
                                )
                            ?>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                </table>
            </div>
            <?php endif; ?>

            <h3><?= __('Statistics') ?></h3>
            <table class="condensed">
                <tr>
                    <th><?= __('Frequency') ?></th>
                    <td><?= __('{0, number} % ({1, plural, =0{no rat} =1{1 rat} other{# rats}})',  [$frequency, $count]) ?> </td>
                </tr>
                <tr>
                    <th><?= __('Sex ratio') ?></th>
                    <td><?= h($sex_ratio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Average age') ?></th>
                    <td><?= __('{0, plural, =1{1 month} other{# months}}', [$age]) ?></td>
                </tr>
            </table>

            <h3><?= __('Last rat deaths recorded in this category') ?></h3>
            <?php if (count($deathPrimaryCause->rats) > 0) : ?>
                <?= $this->element('simple_rats', [
                    'rubric' => __(''),
                    'rats' =>  $deathPrimaryCause->rats,
                    'exceptions' => [
                        'picture',
                        'owner_user_id',
                        'death_primary_cause',
                        'death_secondary_cause',
                        'death_cause',
                        'actions'
                    ],
                ]) ?>
            <?php else : ?>
                <div class="message"><?= __('No rat was recorded as dead from this cause.') ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
