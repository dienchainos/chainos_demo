<?= $this->Form->create($reports) ?>
    <div class="form-group">
        <label for="title"><?= __('Title') ?></label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $reports->title ?>" placeholder="Title">
    </div>
    <div class="form-group">
        <label for="format"><?= __('Format Name') ?></label>
        <select required class="custom-select mr-sm-2" id="format" name="format_id">
            <option value="0">Choose...</option>
            <?php foreach ($formats as $format): ?>
                 <option value="<?=$format->id?>" <?= $format->id === $reports->format_id ? 'selected' : '' ?>>
                     <?=$format->name?>
                 </option>
            <?php endforeach; ?>
        </select>
    </div>
    <?= $this->element('Roles/options'); ?>
    <div class="form-group">
        <label for="content">Format Form</label>
        <textarea name="content" id="content" rows="15" cols="100"><?=$reports->content?></textarea>
    </div>

    <button type="submit" class="btn btn-primary right submit" name="type" value="0">Send Reports</button>
    <button type="submit" class="btn btn-default right" style="margin-right: 10px; padding: 7px" value="1" name="type">Save Draft</button>

<?= $this->Form->end(); ?>
<script>
    CKEDITOR.replace('content');

    $(function () {
        sendAjaxForChangeFormatContent();
        $('.submit').click(function(e) {
            if (!confirm('You are ready for send this report ?')) {
                return false;
            }
        });
    });

</script>