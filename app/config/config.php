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
// Site Name
define('SITE_NAME', 'Adamus Change Management System');
define('APP_NAME', 'Adamus CMS');

// App Version
define('APP_VERSION', '1.0.0');
// Profile picture directory
define('PROFILE_PIC_DIR', URL_ROOT . '/public/assets/images/profile_pics/');

define('DATE_FORMATS', [
    'back_end' => 'Y-m-d',
    'front_end' => 'd-m-Y',
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
const INTRANET = 'http://intranet.arlgh.com';
const DFF = 'd-m-Y'; //date format for front-end
const DFB = 'Y-m-d'; //date format for back-end
const MEDIA_FILE_TYPES = 'image/*,  video/*, audio/*';
const PHOTO_FILE_TYPES = 'image/*';
const VIDEO_FILE_TYPES = 'video/*';
const AUDIO_FILE_TYPES = 'audio/*';
const DOC_FILE_TYPES = '.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, .pdf, text/plain, text/html';
const HTML_NEW_LINE = '&nbsp';

const NEXT_ACTION_HOD_ASSESSMENT = 'hod-assessment';
const NEXT_ACTION_RISK_ASSESSMENT = 'risk-assessment';
const NEXT_ACTION_GM_ASSESSMENT = 'gm-assessment';
const NEXT_ACTION_HOD_AUTHORISATION = 'hod-authorisation';
const NEXT_ACTION_PL_ACCEPTANCE = 'pl-acceptance';
const NEXT_ACTION_ACTION_LIST = 'action-list';
const NEXT_ACTION_PL_CLOSURE = 'pl-closure';
const NEXT_ACTION_ORIGINATOR_CLOSURE = 'oiginator-closure';
const NEXT_ACTION_HOD_CLOSURE = 'hod-closure';
const NEXT_ACTION_PROCESS_CLOSED = 'process-closed';
