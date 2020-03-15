<?php

class Admin_itemsController extends Controller
{
    public $title = 'Управление товарами';
    public $view_dir = 'admin/items';
    private $error = false;//ошибка добавления

    public function __construct()
    {
        //этот контроллер только для админа
        parent::__construct();
        UserModel::this_is_admin($this->user_role);
    }

    public function index($data)
    {
        return ['items' => ItemsModel::get_all_items(), 'result' => $this->error];
    }

    public function add($data)
    {
        $this->error = ItemsModel::add_item($_POST['name'], $_POST['cost'], $_POST['description'], $_FILES['photo']);
        $this->view_name = 'index';
        return $this->index($data);
    }

    public function edit($data){
        return ItemsModel::get_item($data['id']);
//        $this->error = ItemsModel::edit_item($_POST['name'], $_POST['cost'], $_POST['description'], $_FILES['photo']);
    }
}