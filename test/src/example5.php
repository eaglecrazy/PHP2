<?php
// готовим ассоциативный массив
$book = array(
  'title'     => 'Harry Potter and the Deathly Hallows',
  'author'    => 'J. K. Rowling',
  'publisher' => 'Scholastic',
  'category'  => 'Children\'s fiction',
  'pages'     => '784'
);

include 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
  $loader = new Twig_Loader_Filesystem('templates');
  
  $twig = new Twig_Environment($loader);
  
  $template = $twig->loadTemplate('book.tmpl');

  echo $template->render(array (
    'book' => $book
  ));
  
} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
?>