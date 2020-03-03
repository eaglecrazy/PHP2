<?php
require_once('defense.php');
require_once('../config.php');
require_once('db-config.php');

if ($_POST['login']) {
    $login = def($_POST['login']);
} else {
    die('Вы ввели некорректный логин.');
}
if ($_POST['password']) {
    $password = md5(def($_POST['password'])) . SALT;
} else {
    die('Вы ввели некорректный пароль.');
}

$query = mysqli_query($link, "SELECT * FROM users WHERE login='$login'");
if (mysqli_num_rows($query)) {
    die('Такой пользователь уже существует.');
}

$query = mysqli_query($link, "INSERT INTO users(login, password, role) VALUES ('$login', '$password', 'user')");
setcookie("$login-login", $login, time()+3600*24*7, '/');
setcookie("$login-password", $password, time()+3600*24*7, '/');
setcookie('active-user', $login, time()+3600*24*7, '/');

header("Location: ../pages/index.php");
