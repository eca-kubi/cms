<?php
  // Load Config
  require_once 'config/config.php';
  require_once 'config/host.php';
  // Load Helpers
  require_once 'helpers/url_helper.php';
  require_once 'helpers/misc_helper.php';
  require_once 'helpers/session_helper.php';
  require_once 'helpers/file_helper.php';
  require_once 'helpers/validation_helper.php';
  require_once 'helpers/sms.php';
  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/'. $className . '.php';
  });
  //Load composer
  require_once APP_ROOT.'/../vendor/autoload.php';
  require_once 'helpers/phpmailer.php';
  //Load Telerik Library
  require_once APP_ROOT.'/libraries/Kendo/Autoload.php';
