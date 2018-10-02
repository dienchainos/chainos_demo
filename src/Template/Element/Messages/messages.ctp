<div class="msg_history">
    <?php
    $msg = $messages->toArray();
    for ($k = count($msg) - 1; $k >= 0; $k --) :
    ?>
        <?php if ($msg[$k]->type == App\Model\Entity\Message::STATUS_SEND) : ?>
        <div class="incoming_msg">
            <div class="incoming_msg_img"><i class="fas fa-user-circle"></i></div>
            <div class="received_msg">
                <div class="received_withd_msg">
                    <p><?=h($msg[$k]->message)?></p>
                    <span class="time_date"><?= $this->Build->formatDateTime($msg[$k]->created) ?></span>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if($msg[$k]->type == App\Model\Entity\Message::STATUS_REPLY) : ?>
            <div class="outgoing_msg">
                <div class="incoming_msg_img right"><i class="far fa-user-circle"></i></div>
                <div class="sent_msg">
                    <p><?=h($msg[$k]->message)?></p>
                    <span class="time_date"><?= $this->Build->formatDateTime($msg[$k]->created) ?></span>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($k === count($msg) - 1): ?>
            <input value="<?=$msg[$k]->user_send_id?>" type="hidden" id="user_send_id" />
            <input value="<?=$msg[$k]->user_reply_id?>" type="hidden" id="user_reply_id" />
            <input value="<?=$msg[$k]->thread_id?>" type="hidden" id="thread_id" />
            <input value="<?=$msg[$k]->is_read?>" type="hidden" id="is_read" />
        <?php endif; ?>
    <?php endfor; ?>
</div>