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
        //посчитаем итоговую стоимость
        $total_cost = CartModel::get_total_count_cost_render(CartModel::get_items())['total_cost'];

        //внесём данные в таблицу заказов
        $query = 'INSERT INTO orders (client_id, total_cost, name, phone, adress, comment, order_status) VALUES (:client_id, :total_cost, :name, :phone, :adress, :comment, :order_status)';
        $param = ['client_id' => $client_id, 'total_cost' => $total_cost, 'name' => $data['name'], 'phone' => $data['phone'], 'adress' => $data['adress'], 'comment' => $data['comment'], 'order_status' => 0];
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

    //возвращает все заказы
    public static function get_all_orders()
    {
        $query = 'SELECT * FROM orders';
        return Db::getInstance()->select($query, []);
    }

    //возвращает true если заказ $order_num сделал клиент $client_id
    public static function checkUserToOrder($client_id, $order_num)
    {
        $query = 'SELECT id FROM orders WHERE id=:id AND client_id=:client_id';
        $result = Db::getInstance()->select($query, ['id' => $order_num, 'client_id' => $client_id]);
        if (empty($result))
            return false;
        return true;
    }

    public static function get_client_id($id)
    {
        $query = 'SELECT client_id FROM orders WHERE id=:id';
        return Db::getInstance()->select($query, ['id' => $id])[0]['client_id'];
    }

    public static function change_status($id, $status){
        $query = 'UPDATE orders SET order_status=:order_status WHERE id=:id';
        Db::getInstance()->update($query, ['order_status' => $status, 'id' => $id]);
    }

    public static function delete($id){
        $query = 'DELETE FROM orders WHERE id=:id';
        Db::getInstance()->delete($query, ['id' => $id]);
    }
}