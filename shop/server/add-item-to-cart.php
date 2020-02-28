<?php
require_once('defense.php');
require_once('db-config.php');

if ($_COOKIE['active-user']) {
    $client = $_COOKIE['active-user'];
} else {
    die
    ("<button class=\"modal-close\" id=\"modal-close\">X</button>
    <div class=\"modal-heading modal-message\">Для покупки необходимо войти на сайт.</div>");
}

if ($_GET['id']) {
    $item = def($_GET['id']);
} else {
    ("<button class=\"modal-close\" id=\"modal-close\">X</button>
    <div class=\"modal-heading modal-message\">Ошибка, не задан товар.</div>");
}

//узнаем есть ли уже этот товар у этого клиента в бд
$query = mysqli_query($link, "SELECT * FROM cart WHERE client='$client' AND item_id = '$item' AND order_id = -1");
if (mysqli_num_rows($query)) {//если есть
    $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
    $count = $data[0]['count'] + 1;
    $query = mysqli_query($link, "UPDATE cart SET count=$count WHERE client='$client' AND item_id = '$item'");
} else {//если нет
    $count = 1;
    $query = mysqli_query($link, "INSERT INTO cart (client, item_id) VALUES ('$client', '$item')");
}

die
("<div class=\"modal-heading modal-message\">Товар добавлен в корзину.<br><br>В корзине $count шт. </div>");