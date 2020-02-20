<!-- File: templates/Singularities/index.php -->

<h1>Singularities</h1>

<?= $this->Html->link('Add Singularity', ['action' => 'add']) ?>

<table>
    <tr>
        <th>Title</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($singularities as $singularity): ?>
    <tr>
        <td>
            <?= $this->Html->link($singularity->picture, ['action' => 'view', $singularity->name_fr]) ?>
        </td>
        <td>
            <?= $singularity->created->format(DATE_RFC850) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
