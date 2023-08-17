<!-- must be included between calls to Form->create() and Form->end() -->

<?php if (isset($legend)) : ?>
    <legend><?= h($legend) ?></legend>
<?php endif; ?>

<?php
    echo $this->Form->control('side_message', [
        'type' => 'textarea',
        'name' => 'side_message',
        'label' => isset($label) ? $label : __('Add custom notification message'),
        'rows' => '5'
    ]);
?>
