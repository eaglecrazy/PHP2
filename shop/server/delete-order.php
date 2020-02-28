<?php
require_once('db-config.php');

if ($_GET['id']) {
    $id = (int)$_GET['id'];
    if(!$id)
        die('Ошибка, неверный номер заказа.');
    //удалим записи в БД
    $query = mysqli_query($link, "DELETE FROM orders WHERE order_id='$id'");
    $query = mysqli_query($link, "DELETE FROM cart WHERE order_id='$id'");
    //вернёмся обратно в админку
    header('Location: ../pages/admin-orders-page.php');
}