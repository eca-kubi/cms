<?php
// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'appiahmakuta');
define('DB_PASS', 'gmail300');
define('DB_NAME', 'sms');

// global params
$data = [];
define('NAVBAR_MT', '109.516px');
// App Root
define('APP_ROOT', dirname(dirname(__FILE__)));
// URL Root
define('URL_ROOT', 'http://sms2.arlgh.com/cms');
// Site Name
define('SITE_NAME', 'Adamus Change Management System');
define('APP_NAME', 'Adamus CMS');

// App Version
define('APP_VERSION', '1.0.0');
// Profile picture directory
define('PROFILE_PIC_DIR', URL_ROOT . '/public/assets/images/profile_pics/');

define('DATE_FORMATS', [
    'back_end' => 'Y-m-d',
    'front_end' => 'D, M j, Y',
    'num_sm' => 'Y/m/d',
    'num_xs' => 'Y/n/j',
], true);

define("BUTTONS", [
    'back' => '<a class="btn w3-btn bg-gray w3-small" href="javascript:history.go(-1)" role="button"><i class="fa fa-arrow-alt-circle-left"></i> Go back</a>'
], true);
define('MY_PRIVATE_KEY' ,md5('my-private-key-daemon'));

const NO_PROFILE = 'no_profile.jpg';
const DEFAULT_PROFILE_PIC =  "no_profile.jpg";
const SMS_GATEWAY_EMAIL = 'appiahmakuta70@gmail.com';
const SMS_GATEWAY_PASSWORD = 'gmail300';
const SMS_GATEWAY_DEVICE_ID = '104720';
const SMS_GATEWAY_DEVICE_NAME = 'blu';
const SMS_GATEWAY_DEVICE_PHONE_NUM = '+233547468603';
const SMS_GATEWAY_API_KEY = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUyNjA2OTI2OCwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjQ1OTU3LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.9YUK41Yb_ghaErrbBsfU7Pj_J57jrfOum-5AJI-yBOo';
const HOST = 'http://sms2.arlgh.com';
const INTRANET = 'http://intranet.arlgh.com';