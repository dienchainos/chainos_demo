<table class="table table-dashboard table-hover ">
    <tr>
        <th scope="col" class = "col" class = "col">#</th>
        <th colspan="2"><?= __('Title') ?></th>
        <th><?= __('Format Name') ?></th>
        <th><?= __('From') ?></th>
        <th><?= __('Provinces') ?></th>
        <th><?= __('Districts') ?></th>
        <th><?= __('Wards') ?></th>
        <th colspan="2"><?= __('Created') ?></th>
    </tr>
    <?php foreach ($reports as $k => $reports): ?>
    <tr class="<?= !$reports->user_read ? 'read active' : '' ?>">
        <td scope="row" class = "col"><?= ++$k ?></td>
        <td colspan="2" class="link-read" id="<?= $reports->id ?>">
            <?= $this->Html->link($reports->title, ['action' => 'view', $reports->id]) ?>
        </td>
        <td>
            <?= h($reports->format->name) ?>
        </td>
        <td>
            <?= h($reports->user->username) ?>
        </td>
        <td>
            <?= h($reports->province->name) ?>
        </td>
        <td>
            <?= h($reports->district->name) ?>
        </td>
        <td>
            <?= h($reports->ward->name) ?>
        </td>
        <td colspan="2">
            <?= $reports->created->format(DATE_RFC850) ?>
            <?php if (!$reports->user_read) : ?>
                <span class="badge-dashboard">
                    <i class="far fa-comment-alt"></i>
                    <span class="badge-new">New</span>
                </span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?= $this->element('Layouts/pagination') ?>

<script>
    var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;

    $(function () {
        $('.link-read').on('click', function (e) {
            sendAjaxUpdateRead($(this).attr('id'), csrfToken);
        });
    });

    function sendAjaxUpdateRead(reportId, csrfToken) {
        if (reportId === 0) {
            return false;
        }

        $.ajax({
            type: "POST",
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', csrfToken);
            },  // Add this line
            data: { user_read: 1 },
            url: "/dashboards/update-read/" + reportId,
            success: function (response) {
                console.log(response);
            },
            error: function () {
                console.log("Response ajax is fails.");
            }
        });
    }
</script>