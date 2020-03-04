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
	function index($data){
        return IndexModel::getAllItems();
	}


}