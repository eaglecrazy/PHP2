<?php

class RegistrationController extends Controller
{
    public $view_dir = 'registration';
    public $title = 'Регистрация';

    public function index($data)
    {
        return '';
    }

    public function getScripts()
    {
        return
            str_replace('@', Config::get('js_jquery'), Config::get('js')) .
            str_replace('@', Config::get('js_authorisation'), Config::get('js')) .
            str_replace('@', Config::get('js_registration'), Config::get('js'));
    }
}