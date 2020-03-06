<?php

class UserModel extends Model
{
    public static function addUser($login, $password, $role = 'user')
    {
        if (self::userExist($login))
            return false;
        $query = 'INSERT INTO users (login, password, role) VALUES (:login, :password, :role)';
        Db::getInstance()->insert($query, ['login' => $login, 'password' => $password, 'role' => $role]);
        return true;
    }

    //проверка существования юзера в БД
    private static function userExist($login)
    {
        $query = 'SELECT * FROM users WHERE login=:login';
        $result = Db::getInstance()->select($query, ['login' => $login])[0];
        if ($result == null)
            return false;
        return true;
    }
}

