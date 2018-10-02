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

sendAjaxGetReportList = function(formatId, csrfToken) {
    if (formatId === 0) {
        return false;
    }

    $.ajax({
        type: "POST",
        beforeSend: function (xhr) { // Add this line
            xhr.setRequestHeader('X-CSRF-Token', csrfToken);
        },  // Add this line
        data: {data: []},
        url: "/dashboards/get/" + formatId,
        success: function (response) {
            $('.report-dashboard').html(response);
        },
        error: function () {
            console.log("Response ajax is fails.");
        }
    });
}
;
sendAjaxSearchReportList = function(formatId, csrfToken) {
    if (formatId === 0) {
        return false;
    }

    $.ajax({
        type: "POST",
        beforeSend: function (xhr) { // Add this line
            xhr.setRequestHeader('X-CSRF-Token', csrfToken);
        },  // Add this line
        data: {data: []},
        url: "/dashboards/search/" + formatId,
        success: function (response) {
            console.log(formatId);
            $('.report-dashboard').html(response);
        },
        error: function () {
            console.log("Response ajax is fails.");
        }
    });
}

