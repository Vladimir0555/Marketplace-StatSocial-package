<?php

namespace Tests;

/**
 * Api Route Test
 */
class ApiRouteTest extends \PHPUnit_Framework_TestCase
{
    protected $router;

    protected function setUp()
    {
        define('RAPID_IN', TRUE);
        define( 'INDEX_PATH', '/' );

        // Init Blocks path
        $this->router = include_once dirname(__DIR__) . '/Core/routes.php';
    }

    public function testRouts()
    {
        $routes = [
            ['route' => '/api/StatSocial/', 'method' => 'GET'],
            ['route' => '/api/StatSocial/getReports/'],
            ['route' => '/api/StatSocial/getSpecificReportDates/'],
            ['route' => '/api/StatSocial/getReportStatus/'],
            ['route' => '/api/StatSocial/createTwitterFollowerReport/'],
            ['route' => '/api/StatSocial/generateCustomReport/'],
            ['route' => '/api/StatSocial/insertCustomReport/'],
            ['route' => '/api/StatSocial/createCustomReport/'],
            ['route' => '/api/StatSocial/createTweetReport/'],
            ['route' => '/api/StatSocial/getApplicationStatus/']
        ];

        // Beautify output
        print("\n");
        foreach($routes as $route){
            $method = isset($route['method'])?$route['method']:'POST';
            ob_start(function ($buffer) {
            });
            $this->router->dispatch(
                new \Klein\Request([], [], [], [
                    'REQUEST_METHOD' => $method,
                    'REQUEST_URI' => $route['route']
                ], [], null)
            );
            ob_end_flush();

            // Output Test info
            print($this->router->response()->code() . ' - ' . $route['route'] . "\n");
            $this->assertEquals(200, $this->router->response()->code());
        }
        // Beautify output
        print("\n");
    }
}