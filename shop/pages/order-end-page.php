<?php

require_once('../config.php');
require_once('../components/header.php');
require_once('../components/order-end.php');
require_once('../components/footer.php');
$title = "Заказ сформирован";

$tpl = file_get_contents('../template.tpl');
$patterns = ['/{title}/', '/{styles}/', '/{header}/', '/{main}/', '/{footer}/', '/{scripts}/'];
$replace = [$title, $styles, $header, $main, $footer, $scripts];
echo preg_replace($patterns, $replace, $tpl);
