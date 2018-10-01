goBack = function() {
    window.history.back();
};

sendAjaxForChangeFormatContent = function () {
    var formatRes, formatId;

    $('#format').change(function () {
        formatId = $(this).val();

        if(formatId === 0) {
            return false;
        }

        $.ajax({
            type: "POST",
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
            },  // Add this line
            data: { data: $('form').serialize()},
            url: "/reports/get/" + formatId,
            success: function (response) {
                formatRes = JSON.parse(JSON.stringify(response))[0];
                CKEDITOR.instances.content.setData(formatRes.content);
            },
            error: function () {
                console.log("Response ajax is fails.");
            }
        });
    });
};

