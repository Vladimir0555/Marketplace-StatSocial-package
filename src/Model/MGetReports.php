<?php

namespace Model;
use Core\BaseModel;
if ( ! defined( 'RAPID_IN' ) ) exit( 'No direct script access allowed' );

/**
 * Get Reports Model
 */
class MGetReports extends BaseModel
{
    public function run()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'reportHash'], ['sample']);
        if($response){
            return $response;
        }
        // Make request
        //$this->http
    }
}
