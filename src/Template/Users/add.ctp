<div class="users form">
    <?= $this->Form->create($users) ?>
    <fieldset>
        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
        <?= $this->Form->control('re-password', ['type' => 'password']) ?>

        <?= $this->element('Users/role') ?>
        <?= $this->element('Users/province') ?>
        <div class="rprovince-reload">
            <?= $this->element('Users/district') ?>
            <div class="district-reload">
                <?= $this->element('Users/ward') ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary right">Submit</button>
    </fieldset>
    <?= $this->Form->end() ?>
</div>

<script>
    $(function () {

        $('#province').change(function () {
            var id = $(this).val();

            if(id === 0) {
                return false;
            }

            $.ajax({
                type: "POST",
                beforeSend: function (xhr) { // Add this line
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },  // Add this line
                data: { data: $('form').serialize()},
                url: "/reports/get/" + id,
                success: function (response) {
                    console.log(response);
                },
                error: function () {
                    console.log("Response ajax is fails.");
                }
            });
        });
    });
</script>