<?php

//сделаем ссылку на эту страничку равной '#'
$link_admin_items = LINK_ADMIN_ITEMS;
$link_admin_orders = LINK_ADMIN_ORDERS;

$footer = '';
if ($_SERVER['REQUEST_URI'] === str_replace('..', '', LINK_ADMIN_ITEMS))
    $link_admin_items = LINK_EMPTY;
else if ($_SERVER['REQUEST_URI'] === str_replace('..', '', LINK_ADMIN_ORDERS))
    $link_admin_orders = LINK_EMPTY;



if($_COOKIE['active-user'] === 'admin')
    $footer = " <a href=\"$link_admin_items\" class=\"button indexButton\">Товары</a>
                <a href=\"$link_admin_orders\" class=\"button indexButton\">Заказы</a>";
