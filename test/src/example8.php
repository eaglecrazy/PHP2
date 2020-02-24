<?php
include 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
  $loader = new Twig_Loader_Filesystem('templates');
  
  $twig = new Twig_Environment($loader);
  
  $template = $twig->loadTemplate('filters.tmpl');

  echo $template->render(array ());
  
} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
?>

