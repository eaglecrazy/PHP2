<?php

class CartController extends Controller
{
    public $title = 'Корзина';
    public $view_dir = 'cart';
    private $is_ajax = false;

    //возвращает данные для рендера корзины
    public function index($data)
    {
        $cart = CartModel::get_items();
        $total_count_cost = CartModel::get_total_count_cost_render($cart);
        return [
            'cart' => $cart,
            'total_cost' => $total_count_cost['total_cost'],
            'total_count' => $total_count_cost['total_count']
        ];
    }

    //добавляет предмет в корзину
    public function add($data)
    {
        return CartModel::add_item($data['id']);
    }

    //удаляет предмет из корзины
    public function delete($data){
        $this->is_ajax = true;
        $title = '';
        return CartModel::delete_item($data['id']);
    }

    //изменяет количество предмета в корзине
    public function edit($data){
        $this->is_ajax = true;
        $title = '';
        return CartModel::edit_item($data['id'], $data['count']);
    }

    public function getHeaderLinks()
    {
        if($this->is_ajax)
            return '';
        $links = parent::getHeaderLinks();
        $links['cart'] = '#';
        return $links;
    }

    public function getScripts(){
        if($this->is_ajax)
            return '';
        return
            str_replace('@', Config::get('js_jquery'), Config::get('js')) .
            str_replace('@', Config::get('js_authorisation'), Config::get('js')) .
            str_replace('@', Config::get('js_cart'), Config::get('js'));
    }
}