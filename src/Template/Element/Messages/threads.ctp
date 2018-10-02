    <div class="headind_srch">
        <div class="recent_heading">
            <h4>Recent</h4>
        </div>
        <div class="srch_bar">
            <div class="stylish-input-group">
                <input type="text" class="search-bar search-thread" placeholder="Search">
                <span class="input-group-addon"> <button type="button"><i class="fa fa-search" aria-hidden="true"></i></button></span>
            </div>
        </div>
    </div>

    <div class="inbox_chat">
        <?php
        foreach ($threads as $k => $thread) :
        $numReply = $numSend = 0;
        $userScreen = App\Model\Entity\Message::STATUS_SEND;
        $userId     = $thread->user_reply_id;

        if ($thread->user_reply_id == $user['id']) {
            $userScreen = App\Model\Entity\Message::STATUS_REPLY;
            $userId     = $thread->user_send_id;
        }

        if (!empty($thread->messages)):
            foreach ($thread->messages as $msg) :
                $msg->type == App\Model\Entity\Message::STATUS_SEND ? $numSend ++ : $numReply ++;
            endforeach;
        endif;
        ?>
        <?php if($k == 0) : ?>
            <input name="user_screen" id="user_screen" value="<?=$userScreen?>" type="hidden" />
        <?php endif; ?>

            <div class="chat_list <?= $threadId == $thread->id ? 'active_chat' : '' ?>" id="<?= $thread->id ?>">
                <div class="chat_people">
                    <div class="chat_img"><i class="fas fa-user-circle"></i></div>
                    <div class="chat_ib">
                        <h5>
                            <p class="msg-number">
                                <i class="far fa-bell"></i>
                                <span class=""><?= $thread->user_reply_id == $user['id'] ? $numSend : $numReply ?></span>
                            </p>
                            <strong>
                                <?=$this->Build->getUserInfo($userId, 'username')?>
                            </strong>
                            <span class="chat_date">
                                <?= $this->Build->formatDateTime($thread->created) ?>
                            </span>
                        </h5>
                        <p><?= h($thread->name) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>