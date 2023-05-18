<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\Rattery $rattery
*/
?>

<?php if (! $rattery->state->is_visible && (is_null($user) || (! is_null($user) && ! $user->can('seePrivate', $rattery)))) : ?>
    <div class="row">
        <aside class="column">
            <div class="side-nav">
                <div class="side-nav-group">
                    <?= $this->element('default_sidebar', ['help_url' => ['controller' => 'Categories', 'action' => 'view', 6]]) ?>
                </div>
                <div class="side-nav-group">
                    <div class="tooltip">
                        <?= $this->Html->image('/img/icon-back.svg', [
                            'url' => 'javascript:history.back()',
                            'class' => 'side-nav-icon',
                            'alt' => __('Back')]) ?>
                            <span class="tooltiptext"><?= __('Back') ?></span>
                        </div>
                </div>
            </div>
        </aside>

        <div class="column-responsive column-90">
            <div class="rats view content">
                <div class="sheet-heading">
                    <div class="sheet-title pretitle"><?= $rattery->is_generic ? __('Generic origin') :  __('Rattery') ?></div>
                    <div class="sheet-markers">
                        <div class="tooltip-state">
                            <div class="current-statemark statecolor_<?php echo h($rattery->state_id) ?>"><?= h($rattery->state->symbol) ?></div>
                            <span class="tooltiptext-state hide-on-mobile"><?= h($rattery->state->name) ?></span>
                        </div>
                    </div>
                </div>

                <h1><?= h($rattery->full_name) . '<span class="rotate"> ' . h($rattery->is_inactive_symbol) . '</span>'?></h1> <!-- -->

                <div class="message error">
                    <?= __('Due to its state in back-office, this sheet can only be entirely viewed by its owner and by staff members.') ?>
                </div>

                <div class="signature">
                    &mdash; <?= __('Created on {0} by {1}.', [$rattery->created->i18nFormat('dd/MM/yyyy'), $rattery->user->username]) ?>
                    <?= ($rattery->modified != $rattery->created) ?
                        __('Last modified on {0}.', [$rattery->modified->i18nFormat('dd/MM/yyyy')])
                        : '' ?>
                </div>

            </div>
        </div>
    </div>
