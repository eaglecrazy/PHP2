<?php

abstract class Controller
{
    protected $view = 'index';
    protected $title = 'Название страницы';

    function __construct()
    {
    }

    public function index($data)
    {
        return 'Контроллер';
    }

    public function getHeaderLinks()
    {
        return [
            'index' => Config::get('link_index'),
            'cart' => Config::get('link_cart')
        ];
    }

    public function getScripts(){
        return '';
    }
}