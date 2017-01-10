<?php

namespace Core;
if ( ! defined( 'RAPID_IN' ) ) exit( 'No direct script access allowed' );

/**
 * Base Model
 */
class BaseModel
{
    public function __construct() {}

    public function showMetadata()
    {
        //include_once APP_PATH . 'src/metadata/metadata.json';
        exit();
    }

    protected function normalizeJson( $jsonObject )
    {
        return preg_replace_callback( '~"([\[{].*?[}\]])"~s', function ( $match ) {
            return preg_replace( '~\s*"\s*~', "\"", $match[1] );
        }, $jsonObject );
    }

    /*protected function showOption( $optionName, $param )
    {
        ob_start();

        return ob_get_clean();
    }*/
}
