<?phpinclude_once('m/model.php');function __autoload($classname){    include_once("c/$classname.php");}$action = 'action_';$action .= (isset($_REQUEST['action'])) ? $_REQUEST['action'] : 'index';switch ($_REQUEST['control']) {    case 'user':        $controller = new C_User();        break;    default:    {        $controller = new C_Index();    }}$controller->Request($action);