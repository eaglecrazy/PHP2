<?php

class AdduserController extends Controller
{
    function index($data)
    {
        $result = UserModel::addUser($_POST['login'], $_POST['password']);
        //если не удалось добавить
        if (!$result) {
            //вернём контроллер регистрации, установим флаг ошибки регистрации в нём
            $this->redirection = new RegistrationController();
            $this->redirection->reg_error = true;
            return $this->redirection;
        }

        //если всё ок, то нужно перейти на главную страницу
        $_SESSION['login'] = $_POST['login'];
        $this->redirection = new IndexController();
    }
}