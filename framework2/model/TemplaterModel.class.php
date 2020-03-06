<?php

class TemplaterModel extends Model
{
    static function renderPage($view, $data = [])
    {
        //twig 2.12.6-DEV
        try {
            $loader = new \Twig\Loader\FilesystemLoader(Config::get('path_templates'));
            $twig = new \Twig\Environment($loader);
            $content = $twig->render($view, $data);
            return $content;
        } catch (Exception $e) {
            die ('ERROR: ' . $e->getMessage());
        }
    }
}