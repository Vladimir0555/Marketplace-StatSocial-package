<?php

namespace Core;
if ( ! defined( 'RAPID_IN' ) ) exit( 'No direct script access allowed' );

/**
 * Base Model
 */
class BaseModel
{
    protected $http;
    protected $param;

    public function __construct($paramList = [], $baseUrl = false) {


        $this->param = $this->checkPram($paramList);
        /*
        if($baseUrl){
            $this->http = new \GuzzleHttp\Client(['base_uri' => 'https://foo.com/api/']);
        }else{

        }
        */
    }

    public function showMetadata()
    {
        include_once APP_PATH . '/../src/metadata/metadata.json';
        exit();
    }

    public function checkPram($paramList)
    {
        $requestBody = file_get_contents('php://input');
        //$requestBody = $this->normalizeJson($requestBody);
        //$requestBody = json_decode($requestBody, true);
        var_dump($requestBody);
        exit(200);
        $param = [];
        foreach($paramList as $oneParam){
            $param[$oneParam] = (isset($_POST[$oneParam]))?$_POST[$oneParam]:false;
        }
        return $param;
    }

    protected function validateParam($requiredPram = [], $jsonParams = [])
    {
        if(count($requiredPram)>0){
            $requiredPram = $this->checkRequiredPram($requiredPram);
            if(count($requiredPram)>0){
                $response = [];
                $response['callback'] = 'error';
                $response['contextWrites']['to']['status_code'] = "REQUIRED_FIELDS";
                $response['contextWrites']['to']['status_msg'] = "Please, check and fill in required fields.";
                $response['contextWrites']['to']['fields'] = $requiredPram;
                return json_encode($response);
            }
        }
        if(count($jsonParams)>0){
            $jsonParams = $this->checkJsonParams($jsonParams);
            if(count($jsonParams)>0){
                $response = [];
                $response['callback'] = 'error';
                $response['contextWrites']['to']['status_code'] = 'JSON_VALIDATION';
                $response['contextWrites']['to']['status_msg'] = "Syntax error. Incorrect input JSON. Please, check fields withJSON input.";
                $response['contextWrites']['to']['fields'] = $jsonParams;
                return json_encode($response);
            }
        }
        return false;
    }

    protected function checkRequiredPram($requiredPram = [])
    {
        $result = [];
        foreach($requiredPram as $oneParam){
            if($this->param[$oneParam] == false){
                array_push($result, $oneParam);
            }
        }
        return $result;
    }

    protected function checkJsonParams($jsonParams = [])
    {
        $result = [];
        foreach($jsonParams as $oneParam){
            if($this->param[$oneParam] != false){
                $this->param[$oneParam] = $this->normalizeJson($this->param[$oneParam]);
                var_dump($this->param[$oneParam]);
                $parsedJson = json_decode($this->param[$oneParam], true);
                if(json_last_error() != 0) {
                    array_push($result, $oneParam);
                }
            }
        }
        return $result;
    }

    protected function normalizeJson( $jsonObject )
    {
        return preg_replace_callback( '~"([\[{].*?[}\]])"~s', function ( $match ) {
            return preg_replace( '~\s*"\s*~', "\"", $match[1] );
        }, $jsonObject );
    }
}
