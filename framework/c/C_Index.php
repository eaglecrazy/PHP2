<?php

class C_Index extends C_Controller
{
    //вывод страницы чтения текста
    public function action_index()
    {
        $this->title .= '::Чтение';
        $text = text_get();
        $this->content = template('v_text.tmpl', array('text' => $text));
    }

    //вывод страницы редактирования текста
    public function action_edit()
    {
        $this->title .= '::Редактирование';
        if ($this->isPost()) {
            text_set($_POST['text']);
            header('location: index.php');
            exit();
        }
        $text = text_get();
        $this->content = template('v_edit.tmpl', array('text' => $text));
    }
}
