<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeathSecondaryCause $deathSecondaryCause
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'DeathSecondaryCauses',
                'object' => $deathSecondaryCause,
                'tooltip' => __('Browse death cause list'),
                'help_url' =>  ['controller' => 'Articles', 'action' => 'index'],
                'show_staff' => $show_staff
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="deathSecondaryCauses view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Death Cause') ?></div>
            </div>
            <h1><?= h($deathSecondaryCause->name) ?></h1>

            <h2><?= __('Reference information') ?></h2>

            <table class="condensed">
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($deathSecondaryCause->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Death Category') ?></th>
                    <td><?= $deathSecondaryCause->has('death_primary_cause') ? $this->Html->link($deathSecondaryCause->death_primary_cause->name, ['controller' => 'DeathPrimaryCauses', 'action' => 'view', $deathSecondaryCause->death_primary_cause->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Tumor') ?></th>
                    <td><?= $deathSecondaryCause->is_tumor ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

            <h2><?= __('Description') ?></h2>
            <div class="text">
                <!-- no h because this might store a few markups, but we do not want md here -->
                <table class="condensed"><tr><td><?= $deathSecondaryCause->description ?></td></tr></table>
            </div>
            <?php if (count($deathSecondaryCause->rats) > 0) : ?>
                <h2><?= __('Related Information') ?></h2>
                <h3><?= __('Statistics') ?></h3>
                <table class="condensed">
                    <tr>
                        <th><?= __('Frequency') ?></th>
                        <td><?= h($frequency) . __(' %') ?> (<?= h($count) ?> rats) </td>
                    </tr>
                    <tr>
                        <th><?= __('Sex ratio') ?></th>
                        <td><?= h($sex_ratio) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Average age') ?></th>
                        <td><?= h($age) . __(' months') ?></td>
                    </tr>
                </table>

                <h3><?= __('Last rat deaths recorded with this cause') ?></h3>
                <?= $this->element('simple_rats', [
                    'rubric' => __(''),
                    'rats' =>  $deathSecondaryCause->rats,
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
