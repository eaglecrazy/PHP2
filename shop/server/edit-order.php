<?php

if($_GET['id'] && ($_GET['status'] == 0 || $_GET['status'] == 1)){
    require_once('db-config.php');
    $order_id = (int)$_GET['id'];
    $status = (int)$_GET['status'];
    $query = mysqli_query($link, "UPDATE orders SET order_status = $status WHERE order_id = $order_id");
    die("<div class=\"modal-heading modal-message\">Статус заказа изменён.<br>");
}