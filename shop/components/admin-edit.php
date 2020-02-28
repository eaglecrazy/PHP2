<?php

require_once('../server/db-config.php');

$name = '';
$cost = '';
$description = '';

if ($_GET['id']) {
    $id = def($_GET['id']);
    $query = mysqli_query($link, "SELECT * FROM items WHERE id='$id'");
    $data = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $name = $data[0]['name'];
    $cost = $data[0]['cost'];
    $description = $data[0]['description'];
    $extension = $data[0]['extension'];
    $path_big = "img/big/$id.$extension";
}

$main = "<h2 class=\"form-heading\">Изменение товара $name</h2>";

$edit_name =
    "<form class=\"edit-item\" action=\"../server/edit-item.php\" method=\"GET\">
        <label class=\"form-label\" for=\"name\">Наименование товара</label>
        <input type=\"text\" name=\"name\" id=\"name\" class=\"form-add-input\" value=\"$name\" required>
        <input type=\"text\" name=\"id\" id=\"id\" class=\"hidden\" value=\"$id\">
        <input type=\"submit\" value=\"Сохранить\" class=\"form-add-input\">
    </form>";

$edit_cost =
    "<form class=\"edit-item\" action=\"../server/edit-item.php\" method=\"GET\">
        <label class=\"form-label\" for=\"cost\">Стоимость товара</label>
        <input type=\"number\" name=\"cost\" id=\"cost\" class=\"form-add-input\" value=\"$cost\" min=\"0\"  required>
        <input type=\"text\" name=\"id\" id=\"id\" class=\"hidden\" value=\"$id\">
        <input type=\"submit\" value=\"Сохранить\" class=\"form-add-input\">
    </form>";

$edit_description =
    "<form class=\"edit-item\" action=\"../server/edit-item.php\" method=\"GET\">
        <label class=\"form-label\" for=\"description\">Описание товара</label>
        <textarea name=\"description\" id=\"description\" cols=\"30\" rows=\"10\" class=\"form-add-input\"  required>$description</textarea>
        <input type=\"text\" name=\"id\" id=\"id\" class=\"hidden\" value=\"$id\">
        <input type=\"submit\" value=\"Сохранить\" class=\"form-add-input\">
    </form>";

$edit_photo =
    "<form class=\"edit-item\" action=\"../server/edit-item.php\" method=\"POST\" enctype=\"multipart/form-data\">
        <label class=\"form-label\" for=\"photo\">Фотография товара</label>
        <img class=\"form-edit-image\" src=\"../img/small/$id.jpg\" alt=\"$name\" >
        <input type=\"file\" name=\"photo\" id=\"photo\" class=\"form-add-input\"  required>
        <input type=\"text\" name=\"id\" id=\"id\" class=\"hidden\" value=\"$id\">
        <input type=\"submit\" value=\"Сохранить\" class=\"form-add-input\">
    </form>";


$main .= $edit_name . $edit_cost . $edit_description . $edit_photo;