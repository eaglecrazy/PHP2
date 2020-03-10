<?php

class RegistrationController extends Controller
{
    public $view_dir = 'registration';
    public $title = 'Регистрация';
    public $reg_error = false;

    function index($data){
        return ['error' => $this->reg_error];
    }

    function error($data){
        $this->reg_error = true;
        $this->view_name = 'index';
        return ['error' => $this->reg_error];
    }

    public function getScripts(){
        return
            str_replace('@', Config::get('js_jquery'), Config::get('js')) .
            str_replace('@', Config::get('js_authorisation'), Config::get('js')) .
            str_replace('@', Config::get('js_registration'), Config::get('js'));
    }
}