<?php

require_once('../server/defense.php');
require_once('../config.php');
require_once('../components/header.php');
require_once('../components/main.php');
require_once('../components/footer.php');
$title = "Магазин Замок Дракулы";
$scripts = '<script defer src="../scripts/show-more.js"></script>';

$tpl = file_get_contents('../template.tpl');
$patterns = ['/{title}/', '/{styles}/', '/{header}/', '/{main}/', '/{footer}/', '/{scripts}/'];
$replace = [$title, $styles, $header, $main, $footer, $scripts];
echo preg_replace($patterns, $replace, $tpl);