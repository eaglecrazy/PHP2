<?php
include 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
  $loader = new Twig_Loader_Filesystem('templates');
  
  $twig = new Twig_Environment($loader);
  
  $template = $twig->loadTemplate('seasons.tmpl');

  // получаем номер месяца
  $month = date('m', mktime());

  echo $template->render(array (
    'month' => $month
  ));
  
} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}

/*
$y=rand(0,2);

try{
  $x = 10 / $y;
}
catch(Exception $e){
   die ('Возникла ошибка: ' . $e->getMessage());
}
*/
?>


