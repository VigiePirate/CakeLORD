<?php $this->assign('title', __('Hall of Fame')) ?>

<div class="rats view content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('About') ?></div>
    </div>

    <?= $this->Html->link(__('Show me more'), ['action' => 'hallOfFame', $depth+10], ['class' => 'button float-right']) ?>
    <h1><?= __('Hall of Fame') ?></h1>
    <?= $this->Flash->render() ?>

</div>

<div class="spacer"></div>

<div class="row row-responsive">
    <div class="column column-50">
        <div class="rats view content">
            <h2><?= __('Jeanne Calment Award') ?></h2>
            <table class="summary stats">
                <thead>
                    <tr>
                        <th><?= __('Rat') ?></th>
                        <th><?= __('Age') ?></th>
                        <!-- <th><?= __('In Days') ?></th> -->
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($champions as $champion) : ?>
                    <tr>
                        <td><?= $this->Html->link(h($champion->usual_name), ['controller' => 'Rats', 'action' => 'view', $champion->id]) ?></td>
                        <td><?= $champion->champion_age_string ?></td>
                        <!-- <td><?= __dn('cake', '{0} day', '{0} days', $champion->precise_age, $champion->precise_age) ?></td>-->
                    </tr>
                <?php endforeach ; ?>

                </tbody>
            </table>
        </div>
    </div>

    <div class="column column-50">
        <div class="rats view content">
            <h2><?= __('It’s Been 84 Years Award') ?></h2>
            <table class="summary stats">
                <thead>
                    <tr>
                        <th><?= __('Prefix') ?></th>
                        <th><?= __('Name') ?></th>
                        <th><?= __('Active during') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lifetimes as $rattery) : ?>
                    <tr>
                        <td><?= h($rattery['rattery_prefix']) ?></td>
                        <td><?= $this->Html->link(
                            h($rattery['rattery_name']),
                            ['controller' => 'Ratteries', 'action' => 'view', $rattery['rattery_id']],
                            ['escape' => false]
                        )?></td>
                        <td><?= $rattery['lifetime'] ?></td>
                    </tr>
                <?php endforeach ; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="spacer"></div>

<div class="row row-responsive">
    <div class="column column-50">
        <div class="rats view content">
            <h2><?= __('When We Love We Don’t Count Award') ?></h2>

            <table class="summary stats">
                <thead>
                    <tr>
                        <th><?= __('Username') ?></th>
                        <th><?= __('Rats') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $this->Html->link(
                            h($user['user_name']),
                            ['controller' => 'Users', 'action' => 'view', $user['user_id']],
                            ['escape' => false]
                        )?></td>
                        <td><?= __('{0, plural, =0{0 rat} =1{1 rat} other{# rats}}', [$user['count']]) ?></td>
                    </tr>
                <?php endforeach ; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="column column-50">
        <div class="rats view content">
            <h2><?= __('Demographic Rearmement Award') ?></h2>

            <table class="summary stats">
                <thead>
                    <tr>
                        <th><?= __('Prefix') ?></th>
                        <th><?= __('Name') ?></th>
                        <th><?= __('Litters') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($ratteries as $rattery) : ?>
                    <tr>
                        <td><?= h($rattery['rattery_prefix']) ?></td>
                        <td><?= $this->Html->link(
                            h($rattery['rattery_name']),
                            ['controller' => 'Ratteries', 'action' => 'view', $rattery['rattery_id']],
                            ['escape' => false]
                        )?></td>
                        <td><?= __('{0, plural, =0{0 litter} =1{1 litter} other{# litters}}', [$rattery['count']]) ?></td>
                    </tr>
                <?php endforeach ; ?>
                </tbody>
            </table>
        <div>
    </div>
</div>
