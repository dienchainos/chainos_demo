<div class="form-group">
    <label for="district">Districts Name</label>
    <select required class="custom-select mr-sm-2" id="district" name="district_id">
        <option selected value="0">Choose...</option>
        <?php foreach ($districts as $districts): ?>
        <option value="<?= $districts->id ?>"><?= $districts->name?></option>
        <?php endforeach; ?>
    </select>
</div>