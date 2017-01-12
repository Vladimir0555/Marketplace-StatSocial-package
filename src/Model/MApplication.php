<?php

namespace Model;
use Core\BaseModel;

if (!defined('RAPID_IN')) exit('No direct script access allowed');

/**
 * MApplication Model
 */
class MApplication extends BaseModel
{
    // Process route: api/StatSocial/getApplicationStatus/
    public function getStatus()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey']);
        if($response){
            return $response;
        }
        // Prepare parameter for sending
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key'
        ]);
        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/applications/status/', $sendingParam, 'GET');

        return json_encode($result);
    }
}
