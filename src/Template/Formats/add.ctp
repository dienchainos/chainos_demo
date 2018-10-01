<?= $this->Form->create($formFormat) ?>
    <div class="form-group">
        <label for="name"><?= __('Name') ?></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Format name">
    </div>
    <div class="form-group">
        <label for="content">Format Form</label>
        <textarea name="content" id="content" rows="15" cols="100"></textarea>
    </div>
    <button type="submit" class="btn btn-primary right">Submit</button>
<?= $this->Form->end(); ?>
<script>
    CKEDITOR.replace('content');
</script>