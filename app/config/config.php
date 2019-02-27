<?php
// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'appiahmakuta');
define('DB_PASS', 'gmail300');
define('DB_NAME', 'sms');

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
]);

define("BUTTONS", [
    'back' => '<a class="btn w3-btn bg-gray w3-small" href="javascript:history.go(-1)" role="button"><i class="fa fa-arrow-alt-circle-left"></i> Go back</a>'
]);
define('MY_PRIVATE_KEY', md5('my-private-key-daemon'));

const NO_PROFILE = 'no_profile.jpg';
const DEFAULT_PROFILE_PIC = "no_profile.jpg";
const SMS_GATEWAY_EMAIL = 'appiahmakuta70@gmail.com';
const SMS_GATEWAY_PASSWORD = 'gmail300';
const SMS_GATEWAY_DEVICE_ID = '104720';
const SMS_GATEWAY_DEVICE_NAME = 'blu';
const SMS_GATEWAY_DEVICE_PHONE_NUM = '+233547468603';
const SMS_GATEWAY_API_KEY = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUyNjA2OTI2OCwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjQ1OTU3LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.9YUK41Yb_ghaErrbBsfU7Pj_J57jrfOum-5AJI-yBOo';
const INTRANET = 'http://intranet.arlgh.com';
const DFF = 'd-m-Y'; //date format for front-end
const DFB = 'Y-m-d'; //date format for back-end
const DFF_DT = 'd-m-Y h:i a';
const DFB_DT = 'Y-m-d H:i:s';
const MEDIA_FILE_TYPES = 'image/*,  video/*, audio/*';
const PHOTO_FILE_TYPES = 'image/*';
const VIDEO_FILE_TYPES = 'video/*';
const AUDIO_FILE_TYPES = 'audio/*';
const DOC_FILE_TYPES = '.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, application/msword, application/pdf, text/plain, text/html, application/vnd.openxmlformats-officedocument.wordprocessingml.document';
const HTML_NEW_LINE = '<br/>';
const ACTION_START_CHANGE_PROCESS = 'start_change_process';
const ACTION_CHANGE_APPLICATION_RAISED = 'change application raised';
const ACTION_IMPACT_ASSESSMENT_RESPONSE_COMPLETED = 'impact_assessment_response_complete';
const ACTION_START_CHANGE_PROCESS_COMPLETED = 'start_change_process_completed';
const ACTION_HOD_ASSESSMENT = 'hod_assessment';
const ACTION_HOD_AUTHORISATION_COMPLETED = 'hod_authorisation_completed';
const ACTION_HOD_ASSESSMENT_COMPLETED = 'hod_assessment_completed';
const ACTION_GM_ASSESSMENT_COMPLETED = 'gm_assessment_completed';
const ACTION_RISK_ASSESSMENT = 'risk_assessment';
const ACTION_RISK_ASSESSMENT_COMPLETED = 'risk_assessment_completed';
const ACTION_IMPACT_ASSESSMENT = 'impact_assessment';
const ACTION_CHANGE_CANCELLED = 'change-cancelled';
const ACTION_GM_ASSESSMENT = 'gm_assessment';
const ACTION_HOD_AUTHORISATION = 'hod-authorisation';
const ACTION_PROJECT_LEADER_ACCEPTANCE_COMPLETED = 'project-leader-acceptance-completed';
const ACTION_PL_ACCEPTANCE = 'pl-acceptance';
const ACTION_ACTION_LIST = 'action-list';
const ACTION_PL_CLOSURE = 'pl-closure';
const ACTION_PASSWORD_RESET = 'password reset';
const ACTION_ORIGINATOR_CLOSURE = 'originator_closure';
const ACTION_HOD_CLOSURE = 'hod_closure';
const ACTION_PROCESS_CLOSED = 'process_closed';
const ACTION_SECTION_COMPLETED = 'section_completed';
const ACTION_SECTION_MODIFIED = 'section_modified';
const ACTION_CHANGE_REJECTED = 'section_change_rejected';
const ACTION_CHANGE_DELAYED = 'section_change_delayed';
const ACTION_CHANGE_APPROVED = 'section_change_approved';
const ACTION_IMPACT_ASSESSMENT_COMPLETED = 'impact-assessment-completed';
const ACTION_IMPACT_ASSESSMENT_MODIFIED = 'impact-assessment-modified';
const ACTION_IMPACT_ASSESSMENT_HOD_COMMENTED = 'impact_assessment_hod_commented';
const ACTION_CHANGED_GM = 'changed gm';
const  ACTION_CHANGED_MANAGER = 'changed manager';
const ACTION_CHANGED_MANAGERS = 'changed managers';
const SECTION_START_CHANGE_PROCESS = 'start_change_process';
const SECTION_HOD_ASSESSMENT = 'hod-assessment';
const SECTION_ACTION_LIST = 'action-list';
const SECTION_RISK_ASSESSMENT = 'risk-assessment';
const SECTION_IMPACT_ASSESSMENT = 'impact-assessment';
const SECTION_GM_ASSESSMENT = 'gm-assessment';
const SECTION_HOD_AUTHORISATION = 'hod-authorisation';
const SECTION_PL_ACCEPTANCE = 'pl-acceptance';
const SECTION_SECTION_LIST = 'SECTION-list';
const SECTION_PL_CLOSURE = 'pl-closure';
const SECTION_ALL = 'all-sections';
const SECTION_ORIGINATOR_CLOSURE = 'originator-closure';
const SECTION_HOD_CLOSURE = 'hod-closure';
const SECTION_PROCESS_CLOSURE = 'process-closed';
const OHS_DEPARTMENT = 'OHS';
const TABLE_DEPARTMENT = 'departments';
const SECTION_1 = 'section_start_change_process';
const SECTION_2 = 'section_hod_assessment';
const SECTION_3 = 'section_risk_assessment';
const SECTION_3B = 'section_possible_impact';
const GMs = ['General Manager', 'Mining Manager', 'Process Manager'];
const OHS_EMAIL = 'ecakubi@adamusgh.com';
const EMAIL_SUBJECT = 'Change Proposal';
const PATH_RISK_ATTACHMENT = APP_ROOT . '\..\public\assets\uploads\risk-attachments\\';
const PATH_ADDITIONAL_INFO = APP_ROOT . '\..\public\assets\uploads\additional-infos\\';
const PATH_PL_DOCUMENTS = APP_ROOT . '\..\public\assets\uploads\project-leader\\';

