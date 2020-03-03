<?php

require_once('../server/db-config.php');

$main_start = "       <h2 class=\"goods-item-heading\">Ваш заказ:</h2>
        <table class=\"order-table\">
            <tr>
                <th class=\"table-heading order-first-column\">Наименование</th>
                <th class=\"table-heading order-column\">Количество</th>
                <th class=\"table-heading order-column\">Цена</th>
                <th class=\"table-heading order-column\">Сумма</th>
                <th class=\"table-heading order-column\">Скидка</th>
                <th class=\"table-heading\">Сумма с учётом скидки</th>
            </tr>";

$main_table = '';
$total_cost = 0;
$total_cost_discount = 0;
$total_count = 0;
$query = mysqli_query($link, "SELECT name, cost, count FROM cart INNER JOIN items ON cart.item_id = items.id WHERE client = '$active_user' AND order_id = -1 ORDER BY item_id");
while ($data = mysqli_fetch_assoc($query)) {
    $item_cost = $data['count'] * $data['cost'];
    $total_cost += $item_cost;
    $total_count += $data['count'];
    $main_table .=
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
    $main_table .=
    "<tr class=\"order-last-row\">
        <td class=\"table-cell table-cell-text\" colspan=\"5\">Скидка за покупку двух игр (10%)</td>
        <td class=\"table-cell table-cell-text\">-$discount руб.</td>
    </tr>";
}

$main_table .=
    "<tr class=\"order-last-row\">
        <td class=\"table-cell table-cell-text\" colspan=\"5\">Сумма к оплате</td>
        <td class=\"table-cell table-cell-text\">$total_cost_discount руб.</td>
    </tr>
</table>";

$main_form =
"<form class=\"order-form\" action=\"../server/add-order.php\" method=\"POST\" enctype=\"multipart/form-data\">
    <div>
        <h2 class=\"form-heading\">Контактные данные</h2>
        <label class=\"form-label\" for=\"name\">Имя</label>
        <input type=\"text\" name=\"name\" id=\"name\" class=\"form-add-input\">
        <label class=\"form-label\" for=\"phone\">Телефон</label>
        <input type=\"text\" name=\"phone\" id=\"phone\" class=\"form-add-input\">
        <label class=\"form-label\" for=\"adress\">Адрес</label>
        <textarea name=\"adress\" id=\"adress\" cols=\"30\" rows=\"3\" class=\"form-add-input\"></textarea>
        <label class=\"form-label\" for=\"comment\">Комментарий к заказу</label>
        <textarea name=\"comment\" id=\"comment\" cols=\"30\" rows=\"3\" class=\"form-add-input\"></textarea>
        <input type=\"submit\" value=\"Заказать\" class=\"button order-button\">
    </div>
</form>";

$main = $main_start . $main_table . $main_form;