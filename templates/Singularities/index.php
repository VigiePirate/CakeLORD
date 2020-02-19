<!-- File: templates/Singularities/index.php -->

<h1>Singularities</h1>
<table>
    <tr>
        <th>Title</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($singularities as $singularity): ?>
    <tr>
        <td>
            <?= $this->Html->link($singularity->title, ['action' => 'view', $singularity->slug]) ?>
        </td>
        <td>
            <?= $singularity->created->format(DATE_RFC850) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
