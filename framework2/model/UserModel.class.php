<?php

class UserModel
{
    private const SALT = 'asdg452sdacvdfb3q54r';

    //добавление юзера в БД
    public static function add_user($login, $password, $role = 'user')
    {
        if (self::user_exist($login))
            return false;
        $password = self::encryption($password);
        $query = 'INSERT INTO users (login, password, role) VALUES (:login, :password, :role)';
        Db::getInstance()->insert($query, ['login' => $login, 'password' => $password, 'role' => $role]);
        return true;
    }

    //проверка существования юзера в БД
    private static function user_exist($login)
    {
        $query = 'SELECT * FROM users WHERE login=:login';
        $result = Db::getInstance()->select($query, ['login' => $login])[0];
        if ($result == null)
            return false;
        return true;
    }

    //получение id клиента
    public static function get_id()
    {
        if(!$_SESSION['login'])
            return -1;
        $query = 'SELECT id FROM users WHERE login=:login';
        return Db::getInstance()->select($query, ['login' => $_SESSION['login']])[0]['id'];
    }

    //установка кук и сессии
    public static function enter_account($login, $password)
    {
        $_SESSION['login'] = $_POST['login'];
        setcookie("login-$login", $login, time() + 3600 * 24 * 7, '/');
        setcookie("password-$login", $password, time() + 3600 * 24 * 7, '/');
        setcookie('active-user', $login, time() + 3600 * 24 * 7, '/');
        $_COOKIE['active-user'] = $login;
        $_COOKIE["login-$login"] = $login;
        $_COOKIE["password-$login"] = $password;
    }

    //очистка кук и сессии
    public static function exit_account()
    {
        $_SESSION['login'] = null;
        $_COOKIE['active-user'] = '';
        setcookie('active-user', '', time() + 1, '/');
    }

    //пробуем авторизоваться автоматически
    public static function try_authorisation()
    {
        if (!isset($_COOKIE['active-user']) || $_COOKIE['active-user'] == '')
            return;

        $active_user = $_COOKIE['active-user'];

        //если в куках есть активный юзер и у него есть логин и пароль
        if ($_COOKIE["login-$active_user"] && $_COOKIE["password-$active_user"]) {
            $login = $_COOKIE["login-$active_user"];
            $password = $_COOKIE["password-$active_user"];

            if (!self::authorisation($login, $password))
                self::exit_account();
        }
    }

    //авторизация
    public static function authorisation($login, $password)
    {
        $query = 'SELECT * FROM users WHERE login=:login AND password=:password';
        $password = self::encryption($password);
        $result = Db::getInstance()->select($query, ['login' => $login, 'password' => $password])[0];
        if ($result == null)
            return false;
        $_SESSION['login'] = $login;
        return true;
    }

    //шифрование пароля
    private static function encryption($str)
    {
        return md5($str . self::SALT);
    }
}

