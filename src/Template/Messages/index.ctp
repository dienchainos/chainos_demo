<div class="messaging">
    <div class="inbox_msg">
        <div class="message-view">
            <div class="inbox_people">
                <?= $this->element('Messages/threads') ?>
            </div>
            <div class="mesgs">
                <div class="message-content">
                    <?= $this->element('Messages/messages') ?>
                </div>
            </div>
        </div>
        <div class="mesgs">
        <div class="type_msg">
            <div class="input_msg_write">
                <input type="text" class="message write_msg" placeholder="Send a message"/>
                <button class="msg_send_btn" type="button"><i class="fab fa-telegram-plane" aria-hidden="true"></i></button>
            </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        setInterval(function() {
            sendAjaxLoadMessageList(csrfToken);
        }, 5000); // 5000 milliseconds

        $('body').on("click", ".chat_list", function(e){
            $('.chat_list').removeClass('active_chat');
            $(this).addClass('active_chat');
            sendAjaxLoadMessageThread($(this).attr('id'), csrfToken);
        });

        $('body').on("keyup", ".search-thread", function(e){
            sendAjaxSearchThread($(this).attr('id'), csrfToken);
        });

        $('.msg_send_btn').click(function () {
            sendAjaxCreateMessageList($('.message').val(), csrfToken);
        });

        $('.message').click(function(){
            sendAjaxUpdateMsgRead(csrfToken);
        });

        $('.message').keypress(function (event) {
            if (event.which == 13 || event.keyCode == 13) {
                sendAjaxCreateMessageList($('.message').val(), csrfToken);
            }
        });
    });

    function sendAjaxCreateMessageList(message, csrfToken) {
        if (message === 0 || message.trim() === '' || message === null) {
            return false;
        }

        $.ajax({
            type: "POST",
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', csrfToken);
            },  // Add this line
            data: {
                message: message,
                user_send_id: $('#user_send_id').val(),
                user_reply_id: $('#user_reply_id').val(),
                thread_id: $('#thread_id').val(),
            },
            url: "/messages/add/",
            success: function (response) {
                $('.message-content').html(response);
                $('.message').val('');
            },
            error: function () {
                console.log("Response ajax is fails.");
            }
        });
    }

    function sendAjaxLoadMessageList(csrfToken) {
        $.ajax({
            type: "POST",
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', csrfToken);
            },  // Add this line
            data: { thread_id: $('#thread_id').val()},
            url: "/messages/get/",
            success: function (response) {
                $('.message-view').html(response);
            },
            error: function () {
                console.log("Response ajax is fails.");
            }
        });
    }

    function sendAjaxUpdateMsgRead(csrfToken) {
        if($('#is_read').val() === 1) {
            return false;
        }

        $.ajax({
            type: "POST",
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', csrfToken);
            },  // Add this line
            data: { thread_id: $('#thread_id').val(), user_screen: $('#user_screen').val()},
            url: "/messages/updateMsgRead/",
            success: function (response) {
                console.log(response);
                //$('.message-view').html(response);
            },
            error: function () {
                console.log("Response ajax is fails.");
            }
        });
    }

    function sendAjaxLoadMessageThread(threadId, csrfToken) {
        $.ajax({
            type: "POST",
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', csrfToken);
            },  // Add this line
            data: { thread_id: threadId},
            url: "/messages/getMessage/" + threadId,
            success: function (response) {
                $('.message-content').html(response);
            },
            error: function () {
                console.log("Response ajax is fails.");
            }
        });
    }

    function sendAjaxSearchThread(search, csrfToken) {
        $.ajax({
            type: "POST",
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', csrfToken);
            },  // Add this line
            data: { search: search},
            url: "/messages/search/",
            success: function (response) {
                $('.message-content').html(response);
            },
            error: function () {
                console.log("Response ajax is fails.");
            }
        });
    }
</script>