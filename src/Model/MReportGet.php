<?php

namespace Model;
use Core\BaseModel;

if (!defined('RAPID_IN')) exit('No direct script access allowed');

/**
 * MReportGet Model
 */
class MReportGet extends BaseModel
{
    // Process route: api/StatSocial/getReports/
    public function reports()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'reportHash']);
        if($response){
            return $response;
        }
        // Prepare parameter for sending
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

    // Process route: api/StatSocial/getSpecificReportDates/
    public function specificDates()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'reportHash']);
        if($response){
            return $response;
        }
        // Prepare parameter for sending
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key',
            'reportHash' => 'report_hash'
        ]);
        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/reports/dates/', $sendingParam);

        return json_encode($result);
    }

    // Process route: api/StatSocial/getReportStatus/
    public function status()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'reportHash']);
        if($response){
            return $response;
        }
        // Prepare parameter for sending
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key',
            'reportHash' => 'report_hash'
        ]);
        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/reports/status/', $sendingParam);

        return json_encode($result);
    }
}