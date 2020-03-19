<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TemplaterModel
{
    static function renderPage($view, $data = [])
    {
        //twig 2.12.6-DEV
        try {
            $loader = new FilesystemLoader(Config::get('path_templates'));
//            $twig = new Environment($loader);

            //отладка - полезная штука
            //<pre> {{ dump(content_data) }} </pre>
            $twig = new Environment($loader, ['debug' => true]);
            $twig->addExtension(new \Twig\Extension\DebugExtension());

            $content = $twig->render($view, $data);
            return $content;
        } catch (Exception $e) {
            die ('ERROR: ' . $e->getMessage());
        }
    }
}