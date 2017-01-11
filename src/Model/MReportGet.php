<?php

namespace Model;
use Core\BaseModel;
if ( ! defined( 'RAPID_IN' ) ) exit( 'No direct script access allowed' );

/**
 * Get Reports Model
 */
class MReportGet extends BaseModel
{
    public function reports()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'reportHash']);
        if($response){
            return $response;
        }
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key',
            'reportHash' => 'report_hash',
            'baseline' => 'baseline',
            'reportDate' => 'report_date',
            'sample' => 'sample'
        ]);

        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/reports/', $sendingParam);

        return json_encode($result);
    }

    public function specificDates()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'reportHash']);
        if($response){
            return $response;
        }
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key',
            'reportHash' => 'report_hash'
        ]);

        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/reports/dates/', $sendingParam);

        return json_encode($result);
    }

    public function status()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'reportHash']);
        if($response){
            return $response;
        }
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key',
            'reportHash' => 'report_hash'
        ]);

        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/reports/status/', $sendingParam);

        return json_encode($result);
    }
}
