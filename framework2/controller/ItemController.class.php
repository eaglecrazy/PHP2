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


}