<?php

namespace Tests;

/**
 * Api Route Test
 */
class ApiRouteTest extends \PHPUnit_Framework_TestCase
{
    protected $http;
    protected $apiIndex;

    protected function setUp()
    {
        /*
        $inPath = trim( str_replace( 'index.php', '', trim( $_SERVER['SCRIPT_NAME'], '\/\\' ) ), '\/\\' );
        if( strlen( trim( $inPath ) ) > 0 ){
            $this->apiIndex = '/' . $inPath . '/';
        }else{
            $this->apiIndex = '/';
        }
        // create our http client (Guzzle)
        $this->http = new \GuzzleHttp\Client();
        */
    }
    // Metatdata
    public function testMetatdata()
    {
        /*
        $request = $this->http->request('GET', '../../..'.$this->apiIndex);
        $response = $request->send();
        $this->assertEquals(200, $response->getStatusCode());
        */
    }
    // api/StatSocial/getReports
    // api/StatSocial/getSpecificReportDates
    // api/StatSocial/getReportStatus
    // api/StatSocial/createTwitterFollowerReport
    // api/StatSocial/createCustomReport
    // api/StatSocial/createTweetReport
    // api/StatSocial/getApplicationStatus

}

?>