<?php

class CartModel extends Model
{
//    public static function getAllItems(){
//        $query = 'SELECT * FROM items ORDER BY datetime';
//        return Db::getInstance()->select($query);
//    }

    public static function add_item($id){
        //выясняем id клиента
        $id = UserModel::get_id();
        $id = 1;
        //смотрим, есть ли в корзине у этого клиента товар с этим id и статусом заказа -1
        //если есть то увеличиваем количество на 1
        //если нет, то добавляем новую запись
    }
}