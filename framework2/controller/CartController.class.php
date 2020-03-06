<?php

class CartController extends Controller
{
    public $view = 'index';
    public $title = '';

    function index($data)
    {

    }

    function add($data)
    {
        CartModel::add_item($data['id']);
    }

    public function getHeaderLinks()
    {
        return [];
    }
}