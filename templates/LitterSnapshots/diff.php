<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Litter $litter
 */
?>
<div class="row">
    <div class="column-responsive column-50">
        <div class="litters view content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= _('Snapshot') ?></div>
                <?php if (in_array('state_id', $diff_list)) : ?>
                    <div class="minus current-statemark statecolor_<?php echo h($snapshot->state_id) ?>"><?= h($snapshot->state->symbol) ?></div>
                <?php else : ?>
                    <div class="current-statemark statecolor_<?php echo h($snapshot->state_id) ?>"><?= h($snapshot->state->symbol) ?></div>
                <?php endif ; ?>
            </div>

            <h1>
                <?= __('Litter #{0}', [$litter->id]) ?>
            </h1>

            <h2><?= __('Parents') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Dam') ?></th>
                    <?php if ($snap_litter->dam[0]->id != $litter->dam[0]->id) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                        <?= h($snap_litter->dam[0]->usual_name) ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Sire') ?></th>
                    <?php if ($snap_litter->has('sire') && ! empty($snap_litter->sire)) : ?>
                        <?php if ($snap_litter->sire[0]->id != $litter->sire[0]->id) : ?>
                            <td class="minus">
                        <?php else : ?>
                            <td>
                        <?php endif ; ?>
                            <?=
                                $snap_litter->has('sire')
                                ? $snap_litter->sire[0]->usual_name
                                : __x('father', 'Unknown or unregistered')
                            ?>
                        </td>
                    <?php endif ; ?>
                </tr>
            </table>

            <h2><?= __('Litter summary') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Mating date') ?></th>
                    <?php if (in_array('mating_date', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                        <?= isset($snap_litter->mating_date) ? h($snap_litter->mating_date->i18nFormat('dd/MM/yyyy')) : __x('date', 'Unknown') ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Birth date') ?></th>
                    <?php if (in_array('birth_date', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                        <?= isset($snap_litter->birth_date) ? h($snap_litter->birth_date->i18nFormat('dd/MM/yyyy')) : __x('date', 'Unknown') ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Pups number') ?></th>
                    <?php if (in_array('pups_number', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                        <?= __('{0, plural, =0{No pup} =1{1 pup} other{# pups}}', [$snap_litter->pups_number]) ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __x('short', 'Stillborn pups') ?></th>
                    <?php if (in_array('pups_number_stillborn', $diff_list)) : ?>
                        <td class="minus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                        <?= __('{0, plural, =0{No stillborn pup} =1{1 stillborn pup} other{# stillborn pups}}', [$snap_litter->pups_number_stillborn]) ?>
                    </td>
                </tr>
            </table>

            <h2><?= __('Ratteries') ?></h2>
            <?php if (! empty($snap_litter->contributions)) : ?>
                <div class="table-responsive">
                    <table class="condensed stats">
                        <?php foreach ($types as $type) : ?>
                            <?php if (in_array($type->id, array_keys($snap_ratteries)) || in_array($type->id, array_keys($litter_ratteries))) : ?>
                                <tr>
                                    <th>
                                    <?php
                                        $name = $type->name;
                                        echo strpos($name, "(") ? substr($name, 0, strpos($name, "(")) : $name;
                                    ?>
                                </th>
                                <?php if (
                                    ! isset($snap_ratteries[$type->id])
                                    || ! isset($litter_ratteries[$type->id])
                                    || $snap_ratteries[$type->id]->id != $litter_ratteries[$type->id]->id
                                    ) :
                                ?>
                                    <td class="minus">
                                <?php else : ?>
                                    <td>
                                <?php endif ; ?>
                                    <?=
                                        isset($snap_ratteries[$type->id])
                                        ? $this->Html->link(
                                            h($snap_ratteries[$type->id]->full_name),
                                            ['controller' => 'Ratteries', 'action' => 'view', $snap_ratteries[$type->id]->id],
                                            ['escape' => false]
                                            )
                                        : ''
                                    ?>
                                </td>
                            </tr>
                            <?php endif ; ?>
                        <?php endforeach ;?>
                    </table>
                </div>
            <?php endif; ?>

            <h2><?= __('Comments') ?></h2>
            <?php if (in_array('comments', $diff_list)) : ?>
                <div class="text minus">
                    <blockquote>
                        <div class="markdown">
                            <?= $this->Commonmark->sanitize($snap_litter->comments); ?>
                        </div>
                    </blockquote>
                </div>
            <?php else : ?>
                <div class="text">
                    <blockquote>
                        <div class="markdown">
                            <?= $this->Commonmark->sanitize($litter->comments); ?>
                        </div>
                    </blockquote>
                </div>
            <?php endif ; ?>

        </div>
    </div>

    <div class="column-responsive column-50">
        <div class="litters view content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Litter') ?></div>
                <?php if (in_array('state_id', $diff_list)) : ?>
                    <div class="plus current-statemark statecolor_<?php echo h($litter->state_id) ?>"><?= h($litter->state->symbol) ?></div>
                <?php else : ?>
                    <div class="current-statemark statecolor_<?php echo h($litter->state_id) ?>"><?= h($litter->state->symbol) ?></div>
                <?php endif ; ?>
            </div>

            <h1 class="link-title">
                <?= $this->Html->link(__('Litter #{0}', [$litter->id]), ['controller' => 'Litters', 'action' => 'view', $litter->id]) ?>
            </h1>

            <h2><?= __('Parents') ?></h2>
            <table class="condensed stats">
                <tr>
                    <th><?= __('Dam') ?></th>
                    <?php if ($snap_litter->dam[0]->id != $litter->dam[0]->id) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                        <?= h($litter->dam[0]->usual_name) ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Sire') ?></th>
                    <?php if ($litter->has('sire') && ! empty($litter->sire)) : ?>
                        <?php if ($snap_litter->sire[0]->id != $litter->sire[0]->id) : ?>
                            <td class="plus">
                        <?php else : ?>
                            <td>
                        <?php endif ; ?>
                            <?=
                                $litter->has('sire')
                                ? $litter->sire[0]->usual_name
                                : __x('father', 'Unknown or unregistered')
                            ?>
                        </td>
                    <?php endif ; ?>
                </tr>
            </table>

            <h2><?= __('Litter summary') ?></h2>
            <table class="condensed stats">

                <tr>
                    <th><?= __('Mating date') ?></th>
                    <?php if (in_array('mating_date', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                        <?= isset($litter->mating_date) ? h($litter->mating_date->i18nFormat('dd/MM/yyyy')) : __x('date', 'Unknown') ?>
                    </td></tr>
                <tr>
                    <th><?= __('Birth date') ?></th>
                    <?php if (in_array('birth_date', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                        <?= isset($litter->birth_date) ? h($litter->birth_date->i18nFormat('dd/MM/yyyy')) : __x('date', 'Unknown') ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Pups number') ?></th>
                    <?php if (in_array('pups_number', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                        <?= __('{0, plural, =0{No pup} =1{1 pup} other{# pups}}', [$litter->pups_number]) ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __x('short', 'Stillborn pups') ?></th>
                    <?php if (in_array('pups_number_stillborn', $diff_list)) : ?>
                        <td class="plus">
                    <?php else : ?>
                        <td>
                    <?php endif ; ?>
                        <?= __('{0, plural, =0{No stillborn pup} =1{1 stillborn pup} other{# stillborn pups}}', [$litter->pups_number_stillborn]) ?>
                    </td></tr>
            </table>

            <h2><?= __('Ratteries') ?></h2>
            <?php if (! empty($litter->contributions)) : ?>
                <div class="table-responsive">
                    <table class="condensed stats">
                        <?php foreach ($types as $type) : ?>
                            <?php if (in_array($type->id, array_keys($snap_ratteries)) || in_array($type->id, array_keys($litter_ratteries))) : ?>
                                <tr>
                                    <th>
                                    <?php
                                        $name = $type->name;
                                        echo strpos($name, "(") ? substr($name, 0, strpos($name, "(")) : $name;
                                    ?>
                                </th>
                                <?php if (
                                    ! isset($snap_ratteries[$type->id])
                                    || ! isset($litter_ratteries[$type->id])
                                    || $snap_ratteries[$type->id]->id != $litter_ratteries[$type->id]->id
                                    ) :
                                ?>
                                    <td class="plus">
                                <?php else : ?>
                                    <td>
                                <?php endif ; ?>
                                    <?=
                                        isset($litter_ratteries[$type->id])
                                        ? $this->Html->link(
                                            h($litter_ratteries[$type->id]->full_name),
                                            ['controller' => 'Ratteries', 'action' => 'view', $litter_ratteries[$type->id]->id],
                                            ['escape' => false]
                                            )
                                        : ''
                                    ?>
                                </td>
                            </tr>
                            <?php endif ; ?>
                        <?php endforeach ;?>
                    </table>
                </div>
            <?php endif; ?>

            <h2><?= __('Comments') ?></h2>
            <?php if (in_array('comments', $diff_list)) : ?>
                <div class="text plus">
            <?php else : ?>
                <div class="text">
            <?php endif ; ?>
                <blockquote>
                    <div class="markdown">
                        <?= $this->Commonmark->sanitize($litter->comments); ?>
                    </div>
                </blockquote>
            </div>

        </div>
    </div>
</div>

<div class="spacer"></div>

<div class="litter view content">
    <details open>
        <summary class="staff">
            <?= __('Messages') ?>
        </summary>
        <?php if (! empty($litter->litter_messages)) : ?>

        <div class="table-responsive">
            <table class="summary">
                <thead>
                    <th><?= __x('message', 'Created') ?></th>
                    <th><?= __x('message', 'Sent by') ?></th>
                    <th><?= __('Message') ?></th>
                    <th><?= __('Auto?') ?></th>
                </thead>
                <?php foreach ($litter->litter_messages as $message) : ?>
                <tr>
                    <td class="nowrap"><?= h($message->created->i18nFormat('dd/MM/yyyy HH:mm')) ?></td>
                    <td><?= h($message->user->username) ?></td>
                    <td><?= h($message->content) ?></td>
                    <td><?= $message->is_automatically_generated ? '✓' : ''  ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </details>
</div>

<div class="spacer"></div>

<?php echo $this->Form->create($litter, ['type' => 'post', 'url' => ['controller' => 'Litters', 'action' => 'moderate', $litter->id]]); ?>

<div class="content">
    <?= $this->element('side_message_control', ['sheet' => $litter]) ?>
</div>
<div class="spacer"></div>

<div class="row">
    <div class="column-responsive column-50">
        <div class="tooltip-staff">
            <?= $this->Html->image('/img/icon-restore.svg', [
                'url' => ['controller' => 'Litters', 'action' => 'restore', $litter->id, $snapshot->id],
                'class' => 'side-nav-icon restore-icon',
                'alt' => __('Restore')]) ?>
            <span class="tooltiptext-staff"><?= __('Restore') ?></span>
        </div>
    </div>

    <div class="column-responsive column-50">
        <div class="sheet-markers float-right mini-statebar">
            <?= $this->element('simple_statebar', ['controller' => 'Litters', 'sheet' => $litter, 'user' => $user]) ?>
        </div>
    </div>
</div>

<?= $this->Form->end(); ?>

<?= $this->Html->css('statebar.css') ?>
