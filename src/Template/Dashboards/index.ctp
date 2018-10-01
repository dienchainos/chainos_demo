<!-- Search form -->
<div class="col-sm-4 right">
    <div class="input-group stylish-input-group">
        <input type="text" class="form-control search" placeholder="Search">
        <span class="input-group-addon">
            <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
        </span>
    </div>
</div>

<!-- 3 setup a container element -->
<?= $this->element('Dashboards/' . $roleName) ?>
<div class="col-md-10 report-dashboard">
    <?= $this->element('Dashboards/report') ?>
</div>

<script>
    var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;

    $(function () {
        $('#jstree').on('changed.jstree', function (e, data) {
            console.log(data.node.id);
            sendAjaxGetReportList(data.node.id, csrfToken);
        }).jstree();

        $('.search').keyup(function () {
            sendAjaxSearchReportList($(this).val(), csrfToken);
        });
    });

    function sendAjaxGetReportList(formatId, csrfToken) {
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

    function sendAjaxSearchReportList(formatId, csrfToken) {
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
</script>