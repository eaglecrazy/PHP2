<?php

$order_id = $_COOKIE['last-order'];

$main_start =
        "<h2 class=\"goods-item-heading\">Номер Вашего заказа №$order_id.</h2>
        <table class=\"order-table\">
            <tr>
                <th class=\"table-heading order-first-column\">Наименование</th>
                <th class=\"table-heading order-column\">Количество</th>
            </tr>";

$main_table = '';
$total_cost = 0;
$total_cost_discount = 0;
$total_count = 0;
$query = mysqli_query($link, "SELECT name, cost, count FROM cart INNER JOIN items ON cart.item_id = items.id WHERE client = '$active_user' AND order_id = $order_id ORDER BY item_id");
while ($data = mysqli_fetch_assoc($query)) {
    $item_cost = $data['count'] * $data['cost'];
    $total_cost += $item_cost;
    $total_count += $data['count'];
    $main_table .=
        "<tr>
            <td class=\"table-cell table-cell-text\">$data[name]</td>
            <td class=\"table-cell table-cell-text\">$data[count]</td>
        </tr>";
}

$total_cost_discount = $total_cost;
if ($total_count >= 2) {
    $total_cost_discount = round($total_cost - $total_cost / 100 * 10, 2);
    $total_cost_discount = sprintf("%.02f", $total_cost_discount);
    $discount = $total_cost - $total_cost_discount;
    $discount = sprintf("%.02f", $discount);
}

$main_table .=
    "<tr class=\"order-last-row\">
        <td class=\"table-cell table-cell-text\" colspan='2'>Сумма к оплате с учётом скидки $total_cost_discount руб.</td>
    </tr>";


$main_end =
    "</table>
    <p class=\"order-end\">Ваш заказ поступил в обработку!</p>
    <p class=\"order-end\">В ближайшее время с Вами свяжется менеджер для подтверждения и уточнения заказа.</p>
    <p class=\"order-end\">Спасибо, что выбрали нас!</p>";


$main = $main_start . $main_table . $main_end;
