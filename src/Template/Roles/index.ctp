<button class="btn btn-default right">
    <?= $this->Html->link(__('Add') . __('Role'), ['action' => 'add']) ?>
</button>
<table class="table table-hover">
    <tr>
        <th scope="col" class = "col">#</th>
        <th><?= __('Role Name') ?></th>
        <th colspan="2"><?= __('Created') ?></th>
        <th><?= __('Action') ?></th>
    </tr>
    <?php foreach ($roles as $k => $roles): ?>
    <tr>
        <td scope="row" class = "col"><?= ++$k ?></td>
        <td>
            <?= $this->Html->link($roles->name, ['action' => 'view', $roles->id]) ?>
        </td>
        <td colspan="2">
            <?= $roles->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <i class="fas fa-edit"></i>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $roles->id]) ?>
            -
            <i class="far fa-trash-alt"></i>
            <?= $this->Form->postLink(
           __('Delete'),
            ['action' => 'delete', $roles->id],
            ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?= $this->element('Layouts/pagination') ?>