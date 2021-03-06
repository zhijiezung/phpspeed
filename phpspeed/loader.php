<?php

/*
| phpspeed loader file
|--------------------------------------------------------------------------------------
| Author  : Peng Zeng
| www     : http://www.phpspeed.top
| version : 1.0
|--------------------------------------------------------------------------------------
*/





// phpspeed version
const PHPSPEED_VERSION = '1.0.1';

// template files suffix
const TEMPLATE_SUFFIX  = '.php';

// files suffix
const FILES_SUFFIX     = '.php';

// files suffix
const CACHE_SUFFIX     = '.php';


// start debug
define( 'APP_DEBUG', true );

// dir
define( 'PHP_SPEED', __DIR__ );

// phpspeed path
define( 'APP_PATH', PHP_SPEED );

// config path
define( 'CONFIG_PATH', APP_PATH.'/config/' );

// controller path
define( 'CONTROLLER_PATH', APP_PATH.'/controller' );

// template files path
define( 'TEMPLATE_PATH', APP_PATH.'/template' );

// cache path
define( 'RUNTIME_PATH', APP_PATH.'/runtime/cache' );

// logs path
define( 'LOGS_PATH', APP_PATH.'/runtime/logs' );

// controller namespace name
define( 'CONTROLLER_NAMESPACE', 'controller' );

// now time
define( 'NOW_TIME', $_SERVER['REQUEST_TIME'] );

if(isset($argv)) {
    define( 'PATH_INFO', $argv[1] );
    isset($argv[2]) && define( 'PATH_PARAM', $argv[2] );
} else
    define('PATH_INFO', str_replace( '//', '/', isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '' ) );

// template data
$_extract = [];


// include kernel
include(APP_PATH.'/library/kernel'.FILES_SUFFIX);

// start phpspeed
library\kernel::init();
