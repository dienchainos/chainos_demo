<button class="btn btn-default right">
    <?= $this->Html->link(__('Add') . __('User'), ['action' => 'add']) ?>
</button>
<table class="table table-hover">
    <tr>
        <th scope="col" class = "col">#</th>
        <th><?= __('Username') ?></th>
        <th><?= __('Role') ?></th>
        <th><?= __('Provinces') ?></th>
        <th><?= __('Districts') ?></th>
        <th><?= __('Wards') ?></th>
        <th><?= __('Created') ?></th>
        <th><?= __('Action') ?></th>
    </tr>

    <?php
    foreach ($users as $k => $users): ?>
    <tr>
        <td scope="row" class = "col"><?= ++$k ?></td>
        <td>
            <?= $this->Html->link($users->username, ['action' => 'view', $users->id]) ?>
        </td>
        <td>
            <?= h($users->role->name) ?>
        </td>
        <td>
            <?= h($users->province->name) ?>
        </td>
        <td>
            <?= h($users->district->name) ?>
        </td>
        <td>
            <?= h($users->ward->name) ?>
        </td>
        <td>
            <?= $users->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <i class="fas fa-edit"></i>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $users->id]) ?>

            <i class="far fa-trash-alt"></i>
            <?= $this->Form->postLink(
               __('Delete'),
                ['action' => 'delete', $users->id],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>