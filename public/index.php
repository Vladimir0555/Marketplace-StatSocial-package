<?php

session_cache_limiter(false);
error_reporting(E_ALL);
if(!defined('ENT_HTML5')){
    define('ENT_HTML5', (16|32));
}
define('RAPID_IN', TRUE);

$loader = require '../vendor/autoload.php';
//$loader->add('Core\\', '/var/www/statsocial/src/core/');
session_start();
// Directory separator
define ('DS', DIRECTORY_SEPARATOR);
$inPath = trim( str_replace( 'index.php', '', trim( $_SERVER['SCRIPT_NAME'], '\/\\' ) ), '\/\\' );
if( strlen( trim( $inPath ) ) > 0 ){
    define( 'INDEX_PATH', '/' . $inPath . '/' );
}else{
    define( 'INDEX_PATH', '/' );
}
define( 'APP_PATH', __DIR__ );
define( 'HTTP_HOST', $_SERVER['HTTP_HOST'] );

// Init the Block
$klein = new \Klein\Klein();
$klein->respond('GET', INDEX_PATH, function(){
    //include_once '../src/core/BaseModel.php';
    $baseModel = new \Core\BaseModel();
    $baseModel->showMetadata();
});

$klein->dispatch();
/*
$router = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $rout) {
    // Metatdata
    echo 333;
    $rout->addRoute('GET', '/', function(){
        echo 444;
        //$baseModel = new \Models\BaseModel();
        //$baseModel.showMetadata();
    });
    $rout->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
    $rout->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});


function get_all_users_handler(){
    echo 111;
}
function get_user_handler(){
    echo 222;
}
function get_article_handler(){
    echo 333;
}
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/statsocial/public/', 'get_all_users_handler');
    // {id} must be a number (\d+)
    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
    // The /{title} suffix is optional
    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];



// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        echo 'call $handler with $vars';
        break;
}
*/
echo '<pre>';
var_dump(1);
echo '</pre>';
?>