<?php

const LINK_INDEX = "../pages/index.php";
const LINK_FORM = "#";
const LINK_CART = "../pages/cart-page.php";
const LINK_ADMIN_ITEMS = "../pages/admin-items-page.php";
const LINK_ADMIN_ORDERS = "../pages/admin-orders-page.php";
const LINK_EMPTY = "#";
const SALT = "POsdfs459+:0dsjpOIGHf";;
$styles = '';




$active_user = '';
if ($_COOKIE['active-user'])
    $active_user = $_COOKIE['active-user'];

//если есть активный юзер и у него есть логин и пароль
if ($active_user && $_COOKIE["$active_user-login"] && $_COOKIE["$active_user-password"]){
    $login = $_COOKIE["$active_user-login"];
    $password = $_COOKIE["$active_user-password"];
    //проверим их корректность в БД
    require_once('server/db-config.php');
    $query = mysqli_query($link, "SELECT * FROM users WHERE login='$login' AND password='$password'");
    //если запрос не дал результатов то
    if (!mysqli_num_rows($query)) {
        setcookie('active-user', '', time()+1, '/');
        $active_user = '';
    }
}



//1. Создать функционал асинхронного контроля заказов администратором.
//2. Создать функционал управления товарами.
//3. Создать функционал асинхронного контроля заказов пользователем.
//4. *Изменить хранение цен в системе таким образом, чтобы они могли меняться в зависимости от времени и действующих акций.