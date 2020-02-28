<?php
require_once 'twig/Autoloader.php';
Twig_Autoloader::register();

try {
    $photo = $_GET["name"];

    // указывае где хранятся шаблоны
    $loader = new Twig_Loader_Filesystem('templates');

    // инициализируем Twig
    $twig = new Twig_Environment($loader);

    // подгружаем шаблон
    $template = $twig->loadTemplate('photo.tmpl');

    // передаём в шаблон переменные и значения
    // выводим сформированное содержание

    $content = $template->render(array ('photo' => $photo));
    echo $content;

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}





