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
}