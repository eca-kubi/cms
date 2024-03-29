<?php
// Autoload Core Libraries

spl_autoload_register(function($class_name){
    $dirs = array(
            'models/',
            'libraries/',
            'classes/'
        );
    foreach( $dirs as $dir ) {
        if (!file_exists('../app/'. $dir.$class_name.'.php')) {
            continue;
        } else {
            require_once('../app/'.$dir.$class_name.'.php');
        }
    }
});
//Load composer
require_once '../vendor/autoload.php';
//Load Telerik Library
require_once '../app/libraries/Kendo/Autoload.php';

// .Env file loader
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

  // Load Config
require_once 'config/host.php';
require_once 'config/config.php';
// Load Helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/misc_helper.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/file_helper.php';
require_once 'helpers/validation_helper.php';
require_once 'helpers/sms.php';
require_once 'helpers/phpmailer.php';
require_once '../vendor/alexistm/simple-json-php/includes/json.php';
