<?php

class Config
{
    private static $configCache = [];

    //функция возвращающая параметр из конфига
    public static function get($parameter)
    {
        //если не был создан кэш конфига
        if(!count(self::$configCache))
            //getCurrentConfiguration записывает параметры конфига в $configCache
            self::getCurrentConfiguration();

        //если в кэше конфига нет нужного параметра
        if (!isset(self::$configCache[$parameter])) {
            throw new Exception('Parameter ' . $parameter . ' does not exists');
        }
        return self::$configCache[$parameter];
    }

    private static function getCurrentConfiguration()
    {
        if (empty(self::$configCache)) {
            //директории со всякими данными для конфига
            $configDir = __DIR__ . '/../configuration/';//директория с файлами конфига
            $configDefault = $configDir . 'config.default.php';//файл с конфигом
            if (is_file($configDefault)) {
                require_once $configDefault;
            } else {
                throw new Exception('Unable to find configuration file');
            }

            //если не найден массив $config, а он найден в файле config.default.php
            //или $config не массив
            if (!isset($config) || !is_array($config)) {
                throw new Exception('Unable to load configuration');
            }
            //добавляем конфиг в статическое поле $configCache
            self::$configCache = $config;
        }
    }
}