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
            if ($count)
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

    private static function set_cart_cookie($id, $count)
    {
        $name = 'cart' . $id;
        setcookie($name, $count, time() + 3600 * 24 * 7, '/');
    }

    private static function get_cart_cookie($id)
    {
        $name = 'cart' . $id;
        if (isset($_COOKIE[$name]))
            return $_COOKIE[$name];
        return null;
    }

    //возвращает массив вида со значениями item_id => count
    private static function get_all_cart_cookies()
    {
        $result = [];
        foreach ($_COOKIE as $name => $value) {
            if (strpos($name, 'cart') === 0) {
                $item_id = str_replace('cart', '', $name);
                $result[$item_id] = $value;
            }
        }
        ksort($result);
        return $result;
    }

    //возвращает массив с данными для построения старнички "корзина"
    public static function get_items()
    {
        $cart = [];
        //выясняем id клиента
        $client_id = UserModel::get_id();

        //если client_id == -1 то он не зарегистрирован и корзину храним в куках
        if ($client_id == -1) {
            $id_count = self::get_all_cart_cookies();
            foreach ($id_count as $item_id => $count) {
                $query = 'SELECT name, cost, filename  FROM items WHERE id=:id';
                $result = Db::getInstance()->select($query, ['id' => $item_id])[0];
                $result['count'] = $count;
                $result['total_item_cost'] = $result['count'] * $result['cost'];
                $cart[] = $result;
            }
            //если клиент есть в БД
        } else {
            $query =
            'SELECT C.count, I.name, I.cost, I.filename FROM cart AS C INNER JOIN items AS I ON C.item_id = I.id WHERE C.client_id=:client_id AND C.order_id=:order_id ORDER BY I.name';
            $result = Db::getInstance()->select($query, ['client_id' => $client_id, 'order_id' => -1]);
            foreach ($result as $cart_item){
                $cart_item['total_item_cost'] = $cart_item['count'] * $cart_item['cost'];
                $cart[] = $cart_item;
            }
        }
        return $cart;
    }

    //возвращает массив с количеством покупок и общей стоимостью
    public static function get_total_count_cost($cart)
    {
        $total_cost = 0;
        $total_count = 0;
        foreach ($cart as $item) {
            $total_cost += $item['cost'] * $item['count'];
            $total_count += $item['count'];
        }
        return ['total_cost' => $total_cost, 'total_count' => $total_count];
    }
}