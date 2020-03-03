<?php

$styles .= '<link rel="stylesheet" href="../styles/cart.css">';
require_once('../server/db-config.php');

$query = mysqli_query($link, "SELECT item_id, name, cost, count, extension FROM cart INNER JOIN items ON cart.item_id = items.id WHERE client = '$active_user' AND order_id = -1");
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

$main_start = " <div class=\"cart-wrapper\"><div class=\"cart-items\">";
$main_content = '';

$total_count = 0;
$total_cost = 0;
foreach ($data as $item) {
    $total_item_cost = $item['cost'] * $item['count'];
    $total_cost += $total_item_cost;
    $total_count += $item['count'];

    $main_content .= "
        <div class=\"cart-item\" id=\"$item[item_id]\">
            <img src=\"../img/small/$item[item_id].$item[extension]\" width=\"250\" height=\"156\" alt=\"$item[name]\" class=\"item-image\">
            <div class=\"cart-item-info\"><h3 class=\"goods-item-heading\">$item[name]</h3>
                <p class=\"goods-item-text cart-item-price\" id=\"cost-$item[item_id]\">Цена: $total_item_cost рублей.</p>
                <input type=\"number\" min=\"1\" max=\"99\" class=\"cart-item-quantity\" value=\"$item[count]\" id=\"input-$item[item_id]\">
                <svg viewbox=\"0 0 52 52\" class=\"cart-item-cross\" id=\"cross-$item[item_id]\">
                    <path d=\"M26,0C11.664,0,0,11.663,0,26s11.664,26,26,26s26-11.663,26-26S40.336,0,26,0z M26,50C12.767,50,2,39.233,2,26S12.767,2,26,2s24,10.767,24,24S39.233,50,26,50z\"></path>
                    <path d=\"M35.707,16.293c-0.391-0.391-1.023-0.391-1.414,0L26,24.586l-8.293-8.293c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414L24.586,26l-8.293,8.293c-0.391,0.391-0.391,1.023,0,1.414C16.488,35.902,16.744,36,17,36s0.512-0.098,0.707-0.293L26,27.414l8.293,8.293C34.488,35.902,34.744,36,35,36s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414L27.414,26l8.293-8.293C36.098,17.316,36.098,16.684,35.707,16.293z\"></path>
                </svg>
            </div>
        </div>";
}
$order = "<a href=\"../pages/order-page.php\" class=\"button cart-issue-button\">Перейти к оформлению</a>";
if(!$total_count){
    $order = '';
}

$main_end = "
    </div>
    <div class=\"cart-info\"><span class=\"cart-info-text\">Всего товаров:</span>
        <span class=\"cart-info-text cart-info-quantity\">$total_count шт.</span>
        <span class=\"cart-info-text\">Общая стоимость:</span>
        <span class=\"cart-info-text cart-info-price\">$total_cost руб.</span>
        $order
    </div>
</div>";

$main = $main_start . $main_content . $main_end;