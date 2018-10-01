<div class="form-group">
    <label for="ward">Ward Name</label>
    <select required class="custom-select mr-sm-2" id="ward" name="ward_id">
        <option selected value="0">Choose...</option>
        <?php foreach ($wards as $wards): ?>
        <option value="<?=$wards->id?>"><?=$wards->name?></option>
        <?php endforeach; ?>
    </select>
</div>