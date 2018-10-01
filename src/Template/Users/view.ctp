<table class="table table-bordered table-user-info">
    <tr>
        <th><?= __('Username') ?></th>
        <td>
            <?= h($users->username) ?>
        </td>
    </tr>
    <tr>
        <th><?= __('Role') ?></th>
        <td>
            <?= h($users->role->name) ?>
        </td>
    </tr>
    <tr>
        <th><?= __('Provinces') ?></th>
        <td>
            <?= h($users->province->name) ?>
        </td>
    </tr>
    <tr>
        <th><?= __('Districts') ?></th>
        <td>
            <?= h($users->district->name) ?>
        </td>
    </tr>
    <tr>
        <th><?= __('Wards') ?></th>
        <td>
            <?= h($users->ward->name) ?>
        </td>
    </tr>
    <tr>
        <th><?= __('Created') ?></th>
        <td>
            <?= $users->created->format(DATE_RFC850) ?>
        </td>
    </tr>
</table>