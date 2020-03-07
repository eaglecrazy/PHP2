<?php

class AdduserController extends Controller
{
    public $reg_error = false;

    function index($data)
    {
        $result = UserModel::add_user($_POST['login'], $_POST['password']);
        //если не удалось добавить
        if (!$result)
            header("Location: index.php?path=registration/error");

        //если всё ок, то нужно перейти на главную страницу
        UserModel::enter_account($_POST['login'], $_POST['password']);
        header("Location: index.php");
    }
}