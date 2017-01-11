<?php

namespace Model;
use Core\BaseModel;
if ( ! defined( 'RAPID_IN' ) ) exit( 'No direct script access allowed' );

/**
 * Get Reports Model
 */
class MReportCreate extends BaseModel
{
    public function twitterFollower()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey'], ['filter']);
        if($response){
            return $response;
        }
        // Prepare parameter for sending
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key',
            'twitterId' => 'twitter_id',
            'twitterHandle' => 'twitter_handle',
            'filter' => 'filter'
        ]);
        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/reports/twitter/create/', $sendingParam);
        return json_encode($result);
    }

    public function custom()
    {
        /*
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'reportName');
        if($response){
            return $response;
        }
        // Prepare parameter for sending
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key',
            'reportName' => 'report_name'
        ]);
        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/reports/tweet/create/', $sendingParam);
        */
        $result = [];
        return json_encode($result);
    }

    public function tweet()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'reportName', 'startDate', 'endDate', 'terms'], ['terms', 'filter']);
        if($response){
            return $response;
        }
        // Prepare parameter for sending
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key',
            'reportName' => 'report_name',
            'startDate' => 'start_date',
            'endDate' => 'end_date',
            'terms' => 'terms',
            'filter' => 'filter'
        ]);
        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/reports/tweet/create/', $sendingParam);

        return json_encode($result);
    }
}
