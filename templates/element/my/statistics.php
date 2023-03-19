<h2><?= __('My Statistics') ?></h2>

<table class="condensed stats">
    <tr>
        <th><?= __('I currently live with:') ?></th>
        <td><?=
            $alive_rat_count!=0 ?
            h($alive_rat_count) . ' ' . __('rats') . ' (♀: ' . h($alive_female_count) . ' – ♂: ' . h($alive_male_count) . ')' :
            __('No rat at the moment')
            ?>
        </td>
    </tr>
    <tr>
        <th><?= __('In total, I have hosted:') ?></th>
        <td><?= h($rat_count) . ' ' . __('rats') ?> (♀: <?= h($female_count) ?> – ♂: <?= h($male_count) ?>) </td>
    </tr>
    <tr>
        <th><?= __('As owner or creator, I manage the sheets of:') ?></th>
        <td>
            <?= h($rat_count+$managed_rat_count) . ' ' . __('rats') ?>
            (<?= __('alive: ') . h($alive_rat_count+$alive_managed_rat_count) ?>)
        </td>
    </tr>
</table>

<table class="condensed stats">
    <tr>
        <th><?= __('Average lifespan of my rats:') ?></th>
        <td><?= __('{0, number} months', [h($avg_lifespan)]) ?> (♀: <?= h($female_avg_lifespan) ?> – ♂: <?= h($male_avg_lifespan) ?>) </td>
        <tr>
            <th> ⨽ <?= __('average, infant mortality excluded:') ?></th>
            <td> ⨽ <?= __('{0, number} months', [h($not_infant_lifespan)]) ?> (♀: <?= h($not_infant_female_lifespan) ?> – ♂: <?= h($not_infant_male_lifespan) ?>)
        </tr>
        <tr>
            <th> ⨽ <?= __('average, accidents also excluded:') ?></th>
            <td> ⨽ <?= __('{0, number} months', [h($not_accident_lifespan)]) ?> (♀: <?= h($not_accident_female_lifespan) ?> – ♂: <?= h($not_accident_male_lifespan) ?>)
        </tr>
    </tr>
</table>

<table class="condensed stats">
    <tr>
        <th><?= __('My champion:') ?></th>
        <td><?=
            is_null($champion)
                ? __('I have no eligible champion yet')
                : $this->Html->link(h($champion->usual_name), [
                    'controller' => 'Rats',
                    'action' => 'view', $champion->id
                ]) . ' (' . h($champion->champion_age_string) .')'
            ?>
        </td>
</tr>
</table>
