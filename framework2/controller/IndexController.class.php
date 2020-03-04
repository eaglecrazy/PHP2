<?php

class IndexController extends Controller
{
    public $view = 'index';
    public $title;

    function __construct()
    {
        parent::__construct();
        $this->title = 'Магазин "Замок Дракулы"';
    }

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
            str_replace('@', 'jquery.js', Config::get('js')) .
            str_replace('@', 'authorisation.js', Config::get('js'));
    }
}