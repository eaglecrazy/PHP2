<?php
require_once('../server/db-config.php');
$query = mysqli_query($link, 'SELECT * FROM items ORDER BY id LIMIT 6');
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

$main_start = '<div class="goods-list">';
$main_end = '</div>';
$main_content = '';

foreach ($data as $item) {
    /*костыль, чтобы не загружать много фоточек*/
    $photo_id = str_replace(["_(1)","_(2)","_(3)","_(4)","_(5)"], '', $item['id']);

    $main_content .= "
<div class=\"goods-item\">
    <div class=\"goods-item-heading-wrap\">
        <h3 class=\"goods-item-heading\">$item[name]</h3>
    </div>
    <img src=\"../img/small/$photo_id.$item[extension]\" width=\"250\" height=\"156\" alt=\"$item[name]\" class=\"item-image\">
    <p class=\"goods-item-text\">Цена: $item[cost] рублей</p>
    <a href=\"item-page.php?id=$item[id]\" class=\"button\">Подробнее</a>
</div>";

    $button =   "<div class='button-wrapper'>
                    <button class='button' id='show-more'>Показать ещё</button>
                </div>";
}
$main = $main_start . $main_content . $main_end . $button;