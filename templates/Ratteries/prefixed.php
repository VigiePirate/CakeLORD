<!-- In templates/Articles/tags.php -->
<h1>
    Ratteries by prefix
    <?= $this->Text->toList(h($prefixes), 'or') ?>
</h1>

<section>
<?php foreach ($ratteries as $rattery): ?>
    <article>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link(
            $rattery->prefix,
            ['controller' => 'Ratteries', 'action' => 'view', $rattery->name]
        ) ?></h4>
        <span><?= h($rattery->created) ?></span>
    </article>
<?php endforeach; ?>
</section>
