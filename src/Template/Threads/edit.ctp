<?= $this->Form->create($threads) ?>
<div class="form-group">
    <label for="name"><?= __('Title') ?></label>
    <input type="text" class="form-control" id="name" value="<?=$threads->name?>" name="name" placeholder="Name">
</div>
<div class="form-group">
    <label for="name"><?= __('Tag') ?></label>
    <input type="text" class="form-control" id="tag" value="<?=$threads->tag?>" name="tag" placeholder="Tag">
</div>
<div class="form-group">
    <label for="user_reply_id"><?= __('Format Name') ?></label>
    <select required class="custom-select mr-sm-2" id="user_reply_id" name="user_reply_id">
        <option selected value="0">Choose...</option>
        <?php foreach ($userManages as $userManages): ?>
        <option value="<?=$userManages->id?>" <?= $threads->user_reply_id == $userManages->id ? 'selected' : '' ?>>
        <?=$userManages->username?>
        </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label for="memo">Memo</label>
    <textarea name="memo" id="memo" rows="10" cols="10"><?=$threads->memo?></textarea>
</div>
<button type="submit" class="btn btn-primary right submit" name="type" value="0">Submit</button>

<?= $this->Form->end(); ?>