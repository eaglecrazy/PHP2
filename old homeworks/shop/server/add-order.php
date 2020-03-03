<?php
require_once('defense.php');
require_once('db-config.php');

const ERROR = "Ошибка запроса.";

if($_POST['name']){
    $name = def($_POST['name']);
} else {
    die (ERROR);
}
if($_POST['phone']){
    $phone = def($_POST['phone']);
} else {
    die (ERROR);
}
if($_POST['adress']){
    $adress = def($_POST['adress']);
} else {
    die (ERROR);
}
if($_POST['comment']){
    $comment = def($_POST['comment']);
} else {
    $comment = "";
}
if ($_COOKIE['active-user']) {
    $client = $_COOKIE['active-user'];
} else {
    die
    ("<button class=\"modal-close\" id=\"modal-close\">X</button>
    <div class=\"modal-heading modal-message\">Для оформления заказа необходимо войти на сайт.</div>");
}

//добавляем запись о заказе
$query = mysqli_query($link, "INSERT INTO orders (client_id, name, phone, adress, comment) VALUES ('$client', '$name', '$phone', '$adress', '$comment')");

//в корзине проставляем номер заказа
//узнаем последний присвоенный айдишник
$order_id = mysqli_insert_id($link);
$order_id1 = mysqli_insert_id($link);
setcookie('last-order', $order_id, time()+3600, '/');

$query = mysqli_query($link, "UPDATE cart SET order_id = $order_id WHERE client = '$client' AND order_id = -1");

header("Location: ../pages/order-end-page.php");