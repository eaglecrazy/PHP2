<?php

class RegistrationController extends Controller
{
    public $view = 'registration';
    public $title = 'Регистрация';
    public $reg_error = false;

    function index($data){
        return ['error' => $this->reg_error];
    }

    public function getScripts(){
        return
            str_replace('@', Config::get('js_jquery'), Config::get('js')) .
            str_replace('@', Config::get('js_authorisation'), Config::get('js'));
    }
}