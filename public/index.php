<?php
session_cache_limiter( false );
error_reporting( E_ALL );
if( ! defined( 'ENT_HTML5' ) ){
    define( 'ENT_HTML5', ( 16|32 ) );
}
define( 'RAPID_IN', TRUE );

$loader = require __DIR__ . '../vendor/autoload.php';
session_start();

// Directory separator
define ('DS', DIRECTORY_SEPARATOR);
define( 'INDEX_PATH', '/' . trim ( str_replace( dirname ( __DIR__ ), '', __DIR__ ), '\\/' ) . '/' );
define( 'APP_PATH', __DIR__ );
define( 'HTTP_HOST', $_SERVER['HTTP_HOST'] );

// Init the Block


?>