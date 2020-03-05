<?php

class AuthorisationController extends Controller
{
    public $view = 'authorisation';
    public $title = '';

    //метод, который отправляет в представление информацию в виде переменной content_data
    function index($data){
        return '';
    }

    public function getHeaderLinks(){
        return [];
    }
}