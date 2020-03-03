<?php

$main_start =
    "<table class=\"items-table\">
        <tr>
            <th class=\"table-heading\">№</th>
            <th class=\"table-heading\">Детали заказа</th>
            <th class=\"table-heading\">Сумма к оплате</th>
            <th class=\"table-heading\">Клиент</th>
            <th class=\"table-heading\">Адрес</th>
            <th class=\"table-heading\">Телефон</th>
            <th class=\"table-heading\">Комментарий</th>
            <th class=\"table-heading\">Статус заказа</th>
            <th class=\"table-heading\">Удалить</th>
        </tr>";


$main_table = '';
require_once('../server/db-config.php');
$query = mysqli_query($link, 'SELECT * FROM orders ORDER BY order_id');
while ($data = mysqli_fetch_assoc($query)) {
    //данные заказа
    $order_id = $data['order_id'];
    $client_id = $data['client_id'];
    $name = $data['name'];
    $phone = $data['phone'];
    $adress = $data['adress'];
    $comment = $data['comment'];

    $selected_active = '';
    $selected_done = '';
    if (!$data['order_status'])
        $selected_active = 'selected';
    else
        $selected_done = 'selected';

    //подсчёт суммы
    $total_cost = total_cost($link, $order_id);

    $main_table .=
        "<tr>
        <td class=\"table-cell table-cell-text \">$order_id</td>
        <td class=\"table-cell table-cell-control\">
            <button class=\"button-table-control\" id=\"$order_id\">Детали заказа</button>
        </td>
        <td class=\"table-cell table-cell-text \">$total_cost руб.</td>
        <td class=\"table-cell table-cell-text\">$name</td>
        <td class=\"table-cell table-cell-text\">$adress</td>
        <td class=\"table-cell table-cell-text\">$phone</td>
        <td class=\"table-cell table-cell-text\">$comment</td>
        <td class=\"table-cell table-cell-control\">
            <select name=\"status\" id=\"status-$order_id\" class=\"table-control\">
                <option value=\"0\" $selected_active>активен</option>
                <option value=\"1\" $selected_done>завершён</option>
            </select>
        </td>
        <td class=\"table-cell table-cell-delete\">
            <a class=\"table-link-delete\" href=\"../server/delete-order.php?id=$order_id\">
                <img src=\"../img/delete.png\" alt=\"delete\">
            </a>
        </td>
    </tr>";
}
$main_end = "</table>";

$main = $main_start . $main_table . $main_end;


function total_cost($link, $order_id)
{
    $total_cost = 0;
    $total_count = 0;

    $query = mysqli_query($link, "SELECT cost, count FROM cart INNER JOIN items ON cart.item_id = items.id WHERE order_id = $order_id");

    while ($data = mysqli_fetch_assoc($query)) {
        $item_cost = $data['count'] * $data['cost'];
        $total_cost += $item_cost;
        $total_count += $data['count'];
    }

    $total_cost_discount = $total_cost;
    if ($total_count >= 2) {
        $total_cost_discount = round($total_cost - $total_cost / 100 * 10, 2);
        $total_cost_discount = sprintf(" % .02f", $total_cost_discount);
    }
    return $total_cost_discount;
}

