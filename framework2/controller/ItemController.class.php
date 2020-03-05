<?php

class ItemController extends Controller
{
    public $view = 'item';
    public $title;

    //метод, который отправляет в представление информацию в виде переменной content_data
    function index($data){
        $item = ItemModel::getItem($data['id']);
        $this->title = $item['name'];
        return $item;
    }

    public function getHeaderLinks(){
        return parent::getHeaderLinks();
    }

    public function getScripts(){
        return
            str_replace('@', Config::get('js_jquery'), Config::get('js')) .
            str_replace('@', Config::get('js_authorisation'), Config::get('js'));
    }
}