<!-- File: templates/Singularities/index.php -->

<h1>Singularities</h1>

<?= $this->Html->link('Add Singularity', ['action' => 'add']) ?>

<table>
    <tr>
        <th>Id</th>
        <th>Name FR</th>
        <th>Name EN</th>
        <th>Picture</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($singularities as $singularity): ?>
    <tr>
        <td>
            <?= $this->Html->link($singularity->id, ['action' => 'view', $singularity->id]) ?>
        </td>
        <td>
            <?= $singularity->name_fr ?>
        </td>
        <td>
            <?= $singularity->name_en ?>
        </td>
        <td>
            <?= $singularity->picture ?>
        </td>
        <td>
            <?= $singularity->created->format(DATE_RFC850) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
