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
  /*spl_autoload_register(function($className){
    require_once 'libraries/'. $className . '.php';
  });*/
  //Load composer
  require_once APP_ROOT.'/../vendor/autoload.php';
  require_once 'helpers/phpmailer.php';
  //Load Telerik Library
  require_once APP_ROOT.'/libraries/Kendo/Autoload.php';
