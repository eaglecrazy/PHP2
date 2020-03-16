<?php
$config['db_user'] = 'root';
$config['db_password'] = '';
$config['db_base'] = 'shop2';
$config['db_host'] = 'localhost';
$config['db_port'] = '3306';
$config['db_charset'] = 'UTF8';

//ссылки
$config['link_index'] = 'index.php';
$config['link_cart'] = $config['link-index'] . '?path=cart';

//пути
$config['path_root'] = __DIR__;
$config['path_templates'] = $config['path_root'] . '/../templates';
$config['photo-small'] = $config['path_templates'] . '/img/small';
$config['photo-big'] = $config['path_templates'] . '/img/big';


//скрипты
$config['js'] = '<script defer src="js/@"></script>';

$config['js_jquery'] = 'jquery.js';
$config['js_authorisation'] = 'authorisation.js';
$config['js_item'] = 'item.js';
$config['js_cart'] = 'cart.js';
$config['js_registration'] = 'registration.js';
$config['js_order'] = 'order.js';
$config['js_validation'] = 'validation.js';
$config['js_edit_item'] = 'edit_item.js';