<?php else : ?>

    <div class="row">
        <aside class="column">
            <div class="side-nav">
                <div class="side-nav-group">
                    <?= $this->element('default_sidebar') ?>
                </div>

                <?php if (! is_null($user)) : ?>
                    <div class="side-nav-group">
                        <?php if ($rattery->id == $rattery->user->main_rattery->id) : ?>
                            <div class="tooltip">
                                <?= $this->Html->image('/img/icon-add-litter.svg', [
                                    'url' => ['controller' => 'Litters', 'action' => 'add'], //pass rattery id as contributor ? $rattery->id],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Declare Litter')]) ?>
                                <span class="tooltiptext"><?= __('Declare a litter born here') ?></span>
                            </div>
                        <?php else : ?>
                            <div class="tooltip disabled">
                                <?= $this->Html->image('/img/icon-add-litter.svg', [
                                    'url' => '',
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Declare Litter')]) ?>
                                <span class="tooltiptext"><?= __('This rattery is definitely closed') ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="tooltip">
                            <?= $this->Html->image('/img/icon-locate.svg', [
                                'url' => ['controller' => 'Ratteries', 'action' => 'locate', $rattery->id],
                                'class' => 'side-nav-icon',
                                'alt' => __('See on Map')]) ?>
                            <span class="tooltiptext"><?= __('See rattery on the map') ?></span>
                        </div>

                        <?php if (! $user->can('microEdit', $rattery)) : ?>
                            <div class="tooltip disabled">
                                <?= $this->Html->image('/img/icon-relocate.svg', [
                                    'url' => [],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Relocate')]) ?>
                                <span class="tooltiptext"><?= __('You cannot declare a new location') ?></span>
                            </div>
                            <div class="tooltip disabled">
                                <?= $this->Html->image('/img/icon-comment.svg', [
                                    'url' => [],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Edit Comment')]) ?>
                                <span class="tooltiptext"><?= __('You cannot edit the comment') ?></span>
                            </div>

                        <?php else : ?>
                            <div class="tooltip">
                                <?= $this->Html->image('/img/icon-relocate.svg', [
                                    'url' => ['controller' => 'Ratteries', 'action' => 'relocate', $rattery->id],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Move')]) ?>
                                <span class="tooltiptext"><?= __('Declare a new location') ?></span>
                            </div>
                            <div class="tooltip">
                                <?= $this->Html->image('/img/icon-comment.svg', [
                                    'url' => ['controller' => 'Ratteries', 'action' => 'editComment', $rattery->id],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Edit Comment')]) ?>
                                <span class="tooltiptext"><?= __('Edit comment') ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (! is_null($user) && $user->can('ownerEdit', $rattery)) : ?>
                            <div class="tooltip">
                                <?= $this->Html->image('/img/icon-edit.svg', [
                                    'url' => ['controller' => 'Ratteries', 'action' => 'edit', $rattery->id],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Modify Rattery')]) ?>
                                <span class="tooltiptext"><?= __('Edit whole rattery sheet') ?></span>
                            </div>
                        <?php else : ?>
                            <div class="tooltip disabled">
                                <?= $this->Html->image('/img/icon-edit.svg', [
                                    'url' => [],
                                    'class' => 'side-nav-icon',
                                    'alt' => __('Modify Rattery')]) ?>
                                <span class="tooltiptext"><?= __('You cannot edit this sheet') ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (! is_null($user) && $user->is_staff) : ?>
                        <div class="side-nav-group">
                            <?= $this->element('staff_sidebar', [
                                'controller' => 'Ratteries',
                                'object' => $rattery,
                                'user' => $user
                                ])
                            ?>
                        </div>
                    <?php endif ; ?>
                <?php endif; ?>
            </div>
        </aside>
        <div class="column-responsive column-90">
            <div class="ratteries view content">
                <div class="sheet-heading">
                    <div class="sheet-title pretitle"><?= $rattery->is_generic ? __('Generic origin') :  __('Rattery') ?></div>
                    <div class="sheet-markers">
                        <div class="tooltip-state">
                            <div class="current-statemark statecolor_<?php echo h($rattery->state_id) ?>"><?= h($rattery->state->symbol) ?></div>
                            <span class="tooltiptext-state hide-on-mobile"><?= h($rattery->state->name) ?></span>
                        </div>
                    </div>
                </div>

                <h1><?= h($rattery->full_name) . '<span class="rotate"> ' . h($rattery->is_inactive_symbol) . '</span>'?></h1> <!-- -->

                <?= $this->Flash->render(); ?>

                <?php if($rattery->is_generic) : ?>
                    <div class="message"><?= __('This is a generic prefix. It does not correspond to an actual rattery. Therefore, only limited information is shown.') ?></div>
                    <h2><?= __('Statistics') ?></h2>
                    <h3><?= __('Breeding statistics') ?></h3>
                    <table class="condensed stats unfold">
                        <tr>
                            <th><?= __('Litters recorded under this prefix:') ?></th>
                            <td><?= __('{0, plural, =0{0 litter} =1{1 litter} other{# litters}}', [$stats['inLitterCount']]) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Rat recorded under this prefix:') ?></th>
                            <td><?= __('{0, plural, =0 {No rat} =1{1 rat} other{# rats}}', [$stats['ratCount']]) ?>
                        </tr>
                        <tr>
                            <th> ⨽ <?= __('females:') ?></th>
                            <td> ⨽ <?= __('{0, plural, =0 {No female} =1{1 female} other{# females}} ({1, number} %)', [$stats['femaleCount'], $stats['femaleProportion']]) ?></td>
                        </tr>
                        <tr>
                            <th> ⨽ <?= __('males:') ?></th>
                            <td> ⨽ <?= __('{0, plural, =0 {No male} =1{1 male} other{# males}} ({1, number} %)', [$stats['maleCount'], $stats['maleProportion']]) ?></td>
                        </tr>
                    </table>

                    <h3><?= __('Lifespan statistics') ?></h3>
                    <?php if($stats['ratCount'] == 0 && $stats['outRatCount'] > 0) : ?>
                        <div class="message"><?= __('This prefix is only used in external litters.') ?></div>
                    <?php else : ?>
                        <?php if ($stats['ratCount'] == 0 && $stats['outRatCount'] == 0) : ?>
                            <div class="message error"><?= __('No recorded rat is associated with this origin.') ?></div>
                        <?php else : ?>
                            <table class="condensed stats unfold">
                                <tr>
                                    <th><?= __('Rats recorded as deceased:') ?></th>
                                    <td><?=  __('{0, number} rats ({1, number} % of recorded rats)', [$stats['presumedDeadRatCount'], $stats['deadRatProportion']]) ?></td>
                                </tr>
                                <tr>
                                    <th> ⨽ <?= __('declared with known date:') ?></th>
                                    <td> ⨽ <?= __('{0, number} rats ({1, number} %)', [$stats['deadRatCount'], $stats['followedRatProportion']]) ?></td>
                                </tr>
                                <tr>
                                    <th> ⨽ <?= __('presumed dead:') ?></th>
                                    <td> ⨽ <?= __('{0, number} rats ({1, number} %)', [$stats['lostRatCount'], $stats['lostRatProportion']]) ?></td>
                                </tr>
                            </table>
                            <?php if ($stats['deadRatCount'] > 9) : ?>
                                <table class="condensed stats unfold">
                                    <tr>
                                        <th><?= __('Average lifespan of rats with this prefix:') ?></th>
                                        <td><?= __('{0, number} months (♀: {1, number} months – ♂: {2, number} months)', [$stats['deadRatAge'], $stats['deadFemaleAge'], $stats['deadMaleAge']]) ?></td>
                                    </tr>
                                    <tr>
                                        <th> ⨽ <?= __('infant mortality excluded:') ?></th>
                                        <td> ⨽ <?= __('{0, number} months (♀: {1, number} months – ♂: {2, number} months)', [$stats['deadRatAgeAdult'], $stats['deadRatAgeAdult'], $stats['deadRatAgeAdult']]) ?></td>
                                    </tr>
                                    <tr>
                                        <th> ⨽ <?= __('accidents excluded:') ?></th>
                                        <td> ⨽ <?= __('{0, number} months (♀: {1, number} months – ♂: {2, number} months)', [$stats['deadRatAgeHealthy'], $stats['deadRatAgeHealthy'], $stats['deadRatAgeHealthy']]) ?></td>
                                    </tr>
                                </table>
                            <?php else : ?>
                                <div class="message"><?= __('There aren’t enough rats with consolidated information to compute relevant mortality statistics.') ?></div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php else : ?> <!-- non generic rattery -->
                    <div class="row row-reverse row-with-photo">
                        <div class="column-responsive column-60">
                            <h2><?= __('Information') ?></h2>
                            <table class="aside-photo">
                                <tr>
                                    <!-- add user first and last name if not anonymous ? -->
                                    <th><?= __('Owner') ?></th>
                                    <td><?= $rattery->has('user') ? $this->Html->link($rattery->user->username, ['controller' => 'Users', 'action' => 'view', $rattery->user->id]) : '' ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Founded in') ?></th>
                                    <td><?= ($rattery->birth_year != '0000') ? h($rattery->birth_year) : h(substr($stats['activityYears'],0,4)) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Country') ?></th>
                                    <td><?= $rattery->has('country') ? h($rattery->country->name) : '' ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Localization') ?></th>
                                    <td><?= h($rattery->district) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Zip Code') ?></th>
                                    <td><?= $rattery->zip_code == '' ? '' : $this->Number->format(h($rattery->zip_code)) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Website') ?></th>
                                    <td><?= $rattery->website ? $this->Html->link(h($rattery->website)) : '' ?></td>
                                </tr>
                            </table>
                        </div>

                        <?php if (! is_null($user) && $user->can('microEdit', $rattery)) : ?>
                            <div class="column column-photo edit-photo">
                            <?php if ($rattery->picture != '' && $rattery->picture != 'Unknown.png') : ?>
                                <?= $this->Html->image(UPLOADS . $rattery->picture, ['alt' => $rattery->prefix, 'url' => ['action' => 'changePicture', $rattery->id]]) ?>
                            <?php else : ?>
                                <?= $this->Html->image('UnknownRattery.svg', ['url' => ['action' => 'changePicture', $rattery->id]]) ?>
                            <?php endif; ?>
                            </div>
                        <?php else : ?>
                            <div class="column column-photo">
                            <?php if ($rattery->picture != '' && $rattery->picture != 'Unknown.png') : ?>
                                <?= $this->Html->image(UPLOADS . $rattery->picture, ['alt' => $rattery->prefix]) ?>
                            <?php else : ?>
                                <?= $this->Html->image('UnknownRattery.svg') ?>
                            <?php endif; ?>
                            </div>
                        <?php endif ; ?>
                    </div>

                    <?php if (! empty($rattery->comments)) : ?>
                        <div class="text">
                            <blockquote>
                                <div class="markdown">
                                    <?= $this->Commonmark->sanitize($rattery->comments); ?>
                                </div>
                            </blockquote>
                        </div>
                    <?php endif; ?>

                    <h2><?= __('Statistics') ?></h2>
                    <?php if ($stats['ratCount'] == 0 && $stats['outRatCount'] == 0) : ?>
                        <div class="message error"><?= __('No recorded rat was born in (or in partnership with) this rattery.') ?></div>
                    <?php else : ?>
                        <details open>
                            <summary><?= __('Breeding statistics') ?></summary>
                            <table class="condensed stats unfold">
                                <tr>
                                    <th><?= __('Breeding activity period:') ?></th>
                                    <td><?= h($stats['activityYears']) ?></td>
                                </tr>
                            </table>
                            <table class="condensed stats unfold">
                                <tr>
                                    <th><?= __('Total breeding activity:') ?></th>
                                    <td><?= __('{0, plural, =0{0 litter} =1{1 litter} other{# litters}}', [$stats['inLitterCount']+$stats['outLitterCount']]) ?>,
                                        <?= __('{0, plural, =1{1 pup} other{# pups}}', [$stats['inRatCount']+$stats['outRatCount']]) ?>
                                </tr>
                                <tr>
                                    <th> ⨽ <?= __('internal (born in the rattery):') ?></th>
                                    <td> ⨽ <?= __('{0, plural, =0{0 litter} =1{1 litter} other{# litters}}', [$stats['inLitterCount']]) ?>, <?= __('{0, plural, =1{1 pup} other{# pups}}', [$stats['inRatCount']]) ?></td>
                                </tr>
                                <tr>
                                    <th> ⨽ <?= __('external (other contributed litters):') ?></th>
                                    <td> ⨽ <?= __('{0, plural, =0{0 litter} =1{1 litter} other{# litters}}', [$stats['outLitterCount']]) ?>, <?= __('{0, plural, =1{1 pup} other{# pups}}', [$stats['outRatCount']]) ?><!--, with xx different partner ratteries--></td>
                                </tr>
                            </table>
                            <table class="condensed stats unfold">
                                <tr>
                                    <th><?= __('Rat records (born in the rattery):') ?></th>
                                    <td><?= __('{0, plural, =0 {No rat} =1{1 rat} other{# rats}}', [$stats['ratCount']]) ?>
                                </tr>
                                <tr>
                                    <th> ⨽ <?= __('females:') ?></th>
                                    <td> ⨽ <?= __('{0, plural, =0 {No female} =1{1 female} other{# females}} ({1, number} %)', [$stats['femaleCount'], $stats['femaleProportion']]) ?> </td>
                                </tr>
                                <tr>
                                    <th> ⨽ <?= __('males:') ?></th>
                                    <td> ⨽ <?= __('{0, plural, =0 {No male} =1{1 male} other{# males}} ({1, number} %)', [$stats['maleCount'], $stats['maleProportion']]) ?> </td>
                                </tr>
                            </table>
                        </details>

                        <?php if($rattery->wants_statistic) : ?>
                            <details>
                                <summary><?= __('More breeding statistics') ?></summary>
                                <table class="condensed stats unfold">
                                    <tr>
                                        <th><?= __('Average mother age:') ?></th>
                                        <td><?= __('{0, number} days ({1, number} months)', [round($stats['avg_mother_age']), round($stats['avg_mother_age']/30.5,1)]) ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Average father age:') ?></th>
                                        <td><?= ($stats['avg_father_age'] != 0) ?
                                            __('{0, number} days ({1, number} months)', [round($stats['avg_father_age']), round($stats['avg_father_age']/30.5,1)]) :
                                            __('This rattery only had litters of unknown fathers')
                                            ?> </td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Average litter size:') ?></th>
                                        <td><?= __('{0, plural, =1{1 pup} other{# pups}} per litter', [$stats['avg_litter_size']]) ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Average sex ratio:') ?></th>
                                        <td><?= h($stats['avg_sex_ratio']) ?></td>
                                    </tr>
                                </table>
                            </details>

                            <?php if($stats['ratCount'] == 0 && $stats['outRatCount'] > 0) : ?>
                                <div class="message"><?= __('This rattery only had external litters. Mortality statistics can be consulted on each of their contributed litter sheets.') ?> </div>
                            <?php else : ?>
                                <?php if ($stats['deadRatCount'] > 9) : ?>
                                    <details open>
                                        <summary><?= __('Lifespan statistics') ?></summary>
                                        <table class="condensed stats unfold">
                                            <tr>
                                                <th><?= __('Bred rats recorded as deceased:') ?></th>
                                                <td><?=  __('{0, number} rats ({1, number} % of recorded bred rats)', [$stats['presumedDeadRatCount'], $stats['deadRatProportion']]) ?></td>
                                            </tr>
                                            <tr>
                                                <th> ⨽ <?= __('declared with known date:') ?></th>
                                                <td> ⨽ <?= __('{0, number} rats ({1, number} %)', [$stats['deadRatCount'], $stats['followedRatProportion']]) ?></td>
                                            </tr>
                                            <tr>
                                                <th> ⨽ <?= __('presumed dead:') ?></th>
                                                <td> ⨽ <?= __('{0, number} rats ({1, number} %)', [$stats['lostRatCount'], $stats['lostRatProportion']]) ?></td>
                                            </tr>
                                        </table>
                                        <table class="condensed stats unfold">
                                            <tr>
                                                <th><?= __('Average lifespan of bred rats:') ?></th>
                                                <td><?= __('{0, number} months (♀: {1, number} months – ♂: {2, number} months)', [$stats['deadRatAge'], $stats['deadFemaleAge'], $stats['deadMaleAge']]) ?></td>
                                            </tr>
                                            <tr>
                                                <th> ⨽ <?= __('infant mortality excluded:') ?></th>
                                                <td> ⨽ <?= __('{0, number} months (♀: {1, number} months – ♂: {2, number} months)', [$stats['deadRatAgeAdult'], $stats['deadRatAgeAdult'], $stats['deadRatAgeAdult']]) ?></td>
                                            </tr>
                                            <tr>
                                                <th> ⨽ <?= __('accidents excluded:') ?></th>
                                                <td> ⨽ <?= __('{0, number} months (♀: {1, number} months – ♂: {2, number} months)', [$stats['deadRatAgeHealthy'], $stats['deadRatAgeHealthy'], $stats['deadRatAgeHealthy']]) ?></td>
                                            </tr>
                                        </table>
                                        <table class="condensed stats unfold">
                                            <tr>
                                                <th><?= __('Oldest bred rat:') ?></th>
                                                <td><?= ! is_null($champion)
                                                    ? $this->Html->link(h($champion->usual_name), ['controller' => 'Rats', 'action' => 'view', $champion->id]) . __(' (deceased at {0})', [$champion->champion_age_string])
                                                    : __('No eligible champion')
                                                ?></td>
                                            </tr>
                                        </table>
                                    </details>

                                    <details>
                                        <summary><?= __('Death causes statistics') ?></summary>
                                        <table class="condensed stats">
                                            <tr>
                                                <th><?= __('Primary death causes by decreasing frequency:') ?></th>
                                            </tr>
                                        </table>
                                        <table class="condensed stats histogram">
                                            <?php foreach($stats['primaries'] as $category): ?>
                                                <tr>
                                                    <th>
                                                        <div style="opacity:<?= h(0.25+0.75*$category['count']/$stats['primaries'][0]['count']) ?>; width:<?= h($category['count']/$stats['primaries'][0]['count']*100) ?>%">
                                                            <?= h(round($category['count']/$stats['deadRatCount']*100,2)) ?> %
                                                        </div>
                                                    </th>
                                                    <td><?= h($category['name']) ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </table>
                                        <table class="condensed stats">
                                            <tr>
                                                <th><?= __('Secondary death causes by decreasing frequency:') ?></th>
                                            </tr>
                                        </table>
                                        <table class="condensed stats histogram">
                                            <?php foreach($stats['secondaries'] as $cause): ?>
                                                <tr>
                                                    <th>
                                                        <div style="opacity:<?= h(0.25+0.75*$cause['count']/$stats['secondaries'][0]['count']) ?>; width:<?= h($cause['count']/$stats['secondaries'][0]['count']*100) ?>%">
                                                            <?= h(round($cause['count']/$stats['deadRatCount']*100,2)) ?> %
                                                        </div>
                                                    </th>
                                                    <td><?= h($cause['name']) ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </table>
                                    </details>

                                <?php else : ?>
                                    <details open>
                                        <summary><?= __('Lifespan statistics') ?></summary>
                                        <table class="condensed stats unfold">
                                            <tr>
                                                <th><?= __('Bred rats recorded as deceased:') ?></th>
                                                <td><?=  __('{0, number} rats ({1, number} % of recorded bred rats)', [$stats['presumedDeadRatCount'], $stats['deadRatProportion']]) ?></td>
                                            </tr>
                                            <tr>
                                                <th> ⨽ <?= __('declared with known date:') ?></th>
                                                <td> ⨽ <?= __('{0, number} rats ({1, number} %)', [$stats['deadRatCount'], $stats['followedRatProportion']]) ?></td>
                                            </tr>
                                            <tr>
                                                <th> ⨽ <?= __('presumed dead:') ?></th>
                                                <td> ⨽ <?= __('{0, number} rats ({1, number} %)', [$stats['lostRatCount'], $stats['lostRatProportion']]) ?></td>
                                            </tr>
                                        </table>
                                    </details>
                                    <div class="message"><?= __('There aren’t enough rats with consolidated information to compute relevant mortality statistics.') ?></div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php else : ?> <!-- treat ratteries not wanting statistics -->
                            <div class="message warning"><?= __('The owner of this rattery does not wish to show their full breeding and mortality statistics.') ?></div>
                        <?php endif; ?>

                    <?php endif; ?>

                    <div class="signature">
                        &mdash; <?= __('Created on {0} by {1}.', [$rattery->created->i18nFormat('dd/MM/yyyy'), $rattery->user->username]) ?>
                        <?= ($rattery->modified != $rattery->created) ?
                            __('Last modified on {0}.', [$rattery->modified->i18nFormat('dd/MM/yyyy')])
                            : '' ?>
                    </div>
                </div>
                <div class="spacer"> </div>
                <div class="ratteries view content">

                    <h2><?= __('Related entries') ?></h2>

                    <details open>
                        <summary><?= __('Last contributed litters') ?></summary>
                        <div class="button-raised">
                            <?= $this->Html->link(__('See all contributed litters'), ['controller' => 'Contributions', 'action' => 'fromRattery', $rattery->id], ['class' => 'button float-right']) ?>
                        </div>
                        <table class="summary">
                            <thead>
                                <tr>
                                    <th><?= __('State') ?></th>
                                    <th><?= __x('litter', 'Birth date') ?></th>
                                    <th><?= __('Dam') ?></th>
                                    <th><?= __('Sire') ?></th>
                                    <th><?= __('Size') ?></th>
                                    <th class="actions hide-on-mobile"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rattery->litters as $litter): ?>
                                <tr>
                                    <td><span class="statecolor_<?php echo h($litter->state_id) ?>"><?= h($litter->state->symbol) ?></span></td>
                                    <td><?= $this->Html->link($litter->birth_date->i18nFormat('dd/MM/yyyy'), ['controller' => 'Litters', 'action' => 'view', $litter->id]) ?></td>
                                    <td><?= !empty($litter->dam) ? h($litter->dam[0]->usual_name) : __x('mother', 'Unknown') ?></td>
                                    <td><?= !empty($litter->sire) ? h($litter->sire[0]->usual_name) : __x('father', 'Unknown') ?></td>
                                    <td><?= $this->Number->format($litter->pups_number) ?></td>
                                    <td class="actions hide-on-mobile">
                                        <?php if (! is_null($user) && $user->can('edit', $litter)) : ?>
                                            <?= $this->Html->image('/img/icon-edit.svg', [
                                                'url' => ['controller' => 'Litters', 'action' => 'edit', $litter->id],
                                                'class' => 'action-icon',
                                                'alt' => __('Edit Litter')])
                                            ?>
                                        <?php else :?>
                                            <span class="disabled">
                                                <?= $this->Html->image('/img/icon-edit.svg', [
                                                    'url' => '',
                                                    'class' => 'action-icon disabled',
                                                    'alt' => __('Edit Litter')])
                                                ?>
                                            </span>
                                        <?php endif ;?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </details>

                    <details open>
                        <summary><?= __('Recently modified rats') ?></summary>
                        <div class="button-raised">
                            <?= $this->Html->link(__('See all bred rats'), ['controller' => 'Rats', 'action' => 'byRattery', $rattery->id], ['class' => 'button float-right']) ?>
                        </div>
                        <?= $this->element('simple_rats', [ //rats
                            'rubric' => __(''),
                            'rats' =>  $rattery->rats,//$offsprings,
                            'exceptions' => [
                                'picture',
                                'owner_user_id',
                                'death_primary_cause',
                                'death_secondary_cause',
                            ],
                        ]) ?>
                    </details>

                <?php endif; ?> <!-- end non generic rattery part -->
            </div>

            <?= $this->element('activitybar') ?>

            <?= $this->element('statebar', ['sheet' => $rattery]) ?>

            <!-- Show private information to owner and staff only -->
            <?php if (!is_null($user) && $user->can('seePrivate', $rattery)) : ?>
                <div class="spacer"> </div>
                <div class="rat view content">
                    <h2 class="staff"><?= __('Private information') ?></h2>
                    <div class="related">
                        <details>
                            <summary class="staff">
                                <?= __('Messages') ?>
                            </summary>
                            <?php if (!empty($rattery->rattery_messages)) : ?>

                            <div class="table-responsive">
                                <table class="summary">
                                    <thead>
                                        <th><?= __('Id') ?></th>
                                        <th><?= __('From User') ?></th>
                                        <th><?= __('Message') ?></th>
                                        <th><?= __('Created') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                    </thead>
                                    <?php foreach ($rattery->rattery_messages as $message) : ?>
                                    <tr>
                                        <td><?= h($message->id) ?></td>
                                        <td><?= h($message->from_user_id) ?></td>
                                        <td><?= h($message->content) ?></td>
                                        <td><?= h($message->created->i18nFormat('dd/MM/yyyy')) ?></td>
                                        <td class="actions">
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                            <?php endif; ?>
                        </details>
                        <?php if (! is_null($user) and $user->can('restore', $rattery)) : ?>
                            <details>
                                <summary class="staff">
                                    <?= __('Snapshots') ?>
                                </summary>
                                <?php if (!empty($rattery->rattery_snapshots)) : ?>
                                <div class="table-responsive">
                                    <table class="summary">
                                        <thead>
                                            <th><?= __('Created') ?></th>
                                            <th><?= __('Differences') ?></th>
                                            <!-- <th><?= __('Data') ?></th> -->
                                            <th><?= __('State') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                        </thead>
                                        <?php foreach ($rattery->rattery_snapshots as $ratterySnapshots) : ?>
                                        <tr>
                                            <td><?= h($ratterySnapshots->created) ?></td>
                                            <td><?= h($snap_diffs[$ratterySnapshots->id]) ?></td>
                                            <td><?= h($ratterySnapshots->state->symbol) ?></td>
                                            <td class="actions">
                                                <span class="nowrap">
                                                    <?= $this->Html->image('/img/icon-diff.svg', [
                                                        'url' => ['controller' => 'RatterySnapshots', 'action' => 'diff', $ratterySnapshots->id],
                                                        'class' => 'action-icon',
                                                        'alt' => __('Compare Versions')])
                                                    ?>
                                                    <?= $this->Html->image('/img/icon-restore.svg', [
                                                        'url' => ['controller' => 'Ratteries', 'action' => 'restore', $rattery->id, $ratterySnapshots->id],
                                                        'class' => 'action-icon',
                                                        'alt' => __('Restore Snapshot')]) ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                                <?php endif; ?>
                            </details>
                        <?php endif ; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
<?php endif ; ?>

<?= $this->Html->css('statebar.css') ?>
