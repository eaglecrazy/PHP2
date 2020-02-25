<?php

const DB_DRIVER = 'mysql';
const DB_HOST = 'localhost';
const DB_NAME = 'shop';
const DB_USER = 'root';
const DB_PASS = '';



if ($_GET['count']) {
    $count = (int)$_GET['count'];

    try{
        $connect_str = DB_DRIVER .
            ':host=' . DB_HOST .
            ';dbname=' . DB_NAME;
        $db = new PDO($connect_str, DB_USER, DB_PASS);

        $count = (int)$count;
        $query = $db->query("SELECT * FROM items ORDER BY id LIMIT 6 OFFSET $count");

    } catch (PDOException $e){
        die('Error' . $e->getMessage());
    }

    if (!$query->rowCount())
        die('end');

    while ($item = $query->fetch()) {

        /*костыль, чтобы не загружать много фоточек*/
        $photo_id = str_replace(["_(1)", "_(2)", "_(3)", "_(4)", "_(5)"], '', $item['id']);

        $content .= "
    <div class=\"goods-item\">
        <div class=\"goods-item-heading-wrap\">
            <h3 class=\"goods-item-heading\">$item[name]</h3>
        </div>
        <img src=\"../img/small/$photo_id.$item[extension]\" width=\"250\" height=\"156\" alt=\"$item[name]\" class=\"item-image\">
        <p class=\"goods-item-text\">Цена: $item[cost] рублей</p>
        <a href=\"item-page.php?id=$item[id]\" class=\"button\">Подробнее</a>
    </div>";
    }
    die($content);
}