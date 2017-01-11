<?php

require '../vendor/autoload.php';
header('Content-type: application/json');

use Core\BaseModel;
use Model\MReportGet;
use Model\MReportCreate;
use Model\MApplication;

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

// Init Blocks path
$klein = new \Klein\Klein();
// Metatdata
$klein->respond('GET', INDEX_PATH, function(){
    $baseModel = new BaseModel();
    $baseModel->showMetadata();
});
// MReportGet
// api/StatSocial/getReports
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/getReports', function(){
    $report = new MReportGet(['apiKey', 'reportHash', 'baseline', 'reportDate', 'sample']);
    echo $report->reports();
    exit(200);
});
// api/StatSocial/getSpecificReportDates
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/getSpecificReportDates', function(){
    $report = new MReportGet(['apiKey', 'reportHash']);
    echo $report->specificDates();
    exit(200);
});
// api/StatSocial/getReportStatus
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/getReportStatus', function(){
    $report = new MReportGet(['apiKey', 'reportHash']);
    echo $report->status();
    exit(200);
});
// MReportCreate
// api/StatSocial/createTwitterFollowerReport
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/createTwitterFollowerReport', function(){
    $report = new MReportCreate(['apiKey', 'twitterId', 'twitterHandle', 'filter']);
    echo $report->twitterFollower();
    exit(200);
});
// api/StatSocial/generateCustomReport
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/generateCustomReport', function(){
    $report = new MReportCreate(['apiKey', 'reportName']);
    echo $report->customGenerate();
    exit(200);
});
// api/StatSocial/insertCustomReport
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/insertCustomReport', function(){
    $report = new MReportCreate(['apiKey', 'uploadHash', 'ids']);
    echo $report->customInsert();
    exit(200);
});
// api/StatSocial/createCustomReport
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/createCustomReport', function(){
    $report = new MReportCreate(['apiKey', 'uploadHash', 'filter']);
    echo $report->customCreate();
    exit(200);
});
// api/StatSocial/createTweetReport
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/createTweetReport', function(){
    $report = new MReportCreate(['apiKey', 'reportName', 'startDate', 'endDate', 'terms', 'filter']);
    echo $report->tweet();
    exit(200);
});
// MApplication
// api/StatSocial/getApplicationStatus
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/getApplicationStatus', function(){
    $report = new MApplication(['apiKey']);
    echo $report->getStatus();
    exit(200);
});
$klein->dispatch();
?>