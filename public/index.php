<?php
require dirname(__DIR__) . '/vendor/autoload.php';
header('Content-type: application/json');
define('RAPID_IN', TRUE);

$inPath = trim(str_replace('index.php', '', trim($_SERVER['SCRIPT_NAME'], '\/\\' )), '\/\\');
if( strlen(trim($inPath)) > 0){
    define('INDEX_PATH', '/' . $inPath . '/');
}else{
    define('INDEX_PATH', '/');
}
define('APP_PATH', __DIR__);
define('HTTP_HOST', $_SERVER['HTTP_HOST']);

// Init Blocks path
$klein = include_once  dirname(APP_PATH) . '/src/Core/routes.php';
$klein->dispatch();
http_response_code(200);
$klein->response()->unlock();
$klein->response()->code(200);
exit(200);