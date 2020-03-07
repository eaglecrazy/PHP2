<?php

class CartController extends Controller
{
    public $title = '';
    public $view_dir = 'cart';

    function index($data)
    {

    }

    function add($data)
    {
        return CartModel::add_item($data['id']);
    }

    public function getHeaderLinks()
    {
        return [];
    }
}