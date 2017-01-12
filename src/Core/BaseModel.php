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

    public function __construct($paramList = []) {
        $this->param = $this->checkPram($paramList);
        $httpConfig = [];
        $this->http = new \GuzzleHttp\Client($httpConfig);
    }

    // Process route: api/StatSocial/
    public function showMetadata()
    {
        include_once dirname(__DIR__) . '/metadata/metadata.json';
    }

    public function checkPram($paramList)
    {
        $requestBody = file_get_contents('php://input');
        if(strlen($requestBody)>0){
            $requestBody = $this->normalizeJson($requestBody);
            $requestBody = str_replace('\"', '"', $requestBody);
            $requestBody = json_decode($requestBody, true);
            if(json_last_error() != 0) {
                $response = [];
                $response['callback'] = 'error';
                $response['contextWrites']['to']['status_code'] = 'JSON_VALIDATION';
                $response['contextWrites']['to']['status_msg'] = "Syntax error. Incorrect input JSON. Please, check fields withJSON input.";
                echo json_encode($response);
                exit(200);
            }
            $jsonParam = $requestBody['args'];
            $param = [];
            foreach($paramList as $oneParam){
                $param[$oneParam] = (isset($jsonParam[$oneParam]))?$jsonParam[$oneParam]:false;
            }

            return $param;
        }else{
            return [];
        }
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
            if(!isset($this->param[$oneParam]) || $this->param[$oneParam] == false){
                array_push($result, $oneParam);
            }
        }

        return $result;
    }

    protected function checkJsonParams($jsonParams = [])
    {
        $result = [];
        foreach($jsonParams as $oneParam){
            $paramVal = $this->param[$oneParam];
            if(!isset($this->param[$oneParam]) || $paramVal != false){
                if(!is_array($paramVal)) {
                    array_push($result, $oneParam);
                }
            }
        }

        return $result;
    }

    protected function prepareParam($dictionary = [])
    {
        $result = [];
        foreach($this->param as $paramName => $paramVal){
            if(count($dictionary)>0) {
                if ($paramVal != false && isset($dictionary[$paramName])) {
                    $result[$dictionary[$paramName]] = $paramVal;
                }
            }else{
                if ($paramVal != false) {
                    $result[$paramName] = $paramVal;
                }
            }
        }

        return $result;
    }

    protected function httpRequest($url, $param, $method = 'POST')
    {
        $result = [];
        try {
            $vendorResponse = $this->http->request($method, $url, ['form_params' => $param]);
            $responseBody = $vendorResponse->getBody()->getContents();

            $result['callback'] = 'success';
            if(empty(json_decode($responseBody))) {
                $result['contextWrites']['to'] = $responseBody;
            } else {
                $result['contextWrites']['to'] = json_decode($responseBody, true);
            }
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $responseBody = $exception->getResponse()->getBody()->getContents();
            if(empty(json_decode($responseBody))) {
                $out = $responseBody;
            } else {
                $out = json_decode($responseBody, true);
            }
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = $out;
        } catch (\GuzzleHttp\Exception\UnhandledException $exception) {
            $responseBody = $exception->getResponse()->getBody()->getContents();
            if(empty(json_decode($responseBody))) {
                $out = $responseBody;
            } else {
                $out = json_decode($responseBody, true);
            }
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = $out;
        } catch (\GuzzleHttp\Exception\ServerException $exception) {
            $responseBody = $exception->getResponse()->getBody()->getContents();
            if(empty(json_decode($responseBody))) {
                $out = $responseBody;
            } else {
                $out = json_decode($responseBody, true);
            }
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = $out;
        } catch (\GuzzleHttp\Exception\ConnectException $exception) {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
            $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';
        }

        return $result;
    }

    protected function normalizeJson($jsonObject)
    {
        return preg_replace_callback('~"([\[{].*?[}\]])"~s', function($match){
            return preg_replace('~\s*"\s*~', "\"", $match[1]);
        }, $jsonObject);
    }
}