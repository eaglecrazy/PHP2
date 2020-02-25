<?php
require_once('defense.php');
require_once('db-config.php');

$client = $_COOKIE['active-user'];

if ($_GET['count'] && $_GET['id']) {//изменение количества
    $id = def($_GET['id']);
    $count = (int)$_GET['count'];
    $query = mysqli_query($link, "UPDATE cart SET count='$count' WHERE client='$client' AND item_id='$id' AND order_id = -1");
    $query = mysqli_query($link, "SELECT cost FROM items WHERE id='$id'");
    $data = mysqli_fetch_assoc($query);
    $result['current_cost'] = $data['cost'] * $count;
} else if ($_GET['id']) {//удаление
    $id = def($_GET['id']);
    $query = mysqli_query($link, "DELETE FROM cart WHERE client='$client' AND item_id='$id' AND order_id = -1");
}

//вернём информацию о количестве итемов в корзине и их общей стоимости
$total_count = 0;
$total_cost = 0;
recount($link, $client, $total_count, $total_cost);
$result['total_count'] = $total_count;
$result['total_cost'] = $total_cost;
die (json_encode($result));



function recount($link, $client, $total_count, $total_cost){
    global $total_count;
    global $total_cost;
    $query = mysqli_query($link, "SELECT cost, count  FROM cart INNER JOIN items ON cart.item_id = items.id WHERE client = '$client' AND order_id = -1");
    $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
    foreach ($data as $i){
        $total_cost += $i['count'] * $i['cost'];
        $total_count += $i['count'];
    }
}