<?php

//1. Разобраться с принципом работы движка.
//2. По образу и подобию модуля авторизации из движка V1.0 создать модуль работы с пользователем:
//а) Пользователь должен уметь входить в систему;
//б) Пользователь должен уметь выходить из системы;
//в) У пользователя должен быть личный кабинет (пока пустой).
//3. *Научить движок запоминать 5 последних просмотренных страниц. Выводить их в личном кабинете блоком «Вы недавно смотрели».

class C_User extends C_Controller
{
    public $auth = false;
    public $reg = false;
    public $reg_error = false;

    public function __construct()
    {
        $login = $_REQUEST['login'];
        $password = $_REQUEST['password'];

        if ($_REQUEST['action'] == 'enter') {
            if (authorisation($login, $password) || check_auth())
                $this->auth = true;
        } elseif ($_REQUEST['action'] == 'registration' && $login && $password) {
            $this->reg = registration($login, $password);
            if (!$this->reg)//если регистрация не прошла
                $this->reg_error = true;
        }
    }

    public function action_auth()
    {
        $this->title .= '::Авторизация';
        $this->content = template('v_auth.tmpl', ['wrong_password' => $_REQUEST['wrong']]);
    }

    public function action_enter()
    {
        if (!$this->auth)//если авторизация в конструкторе не пройдена
            header("Location: index.php?control=user&action=auth&wrong=1");

        $this->title .= '::Личный кабинет';
        $this->content = template('v_account.tmpl', ['name' => $_COOKIE['active-user'], 'history' => get_user_history()]);
    }

    public function action_registration()
    {
        if ($this->reg) {//регистрация в конструкторе пройдена, переходим в ЛК
            $this->title .= '::Личный кабинет';
            $this->content = template('v_account.tmpl', ['name' => $_COOKIE['active-user']]);
        } else {
            $this->title .= '::Регистрация';
            $this->content = template('v_registration.tmpl', ['reg_error' => $this->reg_error]);
        }
    }

    public function action_exit()
    {
        exit_form_account();
        header("Location: index.php");
    }


}