const SALT = 'archangel';
const STATUS_PENDING_APPROVAL = 'pending_approval';
const STATUS_APPROVED = 'approved';
const STATUS_REJECTED = 'rejected';
const STATUS_DELAYED = 'delayed';
const STATUS_STOPPED = 'stopped';
const STATUS_CLOSED = 'closed';
const STATUS_ACTIVE = 'active';
const STATUS_AUTHORIZED = 'authorized';
const STATUS_ACCEPTED = 'accepted';
const REMINDER_LIMIT = 3;
const REMINDER_INTERVAL = '30S'; // 10 seconds

const SUBJECT_MANAGER_CHANGED = 'CMS Manager Changed';
const ROLE_MANAGER = 'Manager';
const ROLE_SUPERINTENDENT = 'Superintendent';

define('STATE', [
        'active' => [
            'name' => STATUS_ACTIVE,
            'color' => 'success',
            'desc' => ''
        ],
        'closed' => [
            'name' => STATUS_CLOSED,
            'color' => 'primary',
            'desc' => ''
        ],
        'rejected' => [
            'name' => STATUS_REJECTED,
            'color' => 'danger',
            'desc' => ''
        ]
    ]
);
const STATUS_PENDING = 'pending';
const STATUS_IMPACT_ASSESSMENT_COMPLETED = 'impact_assessment_completed';
const STATUS_IMPACT_ASSESSMENT_HOD_COMMENT_PENDING = 'hod_comment_pending';
const STATUS_IMPACT_ASSESSMENT_HOD_COMMENTED = 'hod_commented';
const STATUS_IMPACT_ASSESSMENT_RESPONSE_PENDING = 'response_pending';
const MESSAGE_IMPACT_ASSESSMENT_APPROVED = 1;
const STATUS_HIGH_RISK_LEVEL = 'High';
const STATUS_MEDIUM_RISK_LEVEL = 'Medium';
const STATUS_LOW_RISK_LEVEL = 'Low';
const STATUS_HIGH_BUDGET_LEVEL = 'High';
const STATUS_MEDIUM_BUDGET_LEVEL = 'Medium';
const STATUS_LOW_BUDGET_LEVEL = 'Low';
const ICON_FA_PLUS = 'fa-plus-circle';
const ICON_FA_MINUS = 'fa-minus-circle';
const ANIMATE_FLASH = 'animated flash card infinite';

$_GET['target'] = empty($_GET['target']) ? '' : $_GET['target'];
$pending_sections = [];