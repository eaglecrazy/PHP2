<?php
//
// Базовый класс контроллера.
//
abstract class C_Controller
{
    protected $title;        // заголовок страницы
    protected $content;        // содержание страницы

    public function renderPage()
    {
        $vars = array('title' => $this->title, 'content' => $this->content);
        $page = $this->Template('v_index.tmpl', $vars);
        echo $page;
    }

    protected function before()
    {
        $this->title = 'Название сайта';
        $this->content = '';
    }

    public function Request($action)
    {


        $this->before();
        $this->$action();   //$this->action_index
        $this->renderPage();
    }

    //
    // Запрос произведен методом POST?
    //
    protected function IsPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    //
    // Генерация HTML шаблона в строку.
    //
    protected function Template($fileName, $vars)
    {
//		// Установка переменных для шаблона.
////		foreach ($vars as $k => $v)
////		{
////			$$k = $v;
////		}
////
////		// Генерация HTML в строку.
////		ob_start();
////		include "$fileName";
////		return ob_get_clean();


        try {
            require_once 'm/twig/Autoloader.php';
            Twig_Autoloader::register();

            // указывае где хранятся шаблоны
            $loader = new Twig_Loader_Filesystem('v-twig');

            // инициализируем Twig
            $twig = new Twig_Environment($loader);

            // подгружаем шаблон
            $template = $twig->loadTemplate($fileName);

            // передаём в шаблон переменные и значения
            // выводим сформированное содержание

            $content = $template->render($vars);
            return $content;

        } catch (Exception $e) {
            die ('ERROR: ' . $e->getMessage());
        }


    }

    // Если вызвали метод, которого нет - завершаем работу
    public function __call($name, $params)
    {
        die('Не пишите фигню в url-адресе!!!');
    }
}
