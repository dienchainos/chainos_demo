<!-- 3 setup a container element -->
<div id="jstree" class="col-md-2">
    <!-- in this example the tree is populated from inline HTML -->
    <ul>
        <?php
        foreach ($menus as $dis => $districts):
        ?>
        <li id="district_<?= $districts->id ?>"><?= h($districts->name)?>
            <ul>
                <?php
                $wards = $districts->wards;
                foreach ($wards as $w => $wards):
                ?>
                    <li id="ward_<?= $wards->id ?>"><?= h($wards->name)?>
                <?php endforeach; ?>
            </ul>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
