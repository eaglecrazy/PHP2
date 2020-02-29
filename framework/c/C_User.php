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
    private $wrong_password = false;

    public function __construct($login, $password)
    {
        if ($login && $password && authorisation($login, $password)) {
            $this->auth = true;
            set_cookies($login, $password);
        }
        //если не пройдена авторизация, но пароль или логин были, то они неправильные
        //в экшене нужно сообщить об ошибке
        else if ($login || $password) {
            $this->wrong_password = true;
        }
    }

    public function action_auth()
    {
        $this->title .= AUTH;
        $this->content = template('v_auth.tmpl', ['wrong_password' => $this->wrong_password]);
    }

    public function action_enter()
    {
        $this->title .= CONST_EXIT;
        $this->content = template('v_account.tmpl', ['name' => $_COOKIE['active-user']]);
    }
}