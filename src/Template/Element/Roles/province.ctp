<div class="form-group">
    <label for="province_user">Users of Province: <strong><?= $user->province->name ?></strong></label>
    <select required class="custom-select mr-sm-2" id="province_user" name="province_user">
        <option selected value="0">Choose...</option>
        <?php foreach ($userProvinces as $userProvinces): ?>
        <option value="<?= $userProvinces->id ?>"><?=$userProvinces->username?></option>
        <?php endforeach; ?>
    </select>
</div>