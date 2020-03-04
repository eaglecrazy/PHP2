<?php

class Db
{
    private static $instance = null;
    private static $db = null;

    /*
     * Получаем объект для работы с БД
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new db();
        }
        return self::$instance;
    }

    /*
     * Запрещаем копировать объект
     */
    private function __construct()
    {
    }

    private function __sleep()
    {
    }

    private function __wakeup()
    {
    }

    private function __clone()
    {
    }

    public function connect($user, $password, $base, $host, $port, $charset)
    {
        // Формируем строку соединения с сервером
        $connectString = 'mysql:host=' . $host . ';port= ' . $port . ';dbname=' . $base . ';charset' . $charset;
        self::$db = new PDO($connectString, $user, $password,
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // возвращать ассоциативные массивы
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // возвращать Exception в случае ошибки
            ]
        );
    }

    private static function sql($sql, $args = [])
    {
        $query = self::$db->prepare($sql);
        $query->execute($args);
        return $query;
    }

    public static function select($sql, $args = [])
    {
        return self::sql($sql, $args)->fetchAll();
    }






    /*
     * Выполнить запрос к БД
     */
//    public function Query($query, $params = array())
//    {
//        $res = $this->db->prepare($query);
//        $res->execute($params);
//        return $res;
//    }

    /*
     * Выполнить запрос с выборкой данных
     */
//    public function Select($query, $params = array())
//    {
//        $result = $this->Query($query, $params);
//        if ($result) {
//            return $result->fetchAll();
//        }
//    }
}
