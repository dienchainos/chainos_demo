<button class="btn btn-default right">
    <?= $this->Html->link(__('Add') . __('Report'), ['action' => 'add']) ?>
</button>
<table class="table table-hover">
    <tr>
        <th scope="col" class = "col">#</th>
        <th colspan="2"><?= __('Title') ?></th>
        <th><?= __('Format Name') ?></th>
        <th><?= __('Username') ?></th>
        <th><?= __('Type') ?></th>
        <th colspan="2"><?= __('Created') ?></th>
        <th><?= __('Action') ?></th>
    </tr>

    <?php foreach ($reports as $k => $reports): ?>
    <tr>
        <td scope="row" class = "col"><?= ++$k ?></td>
        <td colspan="2">
            <?= $this->Html->link($reports->title, ['action' => 'view', $reports->id]) ?>
        </td>
        <td>
            <?= h($reports->format->name) ?>
        </td>
        <td>
            <?= h($reports->user->username) ?>
        </td>
        <td>
            <?= $reports->type == 1 ? '<strong style="color: red">Draft</strong>' : '<strong style="color: #0a6aa1">Sent</strong>' ?>
        </td>
        <td colspan="2">
            <?= $reports->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <i class="fas fa-edit"></i>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reports->id]) ?>
            -
           <i class="far fa-trash-alt"></i>
            <?= $this->Form->postLink(
               __('Delete'),
                ['action' => 'delete', $reports->id],
                ['confirm' => 'Are you sure ?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?= $this->element('Layouts/pagination') ?>