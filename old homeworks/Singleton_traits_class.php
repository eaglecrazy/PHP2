<?php


trait log_trait
{
    function toLog($s)
    {
        echo $s . '<br>';
    }
}

class Logger
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null)
            self::$_instance = new self();
        return self::$_instance;
    }

    private function  __clone(){}
    private function  __wakeup(){}

    use log_trait;
}

$log = Logger::getInstance();
$log->toLog('Лог 1');
$log->toLog('Лог 2');
$log->toLog('Лог 3');