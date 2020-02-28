<?php
$main_start = '<form class="form" action="../server/add-item.php" method="POST" enctype="multipart/form-data">
        <h2 class="form-heading">Добавление товара</h2>
        <label class="form-label" for="name">Наименование товара</label>
        <input type="text" name="name" id="name" class="form-add-input" required>
        <label class="form-label" for="cost">Стоимость товара</label>
        <input type="number" name="cost" id="cost" class="form-add-input" min="0" required>
        <label class="form-label" for="description">Описание товара</label>
        <textarea name="description" id="description" cols="30" rows="10" class="form-add-input" required></textarea>
        <label class="form-label" for="photo">Загрузка фотографии</label>
        <input type="file" name="photo" id="photo" class="form-add-input" accept="image/jpeg" required>
        <input type="submit" value="Добавить товар" class="form-add-input">
    </form>
    <table class="items-table">
        <tr>
            <th class="table-heading">Наименование</th>
            <th class="table-heading">Стоимость</th>
            <th class="table-heading">Описание</th>
            <th class="table-heading">Фото</th>
            <th class="table-heading">Изменить</th>
            <th class="table-heading">Удалить</th>
</tr>';
$main_end = '</table>';
$main_table = '';

require_once('../server/db-config.php');
$query = mysqli_query($link, 'SELECT * FROM items ORDER BY id ');
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

foreach ($data as $item) {
    $main_table .=
        "<tr>
    <td class=\"table-cell table-cell-text\">$item[name]</td>
    <td class=\"table-cell table-cell-text\">$item[cost]</td>
    <td class=\"table-cell table-cell-text\">$item[description]</td>
    <td class=\"table-cell table-cell-image\"><img src=\"../img/small/$item[id].$item[extension]\" alt=\"item\"></td>
    <td class=\"table-cell table-cell-edit\"><a class=\"table-link-edit\" href=\"../pages/admin-edit-page.php?id=$item[id]\"><img src=\"../img/edit.png\" alt=\"edit\"></a></td>
    <td class=\"table-cell table-cell-delete\"><a class=\"table-link-delete\" href=\"../server/delete-item.php?id=$item[id]\"><img src=\"../img/delete.png\" alt=\"delete\"></a></td>
</tr>";
}

$main = $main_start . $main_table . $main_end;