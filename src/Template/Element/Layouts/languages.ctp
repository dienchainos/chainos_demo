<li class="dropdown ">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?= __('Language: en') ?><span class="caret"></span></a>
    <ul class="dropdown-menu dropdown-menu-languages">
        <li><?= $this->Html->link("en", array("controller" => "App", "action" => "changeLanguage", 'end')); ?></li>
        <li><?= $this->Html->link("vn", array("controller" => "App", "action" => "changeLanguage", 'vn')); ?></li>
        <li><?= $this->Html->link("jp", array("controller" => "App", "action" => "changeLanguage", 'jp')); ?></li>
        <li><?= $this->Html->link("fr", array("controller" => "App", "action" => "changeLanguage", 'fr')); ?></li>
    </ul>
</li>