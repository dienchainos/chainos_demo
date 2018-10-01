<div class="form-group">
    <label for="province">Province Name</label>
    <select required class="custom-select mr-sm-2" id="province" name="province_id">
        <option selected value="0">Choose...</option>
        <?php foreach ($provinces as $provinces): ?>
        <option value="<?=$provinces->id?>"><?=$provinces->name?></option>
        <?php endforeach; ?>
    </select>
</div>