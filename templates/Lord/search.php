<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rat[]|\Cake\Collection\CollectionInterface $rats
 */
?>

<div class="lord index content">
    <div class="sheet-heading">
        <div class="sheet-title pretitle"><?= __('Search Results') ?></div>
    </div>
    <h1><?= __('Your search:') . ' ' . __('« ') . h(implode('"', $names)) . __(' »')?></h1> <!-- should be “ ” in English -->

    <?php if (($count['rats'] + $count['ratteries'] + $count['users']) == 0) : ?>
        <div class="message error"><?= __('Sorry, we haven’t found any rat, rattery or user resembling your keyword. Please try with another.') ?></div>
    <?php else: ?>
        <?php if ($count['rats'] > 10 || $count['ratteries'] > 10 || $count['users'] > 10) : ?>
            <div class="message warning">
                <?= __('We have found {0} rats, {1} ratteries and {2} users resembling your keyword. Up to the 10 most recently modified of each category are shown below. Please retry with a more specific keyword, or use side buttons below to see browse all the results in each category.', ['<b>'.h($count['rats']).'</b>', '<b>'.h($count['ratteries']).'</b>', '<b>'.h($count['users']).'</b>']) ?>
            </div>
        <?php else : ?>
            <div class="message success">
                <?= __('We have found {0} rats, {1} ratteries and {2} users resembling your keyword. They are all shown below.', ['<b>'.h($count['rats']).'</b>', '<b>'.h($count['ratteries']).'</b>', '<b>'.h($count['users']).'</b>']) ?>
            </div>
        <?php endif ; ?>
    <?php endif ; ?>
</div>
<div class="spacer"> </div>

<?php if ($count['rats'] > 0) : ?>
    <div class="lord index content">
        <div class="row">
            <div class="column-responsive column-33">
                <h2><?= __('Rats') ?></h2>
            </div>
            <div class="column-responsive column-66">
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
        <div class="row">
            <div class="column-responsive column-33">
                <h2><?= __('Ratteries') ?></h2>
            </div>
            <div class="column-responsive column-66">
                <?= $count['ratteries'] > 10 ? $this->Html->link(__('See all results'), ['controller' => 'Ratteries', 'action' => 'named', h(implode('"', $names))], ['class' => 'button float-right']) : '' ?>
            </div>
        </div>

        <?= $this->element('simple_ratteries', [ //rats
            'rubric' => __(''),
            'exceptions' => [
                'picture',
                'actions'
            ],
        ]) ?>
    </div>
<?php endif; ?>
<?php if ($count['users'] > 0) : ?>
    <div class="spacer"> </div>
    <div class="lord index content">
        <div class="row">
            <div class="column-responsive column-33">
                <h2><?= __('Users') ?></h2>
            </div>
            <div class="column-responsive column-66">
                <?= $count['users'] > 10 ? $this->Html->link(__('See all results'), ['controller' => 'Users', 'action' => 'named', h(implode('"', $names))], ['class' => 'button float-right']) : '' ?>
            </div>
        </div>

        <div class="table-responsive">
            <table class="summary">
                <thead>
                    <tr>
                        <th><?= __('State') ?></th>
                        <th><?= __('Username') ?></th>
                        <th><?= __('Rattery') ?></th>
                        <th><?= __('Localization') ?></th>
                        <th><?= __('Role') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><b><?= h($user->locked_symbol) ?></b></td>
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
