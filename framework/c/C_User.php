<?php


class C_User extends C_Controller
{
    public function action_auth(){
        $this->title .= '::Авторизация';
        $text = 'Авторизация';
        $this->content = $this->Template('v/v_text.tmpl', array('text' => $text));
    }
}