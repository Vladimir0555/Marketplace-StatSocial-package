<?php

require '../vendor/autoload.php';
//header('Content-type: application/json');

use Core\BaseModel;
use Model\MGetReports;

error_reporting(E_ALL);
if(!defined('ENT_HTML5')){
    define('ENT_HTML5', (16|32));
}
define('RAPID_IN', TRUE);

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
// Metatdata
$klein->respond('GET', INDEX_PATH, function(){
    $baseModel = new BaseModel();
    $baseModel->showMetadata();
});
// /api/StatSocial/getReports
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/getReports', function(){
    $report = new MGetReports(
        ['apiKey', 'reportHash', 'baseline', 'reportDate', 'sample'],
        'http://api.statsocial.com:80/api/'
    );
    echo $report->run();
    exit(200);
});

$klein->dispatch();
?>