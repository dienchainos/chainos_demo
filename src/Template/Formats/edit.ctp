<?= $this->Form->create($formFormat) ?>
    <div class="form-group">
        <label for="name"><?= __('Format Name') ?></label>
        <input type="text" class="form-control" id="name" name="name" value="<?=$formFormat->name?>" placeholder="Format name">
    </div>
    <div class="form-group">
        <label for="content">Format Form</label>
        <textarea name="content" id="content" rows="15" cols="100"><?=$formFormat->content?></textarea>
    </div>
    <button type="submit" class="btn btn-primary right">Submit</button>
<?= $this->Form->end(); ?>
<script>
    CKEDITOR.replace('content');
</script>