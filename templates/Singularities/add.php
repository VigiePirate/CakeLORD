<!-- File: templates/Singularities/add.php -->

<h1>Add Singularity</h1>
<?php
    echo $this->Form->create($singularity);
    // Hard code the user for now.
    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('id');
    // echo $this->Form->control('body', ['rows' => '3']);
    echo $this->Form->control('name_fr');
    echo $this->Form->control('name_en');
    echo $this->Form->control('picture');
    echo $this->Form->button(__('Save Singularity'));
    echo $this->Form->end();
?>
