<?= $this->Form->create($role) ?>
    <div class="form-group">
        <label for="name"><?= __('Format Name') ?></label>
        <input type="text" class="form-control" id="name" name="name" value="<?=$roles->name?>" placeholder="Role name">
    </div>
    <div class="form-group">
        <label for="name">Permission</label>
        <input type="text" class="form-control" id="permission" name="permission" placeholder="Permission name">
    </div>
<button type="submit" class="btn btn-primary right">Submit</button>
<?= $this->Form->end(); ?>
