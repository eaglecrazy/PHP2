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
        Db::getInstance()->connect($user, $password, $base, $host, $port, $charset);

        //попробуем авторизоваться
        session_start();
        if (!isset($_SESSION['login'])) {
            UserModel::try_authorisation();
        }

        //проанализируем $_GET['path'], информация сохраниться в $_GET
        self::path_analysis();
        //запустим роутер
        self::web();
    }

    //http://site.ru/index.php?path=News/delete/5
    //http://site.ru/index.php?path=item/5
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
            //создадим экземпляр контроллера
            $controller = new $controllerName();
            //строим имя метода, по умолчанию метод index
            //контроллер в процессе выполнения $methodName может изменить $controller->view_name, чтобы показать правильную вьюшку
            $controller->view_name = $methodName = isset($_GET['action']) ? $_GET['action'] : 'index';


            //Ключи данного массива доступны в любой вьюшке
            //Массив data - это массив для использования в любой вьюшке
            $data = [
                'content_data' => $controller->$methodName($_GET),
                'title' => $controller->title,
                'header_links' => $controller->getHeaderLinks(),
                'scripts' => $controller->getScripts(),
                'login' => $controller->login
            ];

            if (!isset($_GET['asAjax'])) {//если запрос делается не как аякс
                echo TemplaterModel::renderPage($controller->getView(), $data);
            } else {//а если это был аякс, то отправим ему данные
                echo json_encode($data);
            }
        }
    }
}