<?php

class OrderModel
{
    public static function add_order($data)
    {
        //получим id клиента
        $client_id = UserModel::get_id();
        try {
            if ($client_id == -1) {
                throw new Exception('Клиент не вошёл в систему. Это не должно было произойти!');
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
        //внесём данные в таблицу заказов
        $query = 'INSERT INTO orders (client_id, name, phone, adress, comment, order_status) VALUES (:client_id, :name, :phone, :adress, :comment, :order_status)';
        $param = ['client_id' => $client_id, 'name' => $data['name'], 'phone' => $data['phone'], 'adress' => $data['adress'], 'comment' => $data['comment'], 'order_status' => 0];
        Db::getInstance()->insert($query, $param);
        //узнаем номер заказа
        $order_id = Db::getInstance()->get_last_id();
        //проставим его в таблицу корзина
        $query = 'UPDATE cart SET order_id=:new_order_id WHERE client_id=:client_id AND order_id=:order_id';

        Db::getInstance()->update($query, ['new_order_id' => $order_id, 'client_id' => $client_id, 'order_id' => -1]);
        return $order_id;
    }

    public static function get_order_items($num)
    {
        $query = 'SELECT I.name, I.cost, C.count FROM cart AS C JOIN items AS I ON C.item_id=I.id  WHERE C.order_id=:order_id';
        return db::getInstance()->select($query, ['order_id' => $num]);
    }

    //возвращает true если заказ $order_num сделал клиент $client_id
    public static function checkUserToOrder($client_id, $order_num)
    {
        $query = 'SELECT id FROM orders WHERE id=:id AND client_id=:client_id';
        $result = Db::getInstance()->select($query, ['id' => $order_num, 'client_id' => $client_id]);
        if(empty($result))
            return false;
        return true;
    }
}