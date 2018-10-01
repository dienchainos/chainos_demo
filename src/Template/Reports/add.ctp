<?= $this->Form->create($reports) ?>
    <div class="form-group">
        <label for="title"><?= __('Title') ?></label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
    </div>
    <div class="form-group">
        <label for="format"><?= __('Format Name') ?></label>
        <select required class="custom-select mr-sm-2" id="format" name="format_id">
            <option selected value="0">Choose...</option>
            <?php foreach ($formats as $format): ?>
                <option value="<?=$format->id?>"><?=$format->name?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?= $this->element('Roles/options'); ?>
    <div class="form-group">
        <label for="content">Format Form</label>
        <textarea name="content" id="content" rows="20" cols="100"></textarea>
    </div>
    <button type="submit" class="btn btn-primary right submit" name="type" value="0">Send Reports</button>
    <button type="submit" class="btn btn-default right" style="margin-right: 10px; padding: 7px" value="1" name="type">Save Draft</button>

<?= $this->Form->end(); ?>
<script>
    CKEDITOR.replace('content');

    $(function () {
        sendAjaxForChangeFormatContent();
    });
</script>