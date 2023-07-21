<h2><?= __('My Statistics') ?></h2>

<table class="condensed stats unfold">
    <tr>
        <th><?= __('I currently live with:') ?></th>
        <td><?=
            $alive_rat_count != 0 ?
            __('{0, plural, =1{1 rat} other{# rats}} (♀: {1} –  ♂: {2})', [$alive_rat_count, $alive_female_count, $alive_male_count]) :
            __('No rat at the moment')
            ?>
        </td>
    </tr>
    <tr>
        <th><?= __('In total, I have hosted:') ?></th>
        <td><?= __('{0, plural, =0{No rat} =1{1 rat} other{# rats}} (♀: {1} –  ♂: {2})', [$rat_count, $female_count, $male_count]) ?></td>
    </tr>
    <tr>
        <th><?= __('As owner or creator, I manage the sheets of:') ?></th>
        <td>
            <?= __('{0, plural, =0{No rat} =1{1 rat} other{# rats}}', [$rat_count + $managed_rat_count]) ?>
            <?= __('(alive: {0})', [$alive_rat_count + $alive_managed_rat_count]) ?>
        </td>
    </tr>
</table>

<table class="condensed stats unfold">
    <tr>
        <th><?= __('Average lifespan of my rats:') ?></th>
        <td><?= __('{0, plural, =0{N/A} =1{1 month} other{# months}} (♀: {1, plural, =0{N/A} =1{1 month} other{# months}} – ♂: {2, plural, =0{N/A} =1{1 month} other{# months}})', [h($avg_lifespan), h($female_avg_lifespan), h($male_avg_lifespan)]) ?></td>
        <tr>
            <th> ⨽ <?= __('average, infant mortality excluded:') ?></th>
            <td> ⨽ <?= __('{0, plural, =0{N/A} =1{1 month} other{# months}} (♀: {1, plural, =0{N/A} =1{1 month} other{# months}} – ♂: {2, plural, =0{N/A} =1{1 month} other{# months}})', [h($not_infant_lifespan), h($not_infant_female_lifespan), h($not_infant_male_lifespan)]) ?></td>
        </tr>
        <tr>
            <th> ⨽ <?= __('average, accidents also excluded:') ?></th>
            <td> ⨽ <?= __('{0, plural, =0{N/A} =1{1 month} other{# months}} (♀: {1, plural, =0{N/A} =1{1 month} other{# months}} – ♂: {2, plural, =0{N/A} =1{1 month} other{# months}})', [h($not_accident_lifespan), h($not_accident_female_lifespan), h($not_accident_male_lifespan)]) ?></td>
        </tr>
    </tr>
</table>

<table class="condensed stats unfold">
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
