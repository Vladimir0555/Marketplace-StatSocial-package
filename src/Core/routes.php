<?php

use Core\BaseModel;
use Model\MReportGet;
use Model\MReportCreate;
use Model\MApplication;

if (!defined('RAPID_IN')) exit('No direct script access allowed');

$klein = new \Klein\Klein();
http_response_code (200);
// Metatdata
// api/StatSocial/
$klein->respond('GET', INDEX_PATH . 'api/StatSocial/?', function(){
    $baseModel = new BaseModel();
    $baseModel->showMetadata();
});
// MReportGet
// api/StatSocial/getReports/
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/getReports/?', function(){
    $report = new MReportGet(['apiKey', 'reportHash', 'baseline', 'reportDate', 'sample']);
    echo $report->reports();
});
// api/StatSocial/getSpecificReportDates/
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/getSpecificReportDates/?', function(){
    $report = new MReportGet(['apiKey', 'reportHash']);
    echo $report->specificDates();
});
// api/StatSocial/getReportStatus/
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/getReportStatus/?', function(){
    $report = new MReportGet(['apiKey', 'reportHash']);
    echo $report->status();
});
// MReportCreate
// api/StatSocial/createFollowerReportByTwitterId/
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/createFollowerReportByTwitterId/?', function(){
    $report = new MReportCreate(['apiKey', 'twitterId', 'genderFilter', 'agesFilter', 'countriesFilter']);
    echo $report->twitterFollowerId();
});
// MReportCreate
// api/StatSocial/createFollowerReportByTwitterHandle/
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/createFollowerReportByTwitterHandle/?', function(){
    $report = new MReportCreate(['apiKey', 'twitterHandle', 'genderFilter', 'agesFilter', 'countriesFilter']);
    echo $report->twitterFollowerHandle();
});
// api/StatSocial/generateCustomReport/
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/generateCustomReport/?', function(){
    $report = new MReportCreate(['apiKey', 'reportName']);
    echo $report->customGenerate();
});
// api/StatSocial/insertCustomReport/
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/insertCustomReport/?', function(){
    $report = new MReportCreate(['apiKey', 'uploadHash', 'ids']);
    echo $report->customInsert();
});
// api/StatSocial/createCustomReport/
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/createCustomReport/?', function(){
    $report = new MReportCreate(['apiKey', 'uploadHash', 'genderFilter', 'agesFilter', 'countriesFilter']);
    echo $report->customCreate();
});
// api/StatSocial/createTweetReport/
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/createTweetReport/?', function(){
    $report = new MReportCreate(['apiKey', 'reportName', 'startDate', 'endDate', 'terms', 'genderFilter', 'agesFilter', 'countriesFilter']);
    echo $report->tweet();
});
// MApplication
// api/StatSocial/getApplicationStatus/
$klein->respond('POST', INDEX_PATH . 'api/StatSocial/getApplicationStatus/?', function(){
    $report = new MApplication(['apiKey']);
    echo $report->getStatus();
});

return $klein;