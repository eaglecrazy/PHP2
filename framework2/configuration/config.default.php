<?php
$config['db_user'] = 'root';
$config['db_password'] = '';
$config['db_base'] = 'shop2';
$config['db_host'] = 'localhost';
$config['db_port'] = '3306';
$config['db_charset'] = 'UTF8';

//ссылки
$config['link_index'] = 'index.php';
$config['link_cart'] = $config['link-index'] . 'path=cart';

//пути
$config['path_root'] = __DIR__;
$config['path_templates'] = $config['path_root'] . '/../templates';

$config['js'] = '<script defer src="js/@"></script>';

//скрипты
$config['js_jquery'] = 'jquery.js';
$config['js_authorisation'] = 'authorisation.js';


//$config['path_public'] = $config['path_root'] . '/../public';
//$config['path_model'] = $config['path_root'] . '/../model';
//$config['path_controller'] = $config['path_root'] . '/../controller';
//$config['path_cache'] = $config['path_root'] . '/../cache';
//$config['path_data'] = $config['path_root'] . '/data';
//$config['path_fixtures'] = $config['path_data'] . '/fixtures';
//$config['path_migrations'] = $config['path_data'] . '/../migrate';
//$config['path_commands'] = $config['path_root'] . '/../lib/commands';
//$config['path_libs'] = $config['path_root'] . '/../lib';

//$config['path_logs'] = $config['path_root'] . '/../logs';