<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Chainos demo';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <?= $this->Html->css(['bootstrap.min.css', 'base.css', 'style.css', 'themes/default/style.min.css', 'custom.css'])
    ?>
    <?= $this->Html->script(['jquery-1.11.1.min.js', 'bootstrap.min.js', 'jquery.bootstrap-dropdown-hover.js', 'jstree.min.js', 'ckeditor/ckeditor.js', 'custom.js']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <script>
        var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
    </script>
    <?php if(!empty($user)) : ?>
    <nav class="navbar navbar-inverse">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name <?= $controller == 'dashboards' ? 'active' : '' ?>">
                <h3><a href="/dashboards"><?= __('Dashboard') ?></a></h3>
            </li>
        </ul>
        <ul class="nav navbar-nav">
            <?php if (isset($role) && $role === 'admin') : ?>
            <li class="<?= $controller == 'Users' ? 'active' : '' ?>"><a href="/users"><?= __('User') ?></a></li>
            <li class="<?= $controller == 'Roles' ? 'active' : '' ?>"><a href="/roles"><?= __('Role') ?></a></li>
            <li class="<?= $controller == 'Formats' ? 'active' : '' ?>"><a href="/formats"><?= __('Report Form') ?></a></li>
            <?php endif; ?>
            <li class="<?= $controller == 'Reports' ? 'active' : '' ?>"><a href="/reports"><?= __('Report') ?></a></li>
            <li class="<?= $controller == 'Threads' ? 'active' : '' ?>"><a href="/threads"><?= __('Thread') ?></a></li>
            <li class="<?= $controller == 'Messages' ? 'active' : '' ?>"><a href="/messages"><?= __('Message') ?></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="far fa-envelope">
                        <span class="badge badge-danger"><?= isset($numberNewReport) ? $numberNewReport : 0 ?></span>
                    </i>
                    <?= __('Messages') ?>
                </a>
                <div class="dropdown-custom" style="display: none">
                    <?= $this->element('Dashboards/message') ?>
                </div>
            </li>
            <?= $this->element('Layouts/languages') ?>
            <li><a href="/users/view"><span class="glyphicon glyphicon-user"></span>  <?=$user['username']?></a></li>
            <li><a href="/users/logout"><span class="glyphicon glyphicon-log-in"></span>  <?= __('Logout') ?></a></li>
        </ul>
    </nav>
    <?= $this->Flash->render() ?>
    <?php endif; ?>
    <div class="container clearfix <?= $controller == 'Dashboards' ? 'container-dashboard' : ''?>">
        <?php if (!in_array($controller, ['Dashboards']) && !in_array($path, ['/login', '/users/view'])) : ?>
            <h3><a href=""><?= __(ucfirst($action == 'index' ? '' : $action)) . ' ' . __(substr(ucfirst($controller), 0, -1)) ?></a></h3>
        <?php endif; ?>
        <?= $this->fetch('content') ?>
    </div>

    <!-- Footer -->
    <footer class="page-footer font-small blue">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2018 Demo:
            <a href="http://chainos.vn/">Chainos.vn</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>
</html>

<script>
    $(function () {
        $('.nav-item').hover(function () {
            $('.dropdown-custom').css('display', 'block');
        }, function () {
            $('.dropdown-custom').css('display', 'none');
        })
    })
</script>