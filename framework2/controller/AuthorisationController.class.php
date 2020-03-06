<?php

class AuthorisationController extends Controller
{
    public $view = 'authorisation';
    public $title = '';

    function index($data)
    {
        if (!$_POST['login'] || !$_POST['password'])
            return '';

        if (!UserModel::authorisation($_POST['login'], $_POST['password'])) {
            $this->view = 'authorisation_error';
            return;
        }
        //если всё ок, то перезагрузим страницу
        $str = explode('index.php', $_SERVER['HTTP_REFERER'])[1];
        $link = 'index.php' . $str;

        header("Location: $link");
//        $this->redirection = new IndexController;
//        return $this->redirection;
    }

    public function getHeaderLinks()
    {
        return [];
    }
}