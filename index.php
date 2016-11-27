<?php
/**
 * Created by PhpStorm.
 * User: atellez
 * Date: 24/11/16
 * Time: 11:01
 */

require_once "Request.php";
require_once "Response.php";

spl_autoload('apiAutoload');

function apiAutoload($classname){
    $res = false;

    if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
        if (file_exists(__DIR__ . '/Controller/' . $classname . '.php')) {
            require_once __DIR__ . '/Controller/' . $classname . '.php';
            $res = true;
        }
    } elseif (preg_match('/[a-zA-Z]+Model$/', $classname)) {
        if (file_exists(__DIR__ . '/Model/' . $classname . '.php')) {require_once __DIR__ . '/Model/' . $classname . '.php';
            $res = true;
        }
    }
    return $res;
}


$verb = $_SERVER['REQUEST_METHOD'];


$path_info = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (!empty($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
$url_elements = explode('/', $path_info);

$query_string = null;
if (isset($_SERVER['QUERY_STRING'])) {
    parse_str($_SERVER['QUERY_STRING'], $query_string);
}
$body = file_get_contents("php://input");
if ($body === false) {
    $body = null;
}
$content_type = null;
if (isset($_SERVER['CONTENT_TYPE'])) {
    $content_type = $_SERVER['CONTENT_TYPE'];
}
$accept = null;
if (isset($_SERVER['HTTP_ACCEPT'])) {
    $accept = $_SERVER['HTTP_ACCEPT'];
}


$req = new Request($verb, $url_elements, $query_string, $body, $content_type, $accept);


$controller_name = ucfirst($url_elements[1]) . 'Controller';
if (class_exists($controller_name)) {
    $controller = new $controller_name();
    $action_name = 'manage' . ucfirst(strtolower($verb)) . 'Verb';
    $controller->$action_name($req);

}
else {
    $controller = new NotFoundController();
    $controller->manage($req);
}
