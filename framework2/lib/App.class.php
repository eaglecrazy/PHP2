<?php

class App
{
    public static function Init()
    {
        //нельзя работать с сайтом через консоль
        if (!(php_sapi_name() !== 'cli' && isset($_SERVER) && isset($_GET)))
            return;

        //получим из конфига данные для коннекта базы
        $user = Config::get('db_user');
        $password = Config::get('db_password');
        $base = Config::get('db_base');
        $host = Config::get('db_host');
        $port = Config::get('db_port');
        $charset = Config::get('db_charset');
        //соединяемся с БД
        db::getInstance()->Connect($user, $password, $base, $host, $port, $charset);

        //запустим роутер

        //проанализируем $_GET['path'], информация сохраниться в $_GET
        self::path_analysis();
        //запустим роутер
        self::web();
    }

    //http://site.ru/index.php?path=News/delete/5
    //http://php2/framework2/public/index.php?path=index/delete/5

    //http://site.ru/index.php
    //?
    //path
    //=
    //News - имя контроллера
    //   /
    //   /
    //delete - имя метода в контроллере (его может не быть)
    //   /
    //5 - параметр метода или контроллера

    private static function path_analysis()
    {
        $path = $_GET['path'] ? $_GET['path'] : '';
        $path = mb_strtolower($path);
        $path = explode("/", $path);
        //если есть имя контроллера
        if (!empty($path[0])) {
            $_GET['page'] = $path[0];//Часть имени класса контроллера
            //второй параметр
            if (isset($path[1])) {
                //если он числовой, то это id
                if (is_numeric($path[1])) {
                    $_GET['id'] = $path[1];
                } //если он не числовой, то это метод
                else {
                    $_GET['action'] = $path[1];//часть имени метода
                }
                //третий параметр всегда id
                if (isset($path[2])) {//формальный параметр для метода контроллера
                    $_GET['id'] = $path[2];
                }
            }
        } else {
            $_GET['page'] = 'index';
        }
    }


    private static function web()
    {
        if (isset($_GET['page'])) {
            //строим имя контроллера типа IndexController
            $controllerName = ucfirst($_GET['page']) . 'Controller';
            //строим имя метода, по умолчанию метод index
            $methodName = isset($_GET['action']) ? $_GET['action'] : 'index';
            //создадим экземпляр контроллера
            $controller = new $controllerName();

            //Ключи данного массива доступны в любой вьюшке
            //Массив data - это массив для использования в любой вьюшке
            $data = [
                'content_data' => $controller->$methodName($_GET),//получим из метода $methodName контроллера $controller контент
                'title' => $controller->title,//получим титл
                'categories' => Category::getCategories(0)  //РАЗОБРАТЬСЯ ЧЁ ЭТО ЗА ФИГНЯ???
            ];

            //определяем вьюшку которую нужно показать
            $view = $controller->view . '/' . $methodName . '.twig';// например "index/index.html"

            //если запрос делается не как аякс
            if (!isset($_GET['asAjax'])) {
                //работаем с twig
                $loader = new Twig_Loader_Filesystem(Config::get('path_templates'));
                $twig = new Twig_Environment($loader);
                $template = $twig->loadTemplate($view);
                echo $template->render($data);
            }
            else
            {//а если это был аякс, то отправим ему данные
                echo json_encode($data);
            }
        }
    }


}