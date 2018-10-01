<button class="btn btn-default right">
    <?= $this->Html->link(__('Add') . __('Format'), ['action' => 'add']) ?>
</button>
<table class="table table-hover">
    <tr>
        <th scope="col" class = "col">#</th>
        <th><?= __('Name') ?></th>
        <th><?= __('Username') ?></th>
        <th colspan="2"><?= __('Created') ?></th>
        <th><?= __('Action') ?></th>
    </tr>
    <?php foreach ($format as $k => $format): ?>
    <tr>
        <td scope="row" class = "col"><?= ++$k ?></td>
        <td>
            <?= $this->Html->link($format->name, ['action' => 'view', $format->id]) ?>
        </td>
        <td>
            <?= h($format->user->username) ?>
        </td>
        <td colspan="2">
            <?= $format->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <i class="fas fa-edit"></i>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $format->id]) ?>
            -
            <i class="far fa-trash-alt"></i>
            <?= $this->Form->postLink(
           __('Delete'),
            ['action' => 'delete', $format->id],
            ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?= $this->element('Layouts/pagination') ?>