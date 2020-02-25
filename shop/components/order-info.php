<?php
require_once('../server/db-config.php');
if ($_GET['id']) {
    $order_id = (int)$_GET['id'];
    if (!$order_id)
        die('Ошибка, неверный номер заказа.');

$page_start =
    "<button class=\"modal-close\" id=\"modal-close\">X</button>
        <h3 class=\"form-heading\">Детали заказа</h3>
        <table class=\"order-table order-table-modal\">
            <tr>
                <th class=\"table-heading order-first-column\">Наименование</th>
                <th class=\"table-heading order-column\">Количество</th>
                <th class=\"table-heading order-column\">Цена</th>
                <th class=\"table-heading order-column\">Сумма</th>
                <th class=\"table-heading order-column\">Скидка</th>
                <th class=\"table-heading\">Сумма с учётом скидки</th>
            </tr>";



$total_cost = 0;
$total_cost_discount = 0;
$total_count = 0;
$page_content = '';
$query = mysqli_query($link, "SELECT name, cost, count FROM cart INNER JOIN items ON cart.item_id = items.id WHERE order_id = $order_id ORDER BY item_id");
while ($data = mysqli_fetch_assoc($query)) {
    $item_cost = $data['count'] * $data['cost'];
    $total_cost += $item_cost;
    $total_count += $data['count'];
    $page_content .=
        "<tr>
            <td class=\"table-cell table-cell-text\">$data[name]</td>
            <td class=\"table-cell table-cell-text\">$data[count]</td>
            <td class=\"table-cell table-cell-text\">$data[cost] руб.</td>
            <td class=\"table-cell table-cell-text\">$item_cost руб.</td>
            <td class=\"table-cell table-cell-text\">0 %</td>
            <td class=\"table-cell table-cell-text\">$item_cost руб.</td>
        </tr>";
}

$total_cost_discount = $total_cost;
if ($total_count >= 2) {
    $total_cost_discount =  round($total_cost - $total_cost/100*10, 2);
    $total_cost_discount = sprintf("%.02f",$total_cost_discount);
    $discount = $total_cost - $total_cost_discount;
    $discount = sprintf("%.02f",$discount);
    $page_content .=
        "<tr class=\"order-last-row\">
    <td class=\"table-cell table-cell-text\" colspan=\"5\">Скидка за покупку двух игр (10%)</td>
    <td class=\"table-cell table-cell-text\">-$discount руб.</td>
</tr>";
}

$page_end =
        "<tr class=\"order-last-row\">
            <td class=\"table-cell table-cell-text\" colspan=\"5\">Сумма к оплате</td>
            <td class=\"table-cell table-cell-text\">$total_cost_discount руб.</td>
        </tr>
    </table>";
    die($page_start . $page_content . $page_end);
}
