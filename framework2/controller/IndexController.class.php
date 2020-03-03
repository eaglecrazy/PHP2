<?php

class IndexController extends Controller
{
    public $view = 'index';
    public $title;

    function __construct()
    {
        parent::__construct();
        $this->title .= ' | Главная';
    }
	
	//метод, который отправляет в представление информацию в виде переменной content_data
	function index($data){
        //тут можно сделать объект модели и вывести список товаров
		 return 'И данные которые вернул контроллер IndexController';
	}
}