<?php
require_once('defense.php');
require_once('db-config.php');

if ($_GET['id']) {
    $id = def($_GET['id']);
    $query = mysqli_query($link, "SELECT * FROM items WHERE id='$id'");
    $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
    $extension = $data[0]['extension'];
    //удалим файлы
    $path_big = "img/big/$id.$extension";
    $path_small = "img/small/$id.$extension";

    if (file_exists($path_big))
        unlink($path_big);
    if (file_exists($path_small))
        unlink($path_small);

    //удалим запись в БД
    $query = mysqli_query($link, "DELETE FROM items WHERE id='$id'");
    //вернёмся обратно в админку
    header('Location: ../pages/admin-items-page.php');
}