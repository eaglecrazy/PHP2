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
            $twig = new Environment($loader);
            $content = $twig->render($view, $data);
            return $content;
        } catch (Exception $e) {
            die ('ERROR: ' . $e->getMessage());
        }
    }
}