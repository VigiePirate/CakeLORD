<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat[]|\Cake\Collection\CollectionInterface $rats
 */
?>

<?php $this->assign('title', __('Advanced search')) ?>

<div class="lord index content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Search Results') ?></div>
    </div>
    <h1><?= __('Your search: ') . __('“{0}”', [h(implode('"', $names))]) ?></h1>

    <?php if (($count['rats'] + $count['ratteries'] + $count['users']) == 0) : ?>
        <div class="message error"><?= __('Sorry, we haven’t found any rat, rattery or user resembling your keyword. Please try with another.') ?></div>
    <?php else: ?>
        <?php if ($count['rats'] > 10 || $count['ratteries'] > 10 || $count['users'] > 10) : ?>
            <div class="message warning">
                <?= __(
                    'We have found {0, plural, =0{<b>0 rat</b>} =1{<b>1 rat</b>} other{<b># rats</b>}}, {1, plural, =0{<b>0 rattery</b>} =1{<b>1 rattery</b>} other{<b># ratteries</b>}} and {2, plural, =0{<b>0 user</b>} =1{<b>1 user</b>} other{<b># users</b>}} resembling your keyword. Up to the 10 most recently modified of each category are shown below (you can use side buttons to see browse all the other results). Please retry with a more specific keyword to reduce the number of results.',
                    [$count['rats'], $count['ratteries'], $count['users']]
                )?>
            </div>
        <?php else : ?>
            <div class="message success">
                <?= __(
                    'We have found {0, plural, =0{<b>0 rat</b>} =1{<b>1 rat</b>} other{<b># rats</b>}}, {1, plural, =0{<b>0 rattery</b>} =1{<b>1 rattery</b>} other{<b># ratteries</b>}} and {2, plural, =0{<b>0 user</b>} =1{<b>1 user</b>} other{<b># users</b>}} resembling your keyword. They are all shown below.',
                    [$count['rats'], $count['ratteries'], $count['users']]
                )?>
            </div>
        <?php endif ; ?>
    <?php endif ; ?>
</div>
<div class="spacer"> </div>

<?php if ($count['rats'] > 0) : ?>
    <div class="lord index content">

        <div class="sheet-heading">
            <h2><?= __('Rats') ?></h2>
            <div class="button-medium">
                <?= $this->Html->link(__('Advanced search'), ['controller' => 'Rats', 'action' => 'search'], ['class' => 'button float-right']) ?>
                <?= $count['rats'] > 10 ? $this->Html->link(__('See all results'), ['controller' => 'Rats', 'action' => 'named', h(implode('"', $names))], ['class' => 'button float-right']) : '' ?>
            </div>
        </div>

        <?= $this->element('simple_rats', [ //rats
            'rubric' => __(''),
            'rats' =>  $rats,
            'exceptions' => [
                'picture',
                'age_string',
                'death_cause',
                'actions'
            ],
        ]) ?>
    </div>
<?php endif; ?>
<?php if ($count['ratteries'] > 0) : ?>
    <div class="spacer"> </div>
    <div class="lord index content">

        <div class="sheet-heading">
            <h2><?= __('Ratteries') ?></h2>
            <div class="button-medium">
                <?= $count['ratteries'] > 10
                    ? $this->Html->link(__('See all results'), ['controller' => 'Ratteries', 'action' => 'named', h(implode('"', $names))], ['class' => 'button float-right'])
                    : ''
                ?>
            </div>
        </div>

        <?= $this->element('simple_ratteries', [ //rats
            'rubric' => __(''),
            'exceptions' => [
                'picture',
                'actions',
            ],
        ]) ?>
    </div>
<?php endif; ?>
<?php if ($count['users'] > 0) : ?>
    <div class="spacer"> </div>
    <div class="lord index content">
        <div class="sheet-heading">
            <h2><?= __('Users') ?></h2>
            <div class="button-medium">
                <?= $count['users'] > 10 ? $this->Html->link(__('See all results'), ['controller' => 'Users', 'action' => 'named', h(implode('"', $names))], ['class' => 'button float-right']) : '' ?>
            </div>
        </div>

        <div class="table-responsive">
            <table class="summary">
                <thead>
                    <tr>
                        <th><?= __('Username') ?></th>
                        <th><?= __('Rattery') ?></th>
                        <th><?= __('Localization') ?></th>
                        <th><?= __('Role') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $this->Html->link($user->username, ['controller' => 'Users', 'action' => 'view', $user->id]) ?></td>
                        <td><?= h($user->main_rattery_name) ?></td>
                        <td><?= h($user->localization) ?></td>
                        <td><?= h($user->role->name) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
