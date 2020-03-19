<?php

class UserController extends Controller
{

    public $title = '';

    function add_user($data)
    {
        $result = UserModel::add_user($_POST['login'], $_POST['password']);
        //если не удалось добавить
        if (!$result) {
            $this->view_name = 'error';
            $this->view_dir = 'registration';
            return false;
        }

        //если всё ок, то отправим ОК
        UserModel::enter_account($_POST['login'], $_POST['password']);
        die('OK');
    }

    function exit($data)
    {
        UserModel::exit_account();
        header("Location: index.php");
        die();
    }
}