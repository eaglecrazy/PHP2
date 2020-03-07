<?php

abstract class Controller
{
    public $view_dir = 'index';
    public $view_name = 'index';
    public $title = '';
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

    public function getView(){
        return $this->view_dir . '/' . $this->view_name . '.twig';// например "index/index.html"
    }
}