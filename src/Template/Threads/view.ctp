<div class="row">
    <p class="btn btn-default right back" onclick="goBack()">Go Back</p>
</div>
<?= $this->Form->create($reports) ?>
    <div class="form-group">
        <label for="title"><?= __('Title') ?></label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $reports->title ?>" placeholder="Title" disabled>
    </div>
    <div class="form-group">
        <label for="format"><?= __('Format Name') ?></label>
        <select required class="custom-select mr-sm-2" id="format" name="format_id" disabled>
            <option value="0">Choose...</option>
            <?php foreach ($formats as $format): ?>
                 <option value="<?=$format->id?>" <?= $format->id === $reports->format_id ? 'selected' : '' ?>>
                     <?=$format->name?>
                 </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="content">Format Form</label>
        <textarea disabled name="content" id="content" rows="15" cols="100"><?=$reports->content?></textarea>
    </div>
<?= $this->Form->end(); ?>
<script>
    CKEDITOR.replace('content');

    $(function () {
        sendAjaxForChangeFormatContent();
    });
</script>