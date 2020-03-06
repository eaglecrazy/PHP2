<?php

class UserModel extends Model
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

    //установка кук и сессии
    public static function enter_account($login, $password)
    {
        $_SESSION['login'] = $_POST['login'];
        setcookie("$login-login", $login, time() + 3600 * 24 * 7, '/');
        setcookie("$login-password", $password, time() + 3600 * 24 * 7, '/');
        setcookie('active-user', $login, time() + 3600 * 24 * 7, '/');
        $_COOKIE['active-user'] = $login;
        $_COOKIE["$login-login"] = $login;
        $_COOKIE["$login-password"] = $password;
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
        if ($_COOKIE["$active_user-login"] && $_COOKIE["$active_user-password"]) {
            $login = $_COOKIE["$active_user-login"];
            $password = $_COOKIE["$active_user-password"];

            if (!self::authorisation($login, $password))
                self::exit_account();
        }
    }

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

    private static function encryption($str)
    {
        return md5($str . self::SALT);
    }
}

