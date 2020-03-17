<?php

class Admin_itemsController extends Controller
{
    public $title = 'Управление товарами';
    public $view_dir = 'admin/items';

    private $is_edit = false;//от этого зависит какие подключаются скрипты
    private $is_ajax = false;

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

    public function edit($data)
    {
        //если нет товара с таким id то выходим
        if (ItemsModel::get_item($data['id']) === null) {
            header('Location: index.php?path=admin_items');
            die();
        }

        //посылаем данные о том, что отредактировали
        if ($_REQUEST['asAjax']) {//это редактирование
            $this->is_ajax = true;
            $this->title = '';
            return ItemsModel::edit_item($data['id'], $_POST['name'], $_POST['cost'], $_POST['description'], $_FILES['photo']);
        }

        //просто показываем страничку редактирования
        $this->is_edit = true;//для добавления скриптов
        return ItemsModel::get_item($data['id']);
    }

    public function delete($data){
        ItemsModel::delete_item($data['id']);
        header('Location: index.php?path=admin_items');
        die();
    }

    public function getScripts()
    {
        if ($this->is_ajax)
            return '';
        $result =
            str_replace('@', Config::get('js_jquery'), Config::get('js')) .
            str_replace('@', Config::get('js_authorisation'), Config::get('js'));
        if ($this->is_edit)
            $result .=
                str_replace('@', Config::get('js_validation'), Config::get('js')) .
                str_replace('@', Config::get('js_edit_item'), Config::get('js'));
        return $result;
    }

    public function getHeaderLinks(){
        if($this->is_ajax)
            return '';
        $links = parent::getHeaderLinks();
        return $links;
    }
}