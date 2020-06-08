<?php if(isset($image) && ! empty($image)): ?>
<div class="float-right">
    <?= $this->Html->image($image, ['alt' => $rubric, 'width' => '20%']) ?>
</div>
<?php endif; ?>
<h3><?= h($rubric) ?></h3>
<table>
<?php foreach($$rubric as $key => $value): ?>
    <tr>
        <th><?= __($key) ?></th>
        <td><?= $value ?></td>
    </tr>
<?php endforeach; ?>
</table>
