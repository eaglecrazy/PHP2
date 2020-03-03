<?php
require_once('../server/defense.php');
require_once('../config.php');
if($_GET['id']) {
    require_once('../components/header.php');
    require_once('../components/item.php');
    require_once('../components/footer.php');
    $scripts .= '<script defer src="../scripts/item.js"></script>';
    $title = $name;
    $tpl = file_get_contents('../template.tpl');
    $patterns = ['/{title}/', '/{styles}/', '/{header}/', '/{main}/', '/{footer}/', '/{scripts}/'];
    $replace = [$title, $styles, $header, $main, $footer, $scripts];
    echo preg_replace($patterns, $replace, $tpl);
}