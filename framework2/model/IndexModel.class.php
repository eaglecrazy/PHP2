<?php

class IndexModel
{
    public static function getAllItems(){
        $query = 'SELECT * FROM items ORDER BY datetime';
        return Db::getInstance()->select($query);
    }
}