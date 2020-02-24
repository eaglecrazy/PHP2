<?php

require_once 'vendor/twig/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

try {
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment();
    $template = $twig->loadTemplate('thanks.tmpl');
} catch (Exception $e) {

}



//    $content = $template->render(array(
//        'username' => 'username'));
//    echo $content;