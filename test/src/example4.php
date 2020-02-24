<?php
// формируем массив
$items = array(
  'eye of newt',
  'wing of bat',
  'leg of frog',
  'hair of beast'
);

include 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
  $loader = new Twig_Loader_Filesystem('templates');
  
  $twig = new Twig_Environment($loader);
  
  $template = $twig->loadTemplate('list.tmpl');

  echo $template->render(array (
    'items' => $items
  ));
  
} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
?>