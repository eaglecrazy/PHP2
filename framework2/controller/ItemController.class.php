<?php

class ItemController extends Controller
{
    public $view_dir = 'item';

    //метод, который отправляет в представление информацию в виде переменной content_data
    function index($data){
        $item = ItemsModel::get_item($data['id']);
        $this->title = $item['name'];
        return $item;
    }


    public function getScripts(){
        return
            str_replace('@', Config::get('js_jquery'), Config::get('js')) .
            str_replace('@', Config::get('js_authorisation'), Config::get('js')) .
            str_replace('@', Config::get('js_item'), Config::get('js'));
    }
}