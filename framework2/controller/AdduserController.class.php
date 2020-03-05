<?php
class AdduserController extends Controller
{
//    public $view = 'index';

    function index($data)
    {
        $result  = UserModel::addUser($_POST['login'], $_POST['password']);
        if(!$result)
            echo 'такой юзер уже есть';
        else
            echo 'добавили';
    }
}