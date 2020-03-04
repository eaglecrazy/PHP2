<?php

class ItemModel extends Model
{
    public static function getItem($id){
        $query = 'SELECT * FROM items WHERE id=:id';
        return Db::getInstance()->select($query, ['id'=>$id])[0];
    }
}