<?php

abstract class C_Controller
{
    protected $title = 'Название сайта';
    protected $content = '';

    protected function renderPage()
    {
        $page = template('v_page.tmpl', [
            'title' => $this->title,
            'content' => $this->content,
            'auth' => check_auth()]);
        echo $page;
    }

    public function Request($action)
    {
        $this->$action();
        $this->renderPage();
    }

    protected function IsPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    // Если вызвали метод, которого нет - завершаем работу
    public function __call($name, $params)
    {
        die('Не пишите фигню в url-адресе!!!');
    }
}
