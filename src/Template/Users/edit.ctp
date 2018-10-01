<div class="users form">
    <?= $this->Form->create($users) ?>
    <fieldset>
        <?= $this->Form->control('username') ?>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $users->email ?>" required placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Permission</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
        </div>
        <div class="form-group">
            <label for="password">Repassword</label>
            <input type="password" class="form-control" id="Repassword" name="re-password" required placeholder="Repassword">
        </div>

        <div class="form-group">
            <label for="format"><?= __('Role Name') ?></label>
            <select required class="custom-select mr-sm-2" id="role" name="role_id">
                <option selected value="0">Choose...</option>
                <?php foreach ($roles as $roles): ?>
                <option value="<?=$roles->id?>" <?= $users->role_id === $roles->id ? 'selected' : ''?>>
                <?=$roles->name?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="format">Province Name</label>
            <select required class="custom-select mr-sm-2" id="format" name="province_id">
                <option selected value="0">Choose...</option>
                <?php foreach ($provinces as $provinces): ?>
                <option value="<?=$provinces->id?>" <?= $users->province_id === $provinces->id ? 'selected' : ''?>>
                    <?=$provinces->name?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="district">Districts Name</label>
            <select required class="custom-select mr-sm-2" id="district" name="district_id">
                <option selected value="0">Choose...</option>
                <?php foreach ($districts as $districts): ?>
                <option value="<?= $districts->id ?>" <?= $users->district_id === $districts->id ? 'selected' : ''?>>
                    <?= $districts->name?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="ward">Ward Name</label>
            <select required class="custom-select mr-sm-2" id="ward" name="ward_id">
                <option selected value="0">Choose...</option>
                <?php foreach ($wards as $wards): ?>
                <option value="<?=$wards->id?>" <?= $users->ward_id === $wards->id ? 'selected' : ''?>><?=$wards->name?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary right">Submit</button>
    </fieldset>
    <?= $this->Form->end() ?>
</div>

<script>
    $(function () {
        var formatRes, formatId;

        $('#format').change(function () {
            formatId = $(this).val();

            if(formatId === 0) {
                return false;
            }

            $.ajax({
                type: "POST",
                beforeSend: function (xhr) { // Add this line
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },  // Add this line
                data: { data: $('form').serialize()},
                url: "/reports/get/" + formatId,
                success: function (response) {
                    formatRes = JSON.parse(JSON.stringify(response))[0];
                    console.log(formatRes);
                },
                error: function () {
                    console.log("Response ajax is fails.");
                }
            });
        });
    });
</script>