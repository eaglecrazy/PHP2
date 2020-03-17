<?php

class Admin_ordersController extends Controller
{
    public $title = 'Управление заказами';
    public $view_dir = 'admin/orders';

    private $is_ajax = false;

    public function __construct()
    {
        //этот контроллер только для админа
        parent::__construct();
        UserModel::this_is_admin($this->user_role);
    }

    public function index($data){
        return OrderModel::get_all_orders();
    }

    public function getScripts(){
        if($this->is_ajax)
            return '';
        return
            str_replace('@', Config::get('js_jquery'), Config::get('js')) .
            str_replace('@', Config::get('js_admin_orders'), Config::get('js'));
    }

    public function show($data){
        $client_id = OrderModel::get_client_id($data['id']);
        $cart =  CartModel::get_items($data['id']);
        $cart =  CartModel::get_items($data['id']);

    }
}