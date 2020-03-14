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

        UserModel::enter_account($_POST['login'], $_POST['password']);
        //если всё ок, то перезагрузим страницу
        //если находились на странице авторизации (до этого ошиблись паролем), то перейдём на главную
        if (strpos(($_SERVER['HTTP_REFERER']), 'path=authorisation')) {
            $link = 'index.php';
        } else {
            $str = explode('index.php', $_SERVER['HTTP_REFERER'])[1];
            $link = 'index.php' . $str;
        }
        header("Location: $link");
        die();
    }

    public function getScripts()
    {
        return
            str_replace('@', Config::get('js_jquery'), Config::get('js')) .
            str_replace('@', Config::get('js_authorisation'), Config::get('js'));
    }
}