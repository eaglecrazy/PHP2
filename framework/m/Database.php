<?php


class Database
{
    private static $_instance;
    private static $_db;

    const DB_DRIVER = 'mysql';
    const DB_HOST = 'localhost';
    const DB_NAME = 'shop';
    const DB_USER = 'root';
    const DB_PASS = '';
    const SALT = "POsdfs459+:0dsjpOIGHf";

    private function __construct()
    {
        try {
            $connect_str = self::DB_DRIVER .
                ':host=' . self::DB_HOST .
                ';dbname=' . self::DB_NAME;
            self::$_db = new PDO($connect_str, self::DB_USER, self::DB_PASS);
        } catch (PDOException $e) {
            die('Error' . $e->getMessage());
        }
    }

    public static function getDB()
    {
        if (self::$_instance === null)
            self::$_instance = new self();
        return self::$_instance;
    }

    public function registration($l, $p)
    {
        $login = $login = $this->def($_POST['login']);
        $query = self::$_db->prepare("SELECT * FROM users WHERE login=:login");
        $query->execute(['login' => $login]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($result))
            return false;

        $password = md5($this->def($_POST['password'])) . self::SALT;
        $query = self::$_db->prepare("INSERT INTO users (login, password, role) VALUES (:login, :password, :role)");
        $query->execute(['login' => $login, 'password' => $password, 'role' => 'user']);
        if ($query->errorCode() != '00000')
            return false;
        return true;
    }

    public function authorisation($l, $p)
    {
        $login = $this->def($l);
        $password = md5($this->def($p)) . self::SALT;

        $query = self::$_db->prepare("SELECT * FROM users WHERE login=:login AND password=:password");
        $query->execute(['login' => $login, 'password' => $password]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($result))
            return true;
        return false;
    }

    private function def($v)
    {
        return strip_tags((preg_replace("'<script[^>]*?>.*?'si", "", $v)));
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

}