<?php


class OrderController extends Controller
{
    public $title = 'Оформление заказа';
    public $view_dir = 'order';

    //вывод заказа
    public function index($data)
    {
        $cart = CartModel::get_items();
        $total_count_cost = CartModel::get_total_count_cost_render($cart);
        return [
            'cart' => $cart,
            'total_cost' => $total_count_cost['total_cost'],
        ];
    }

    //добавление заказа в БД
    public function add($data){
        echo $data;
    }

    public function getHeaderLinks()
    {
        $links = parent::getHeaderLinks();
        return $links;
    }

    public function getScripts(){
        return
            str_replace('@', Config::get('js_jquery'), Config::get('js')) .
            str_replace('@', Config::get('js_authorisation'), Config::get('js'));
    }

}