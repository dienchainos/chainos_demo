<div class="form-group">
    <label for="role"><?= __('Role Name') ?></label>
    <select required class="custom-select mr-sm-2" id="role" name="role_id">
        <option selected value="0">Choose...</option>
        <?php foreach ($roles as $roles): ?>
        <option value="<?=$roles->id?>"><?=$roles->name?></option>
        <?php endforeach; ?>
    </select>
</div>
