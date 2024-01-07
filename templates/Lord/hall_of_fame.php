<?php $this->assign('title', __('Hall of Fame')) ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="rats view content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('About') ?></div>
            </div>

            <h1><?= __('Hall of Fame') ?></h1>

            <h2><?= __('Baby Factory Award') ?></h2>

            <table>
                <tr>
                    <th><?= __('Rattery') ?></th>
                    <th><?= __('Litters') ?></th>
                </tr>
                <?php foreach ($ratteries as $rattery) : ?>
                    <tr>
                        <td><?= $this->Html->link(
                            h($rattery['rattery_prefix']) . ' – ' . h($rattery['rattery_name']),
                            ['controller' => 'Ratteries', 'action' => 'view', $rattery['rattery_id']],
                            ['escape' => false]
                        )?></td>
                        <td><?= __('{0, plural, =0{0 litter} =1{1 litter} other{# litters}}', [$rattery['count']]) ?></td>
                    </tr>
                <?php endforeach ; ?>
            </table>

        </div>
    </div>
</div>
