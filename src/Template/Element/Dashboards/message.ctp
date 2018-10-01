<table class="table table-dashboard table-hover ">
    <tr>
        <th colspan="2"><?= __('Title') ?></th>
        <th><?= __('Format Name') ?></th>
        <th><?= __('From') ?></th>
    </tr>
    <?php foreach ($newReportList as $k => $reports): ?>
    <tr class="read active link-read" id="<?= $reports->id ?>">
        <td colspan="2">
            <?= $this->Html->link($reports->title, ['action' => 'view', $reports->id]) ?>
        </td>
        <td>
            <?= h($reports->format->name) ?>
        </td>
        <td>
            <?= h($reports->user->username) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>