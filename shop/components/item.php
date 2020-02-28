<?php

require_once('../server/db-config.php');
$id = def($_GET['id']);
$query = mysqli_query($link, "SELECT * FROM items WHERE id='$id'");
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);
$name = $data[0]['name'];
$description = $data[0]['description'];
$cost = $data[0]['cost'];
$extension = $data[0]['extension'];

/*костыль, чтобы не загружать много фоточек*/
$photo_id = str_replace(["_(1)","_(2)","_(3)","_(4)","_(5)"], '', $id);

$main =
    "<article class=\"item-wrap\">
        <div class=\"item-info-wrap\">
            <h2 class=\"item-info-heading\">$name</h2>
            <p class=\"item-info-description\">$description</p>
            <span class=\"item-info-cost\">$cost рублей.</span>
            <button class=\"button item-info-button\" id=\"$id\">Добавить в корзину</button>
        </div>
        <img src=\"../img/big/$photo_id.$extension\" alt=\"$name\" class=\"item-info-image\" width=\"748\" height=\"472\">
    </article>";
