<?php

abstract class Controller
{
    public $view = 'index';
    public $title = '';
    public $redirection = false;
    public $login = null;

    function __construct()
    {
        if($_SESSION['login'])
            $this->login = $_SESSION['login'];
    }

    public function index($data)
    {
        return '';
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