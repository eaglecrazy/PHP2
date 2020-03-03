<?php
if($_COOKIE['active-user'] != 'admin')
    die('Войдите на сайт под учётной записью администратора.');

require_once('../server/defense.php');
require_once('../config.php');
require_once('../components/header.php');
require_once('../components/admin-items.php');
require_once('../components/footer.php');
$title = "Управление товарами";
$tpl = file_get_contents('../template.tpl');
$patterns = ['/{title}/', '/{styles}/', '/{header}/', '/{main}/', '/{footer}/', '/{scripts}/'];
$replace = [$title, $styles, $header, $main, $footer, $scripts];
echo preg_replace($patterns, $replace, $tpl);