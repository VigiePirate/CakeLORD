<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 */
?>
<div class="row">
    <aside class="column">
        <?= $this->element('tech_sidebar', [
                'controller' => 'Roles',
                'object' => $role,
                'tooltip' => __('Role list'),
                'show_staff' => false
            ])
        ?>
    </aside>
    <div class="column-responsive column-90">
        <div class="roles form content">
            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Roles') ?></div>
            </div>
            <h1><?= __('Add Role') ?></h1>
            <?= $this->Form->create($role) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('is_root');
                    echo $this->Form->control('is_admin');
                    echo $this->Form->control('is_staff');
                    echo $this->Form->control('can_change_state');
                    echo $this->Form->control('can_edit_others');
                    echo $this->Form->control('can_edit_frozen');
                    echo $this->Form->control('can_delete');
                    echo $this->Form->control('can_configure');
                    echo $this->Form->control('can_restore');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
