<?php

namespace Model;
use Core\BaseModel;

if (!defined('RAPID_IN')) exit('No direct script access allowed');

/**
 * MReportCreate Model
 */
class MReportCreate extends BaseModel
{
    // Process route: api/StatSocial/createFollowerReportByTwitterId/
    public function twitterFollowerId()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'twitterId']);
        if($response){
            return $response;
        }
        // Prepare filter
        $this->prepareFilter(
            $this->param['genderFilter'],
            $this->param['agesFilter'],
            $this->param['countriesFilter']
        );
        // Prepare parameter for sending
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key',
            'twitterId' => 'twitter_id',
            'filter' => 'filter'
        ]);
        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/reports/twitter/create/', $sendingParam);

        return json_encode($result);
    }

    // Process route: api/StatSocial/createFollowerReportByTwitterHandle/
    public function twitterFollowerHandle()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'twitterHandle']);
        if($response){
            return $response;
        }
        // Prepare filter
        $this->prepareFilter(
            $this->param['genderFilter'],
            $this->param['agesFilter'],
            $this->param['countriesFilter']
        );
        // Prepare parameter for sending
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key',
            'twitterHandle' => 'twitter_handle',
            'filter' => 'filter'
        ]);
        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/reports/twitter/create/', $sendingParam);

        return json_encode($result);
    }

    // Process route: api/StatSocial/generateCustomReport/
    public function customGenerate()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'reportName']);
        if($response){
            return $response;
        }
        // Prepare parameter for sending
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key',
            'reportName' => 'report_name'
        ]);
        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/reports/custom/generate/', $sendingParam);

        return json_encode($result);
    }

    // Process route: api/StatSocial/insertCustomReport/
    public function customInsert()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'uploadHash', 'ids']);
        if($response){
            return $response;
        }
        // Prepare parameter for sending
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key',
            'uploadHash' => 'upload_hash',
            'ids' => 'ids'
        ]);
        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/reports/custom/insert/', $sendingParam);

        return json_encode($result);
    }

    // Process route: api/StatSocial/createCustomReport/
    public function customCreate()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'uploadHash']);
        if($response){
            return $response;
        }
        // Prepare filter
        $this->prepareFilter(
            $this->param['genderFilter'],
            $this->param['agesFilter'],
            $this->param['countriesFilter']
        );
        // Prepare parameter for sending
        $sendingParam = $this->prepareParam([
            'apiKey' => 'key',
            'uploadHash' => 'upload_hash',
            'filter' => 'filter'
        ]);
        // Make request
        $result = $this->httpRequest('http://api.statsocial.com:80/api/reports/custom/create/', $sendingParam);

        return json_encode($result);
    }

    // Process route: api/StatSocial/createTweetReport/
    public function tweet()
    {
        // Validate Required and JSON fields
        $response = $this->validateParam(['apiKey', 'reportName', 'startDate', 'endDate', 'terms']);
        if($response){
            return $response;
        }
        // Prepare filter
        $this->prepareFilter(
            $this->param['genderFilter'],
            $this->param['agesFilter'],
            $this->param['countriesFilter']
        );
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