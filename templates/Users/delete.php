<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
 use Cake\Utility\Inflector;
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <div class="side-nav-group">
                <?= $this->element('default_sidebar') ?>
            </div>
            <div class="side-nav-group">
                <div class="tooltip">
                    <?= $this->Html->image('/img/icon-back.svg', [
                        'url' => ['controller' => 'Users', 'action' => 'view', $user->id],
                        'class' => 'side-nav-icon',
                        'alt' => __('Back')]) ?>
                        <span class="tooltiptext"><?= __('Back to user sheet') ?></span>
                </div>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="users form content">

            <div class="sheet-heading">
                <div class="sheet-title pretitle"><?= __('Delete User') ?></div>
            </div>

            <h1><?= h($user->username) ?></h1>

            <?= $this->Flash->render(); ?>

            <?php if (empty($errors)) : ?>
                <?php
                echo $this->Form->create(null, [
                	'id' => 'jquery-owner-form',
                ]); ?>

                <?php if ($count != 0) : ?>
                    <fieldset>
                        <?php
                            echo $this->Form->control('searchkey', [
                                'id' => 'jquery-owner-input',
                                'name' => 'new_user_name',
                                'label' => __('Search and select the heir’s username'),
                                'type' => 'text',
                                'required' => $count != 0,
                                'placeholder' => __('Type here...'),
                            ]);
                            echo $this->Form->control('searchid', [
                                'id' => 'jquery-owner-id',
                                'name' => 'new_user_id',
                                'label' => [
                                    'class' => 'hide-everywhere',
                                    'text' => 'Hidden field for ID update'
                                ],
                                'class' => 'hide-everywhere',
                                'type' => 'text',
                            ]);
                        ?>
                    </fieldset>
                <?php endif; ?>
                <?= $this->Form->button(__('Delete user'), ['class' => 'button-staff', 'confirm' => __('Are you sure you want to delete # {0}?', [$user->id])]); ?>
                <?= $this->Form->end(); ?>
            <?php else : ?>
                <table>
                    <thead>
                        <th>Association</th>
                        <th>Rule</th>
                        <th>Message</th>
                        <th>Sheet</th>
                    </thead>
                    <tbody>
                        <?php foreach ($errors as $error_field => $error_id) : ?>
                            <?php foreach ($error_id as $error_key => $error_value) : ?>
                                <?php foreach ($error_value as $error_fkey => $error_validation) : ?>
                                    <?php foreach ($error_validation as $error_rule => $error_message) : ?>
                                        <td><?= h($error_field) ?> </td>
                                        <td><?= h($error_rule) ?> </td>
                                        <td><?= h($error_message) ?> </td>
                                        <td>
                                            <?= $this->Html->link(
                                            '#'.$this->Number->format($new_user->$error_field[$error_key]['id']),
                                            ['controller' => $associations[Inflector::camelize($error_field)], 
                                            'action' => 'view', $new_user->$error_field[$error_key]['id']])
                                            ?>
                                        </td>
                                    <?php endforeach ; ?>
                                <?php endforeach ; ?>
                            <?php endforeach ; ?>
                        <?php endforeach ; ?>
                    </tbody>
                </table>
            <?php endif ; ?>
        </div>
    </div>
</div>

<?php $this->append('css');?>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
<?php $this->end();?>
<?= $this->Html->css('ajax.css') ?>
<?php $this->append('script');?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
    $(function () {
        $('#jquery-owner-input')
            .on('input', function() {
                $("#jquery-owner-id").val('');
                if ($(this).val() === '' || $(this).val() === $(this).attr('placeholder')) {
                    $(this).removeClass('autocompleted');
                }
            })
            .autocomplete({
                minLength: 3,
                source: function (request, response) {
                    $.ajax({
                        url: '/users/autocomplete.json',
                        dataType: 'json',
                        data: {
                            'searchkey': $('#jquery-owner-input').val(),
                        },
                        success: function (data) {
                            response(data.items);
                        },
                        open: function () {
                            $(this).removeClass('ui-corner-all').addClass('ui-corner-top');
                        },
                        close: function () {
                            $(this).removeClass('ui-corner-top').addClass('ui-corner-all');
                        }
                    });
                },
                select: function (event, ui) {
                    $("#jquery-owner-input").val(ui.item.value); // display the selected text
                    $("#jquery-owner-input").addClass("autocompleted"); // display the selected text
                    $("#jquery-owner-id").val(ui.item.id); // save selected id to hidden input
                }
            });
    });
    </script>
<?php $this->end(); ?>
