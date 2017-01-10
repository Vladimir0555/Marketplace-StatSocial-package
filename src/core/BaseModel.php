<?php

namespace Models;
if ( ! defined( 'RAPID_IN' ) ) exit( 'No direct script access allowed' );

/**
 * Base Model
 */
class BaseModel
{
    public function __construct() {}

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