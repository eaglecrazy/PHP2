<?php

class IndexController extends Controller
{
    public $view_dir = 'index';
    public $title = 'Магазин "Замок Дракулы"';

    //метод, который отправляет в представление информацию в виде переменной content_data
    public function index($data){
        return IndexModel::getAllItems();
    }

    public function getHeaderLinks(){
        $links = parent::getHeaderLinks();
        $links['index'] = '#';
        return $links;
    }

    public function getScripts(){
        return
            str_replace('@', Config::get('js_jquery'), Config::get('js')) .
            str_replace('@', Config::get('js_authorisation'), Config::get('js'));
    }
}