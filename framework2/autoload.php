<?php

require_once '../../vendor/autoload.php';//Twig

spl_autoload_register("gbStandardAutoload");

//функция автозагрузки классов
function gbStandardAutoload($className)
{
    //директории где лежат классы
    $dirs = [
        'controller',
        'lib',
        'model'
    ];
    $found = false;
    //в каждой директории ищем файл "$className . '.class.php"
    foreach ($dirs as $dir) {
        $fileName = __DIR__ . '/' . $dir . '/' . $className . '.class.php';
        if (is_file($fileName)) {
            require_once($fileName);
            $found = true;
            break;
        }
    }

    if (!$found) {
        throw new Exception('Unable to load ' . $className);
    }
    return true;
}

