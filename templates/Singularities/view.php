<!-- File: templates/Singularities/view.php -->

<h1><?= h($singularity->name_fr) ?></h1>
<p><?= h($singularity->picture) ?></p>
<p><small>Created: <?= $singularity->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $singularity->id]) ?></p>
