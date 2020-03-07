<?php

class CartModel extends Model
{
    public static function add_item($item_id)
    {
        //выясняем id клиента
        $client_id = UserModel::get_id();
        //если client_id == -1 то он не зарегистрирован и корзину храним в куках
        if ($client_id == -1) {
            $count = self::get_cart_cookie($item_id);
            if($count)
                $count++;
            else
                $count = 1;
            self::set_cart_cookie($item_id, $count);
            return $count;
        }

        //смотрим, есть ли в корзине у этого клиента товар с этим id и статусом заказа -1
        $query = 'SELECT id, count FROM cart WHERE client_id=:client_id AND item_id=:item_id AND order_id=:order_id';
        $id_and_count = Db::getInstance()->select($query, ['client_id' => $client_id, 'item_id' => $item_id, 'order_id' => -1])[0];

        //у клиента уже есть этот товар в корзине
        if ($id_and_count['id']) {
            $query = 'UPDATE cart SET count=:count WHERE id=:id';
            Db::getInstance()->update($query, ['count' => $id_and_count['count'] + 1, 'id' => $id_and_count['id']]);
            return $id_and_count['count'] + 1;
        }

        //у клиента нет этого товара в корзине
        $query = 'INSERT INTO cart (client_id, item_id, count, order_id) VALUES (:client_id, :item_id, :count, :order_id)';
        Db::getInstance()->insert($query, ['client_id' => $client_id, 'item_id' => $item_id, 'count' => 1, 'order_id' => -1]);
        return 1;
    }

    private static function set_cart_cookie($id, $count){
        $name = 'cart' . $id;
        setcookie($name, $count, time() + 3600 * 24 * 7, '/');
    }

    private static function get_cart_cookie($id){
        $name = 'cart' . $id;
        if(isset($_COOKIE[$name]))
            return $_COOKIE[$name];
        return null;
    }
}