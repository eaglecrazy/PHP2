<?php

class CartController extends Controller
{
    public $title = '';
    public $view_dir = 'cart';

    //возвращает данные для рендера корзины
    function index($data)
    {
        $cart = CartModel::get_items();
        $total_count_cost = CartModel::get_total_count_cost($cart);
        return [
            'cart' => $cart,
            'total_cost' => $total_count_cost['total_cost'],
            'total_count' => $total_count_cost['total_count']
        ];
    }

    function add($data)
    {
        return CartModel::add_item($data['id']);
    }

    public function getHeaderLinks()
    {
        $links = parent::getHeaderLinks();
        $links['cart'] = '#';
        return $links;
    }
}