<?= $this->Form->create($roles) ?>
    <div class="form-group">
        <label for="name"><?= __('Role Name') ?></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Role name">
    </div>
    <div class="form-group">
        <label for="name">Permission</label>
        <input type="text" class="form-control" id="permission" name="permission" placeholder="Permission name">
    </div>
    <button type="submit" class="btn btn-primary right">Submit</button>
<?= $this->Form->end(); ?>
