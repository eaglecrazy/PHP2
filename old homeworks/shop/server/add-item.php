<?php
require_once('defense.php');
require_once('db-config.php');
require_once('functions.php');


if ($_FILES['upload_file']['size'] > 10000000) {
    die("Размер файла более чем 10 Мегабайт.");
}
//ограничим тип принимаемого файла
if ($_FILES['photo']['type'] != 'image/jpeg') {
    die("Загружаемый файл не является файлом jpeg.");
}

//получим данные из запроса
$name = trim(def($_POST['name']));
$id = getUrlName($name);
$cost = (int)$_POST['cost'];
$description = def($_POST['description']);

//проверим нет ли в базе записи с id = $id;
$query = mysqli_query($link, "SELECT id FROM items WHERE id='$id'");
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);
if (count($data)) {
    die("Товар с таким наименованием уже есть в базе данных.");
}

//сгенерируем пути
$extension = getExtension($_FILES["photo"]["name"]);
$path_small = SMALL . $id . $extension;
$path_big = BIG . $id . $extension;

//переместим файл и создадим уменьшенную копию не более 250*156 пикселей
//а обычную уменьшим до 750*468
if (move_uploaded_file($_FILES["photo"]["tmp_name"], $path_big)) {
    imageresize($path_big, $path_big, 750, 468, 100);
    imageresize($path_small, $path_big, 250, 156, 100);
}
//добавим в БД
$extension = substr($extension, 1);
$query = mysqli_query($link, "INSERT INTO items (id, name, cost, description, extension) VALUES ('$id', '$name', '$cost', '$description', '$extension')");

//вернёмся обратно в админку
header('Location: ../pages/admin-items-page.php');
