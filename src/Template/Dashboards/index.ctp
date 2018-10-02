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
    $(function () {
        $('#jstree').on('changed.jstree', function (e, data) {
            console.log(data.node.id);
            sendAjaxGetReportList(data.node.id, csrfToken);
        }).jstree();

        $('.search').keyup(function () {
            sendAjaxSearchReportList($(this).val(), csrfToken);
        });
    });

</script>