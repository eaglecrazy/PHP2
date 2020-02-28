<?php
require_once 'twig/Autoloader.php';
Twig_Autoloader::register();

try {
    $photos = scandir("img/small");
    $photos = array_splice($photos, 2);

    // указывае где хранятся шаблоны
    $loader = new Twig_Loader_Filesystem('templates');

    // инициализируем Twig
    $twig = new Twig_Environment($loader);

    // подгружаем шаблон
    $template = $twig->loadTemplate('gallery.tmpl');

    // передаём в шаблон переменные и значения
    // выводим сформированное содержание

    $content = $template->render(array ('photos' => $photos, 'title' => 'Gallery'));
    echo $content;

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}
