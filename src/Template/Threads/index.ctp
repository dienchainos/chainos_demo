<button class="btn btn-default right">
    <?= $this->Html->link(__('Add') . __('Thread'), ['action' => 'add']) ?>
</button>
<table class="table table-hover">
    <tr>
        <th scope="col" class = "col">#</th>
        <th><?= __('Thread') . __('Name') ?></th>
        <th colspan="2"><?= __('Created') ?></th>
        <th><?= __('Action') ?></th>
    </tr>
    <?php foreach ($threads as $k => $threads): ?>
    <tr>
        <td scope="row" class = "col"><?= ++$k ?></td>
        <td>
            <?= $this->Html->link($threads->name, ['action' => 'view', $threads->id]) ?>
        </td>
        <td colspan="2">
            <?= $threads->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <i class="fas fa-edit"></i>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $threads->id]) ?>
            -
            <i class="far fa-trash-alt"></i>
            <?= $this->Form->postLink(
            __('Delete'),
            ['action' => 'delete', $threads->id],
            ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?= $this->element('Layouts/pagination') ?>