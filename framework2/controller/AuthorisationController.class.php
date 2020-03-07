<?php

class AuthorisationController extends Controller
{
    public $view_dir = 'authorisation';

    function index($data)
    {
        if (!$_POST['login'] || !$_POST['password'])
            return '';

        if (!UserModel::authorisation($_POST['login'], $_POST['password'])) {
            $this->view_name = 'authorisation_error';
            return '';
        }
        //если всё ок, то перезагрузим страницу
        $str = explode('index.php', $_SERVER['HTTP_REFERER'])[1];
        $link = 'index.php' . $str;

        header("Location: $link");

    }

    public function getScripts(){
        return
            str_replace('@', Config::get('js_jquery'), Config::get('js')) .
            str_replace('@', Config::get('js_authorisation'), Config::get('js'));
    }
}