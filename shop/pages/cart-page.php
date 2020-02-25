<?php
$scripts = "<script defer src=\"../scripts/cart.js\"></script>";
require_once('../server/defense.php');
require_once('../config.php');
require_once('../components/header.php');
require_once('../components/cart.php');
require_once('../components/footer.php');
$title = "Корзина";

$tpl = file_get_contents('../template.tpl');
$patterns = ['/{title}/', '/{styles}/', '/{header}/', '/{main}/', '/{footer}/', '/{scripts}/'];
$replace = [$title, $styles, $header, $main, $footer, $scripts];
echo preg_replace($patterns, $replace, $tpl);
