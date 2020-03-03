<!-- In templates/Articles/tags.php -->
<h1>
    Ratteries by prefix
    <?= $this->Text->toList(h($prefixed), 'or') ?>
</h1>

<section>
<?php foreach ($ratteries as $rattery): ?>
    <article>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link(
            $rattery->prefix,
            ['controller' => 'Articles', 'action' => 'view', $rattery->name]
        ) ?></h4>
        <span><?= h($rattery->created) ?></span>
    </article>
<?php endforeach; ?>
</section>
