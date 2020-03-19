<?php

use PHPUnit\Framework\TestCase;

//проверка функции получения товара

init();

class ItemsTest extends TestCase
{
    /**
     * @dataProvider items_data_provider
     */

    public function testGet($id, $expected)
    {
        $this->assertSame($expected, ItemsModel::get_item($id));
    }

    public function items_data_provider()
    {
        return [[1, ['id' => '1', 'name' => 'Castlevania', 'description' => 'Игра для NES', 'cost' => '4', 'filename' => '/1-1.jpg', 'datetime' => '2020-03-07 13:05:20']]];
    }
}


function init()
{
    require_once '../lib/Config.class.php';
    require_once '../lib/Db.class.php';
    require_once '../model/ItemsModel.class.php';
//получим из конфига данные для коннекта базы
    $user = Config::get('db_user');
    $password = Config::get('db_password');
    $base = Config::get('db_base');
    $host = Config::get('db_host');
    $port = Config::get('db_port');
    $charset = Config::get('db_charset');
//соединяемся с БД
    Db::getInstance()->connect($user, $password, $base, $host, $port, $charset);
}