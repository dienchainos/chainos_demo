<div class="form-group">
    <label for="district_user">Users of District: <strong><?= $user->district->name ?></strong></label>
    <select required class="custom-select mr-sm-2" id="district_user" name="district_user">
        <option selected value="0">Choose...</option>
        <?php foreach ($userDistricts as $userDistricts): ?>
        <option value="<?= $userDistricts->id ?>"><?= $userDistricts->username?></option>
        <?php endforeach; ?>
    </select>
</div>