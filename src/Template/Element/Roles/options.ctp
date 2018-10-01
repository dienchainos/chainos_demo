<?php if (App\Model\Table\RolesTable::isRoleDistrict($role)): ?>
    <?= $this->element('Roles/province'); ?>
<?php endif; ?>
<?php if (App\Model\Table\RolesTable::isRoleWard($role)): ?>
    <div class="form-group">
        <label for="user_send_option">Select Options Send To: </label>
        <select required class="custom-select mr-sm-2" id="user_send_option" name="user_send_option">
            <option selected value="0">Choose...</option>
            <option value="<?= App\Model\Entity\Role::PROVINCES ?>"><?= App\Model\Entity\Role::PROVINCES?></option>
            <option value="<?= App\Model\Entity\Role::DISTRICTS?>"><?= App\Model\Entity\Role::DISTRICTS?></option>
        </select>
    </div>
    <div class="show-user-option">
    </div>
    <div class="<?= App\Model\Entity\Role::PROVINCES ?>" style="display: none">
        <?= $this->element('Roles/province'); ?>
    </div>
    <div class="<?= App\Model\Entity\Role::DISTRICTS ?>" style="display: none">
        <?= $this->element('Roles/district'); ?>
    </div>
<?php endif; ?>
<script>
    $(function () {
        $('#user_send_option').change(function () {
            var optionShow = $('.show-user-option');
            optionShow.html($('.' + $(this).val()).html());
            optionShow.find('select').attr('name', 'user_send');
        })
    })
</script>