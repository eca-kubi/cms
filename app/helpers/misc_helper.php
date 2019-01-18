<?php
function arrToObj($arr)
{
    return json_decode(json_encode($arr));
}

function objToArr($obj)
{
    return json_decode(json_encode($obj), true);
}

// format date
function formatDate($date, $from, $to)
{
    if (empty($date)) {
        return '';
    }
    $d = DateTime::createFromFormat($from, $date);
    if ($d) {
        $ret = $d->format($to);
        if ($ret) {
            return $ret;
        }
    }

    return '';
}

function reArrayFiles(&$file_post)
{
    $file_ary = array();
    $multiple = is_array($file_post['name']);

    $file_count = $multiple ? count($file_post['name']) : 1;
    $file_keys = array_keys($file_post);

    for ($i = 0; $i < $file_count; ++$i) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $multiple ? $file_post[$key][$i] : $file_post[$key];
        }
    }

    return $file_ary;
}

function getNameInitials($first_name, $last_name)
{
}

function userExists($user_id)
{
    $db = Database::getDbh();

    return $db->where('user_id', $user_id)
        ->has('users');
}

function valueExistsInTable($table, $value, $column)
{
    $db = Database::getDbh();

    return $db->where($column, $value)
        ->has($table);
}

function getRandomString()
{
    return substr(md5(rand()), 0, 5);
}

function getCurrentSession()
{
    $current_session = 'user';
    if (!empty($_REQUEST['current_session'])) {
        $current_session = $_REQUEST['current_session'];
    }

    return $current_session;
}

/**
 * Summary of filterPost
 * It returns filtered POST array.
 *
 * @return array
 */
function filterPost()
{
    return $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
}

function requireModel(string $model)
{
    require_once '../app/models/' . ucwords($model) . '.php';

    return new $model();
}

function getData($payload)
{
    return (array)$payload;
}

function today()
{
    try {
        echo (new DateTime())->format(DFF);
    } catch (Exception $e) {
    }
}

/**
 * Summary of removeEmptyVal.
 *
 * @param array|object $value
 *
 * @return array
 */
function removeEmptyVal($value)
{
    $value = (array)$value;
    foreach ($value as $key => $item) {
        if (empty($item)) {
            unset($value[$key]);
        }
    }

    return $value;
}

function echoIfEmpty($target, $replacement)
{
    echo empty($target) ? $replacement : $target;
}

function isOriginator($cms_form_id, $user_id)
{
    return Database::getDbh()->where('cms_form_id', $cms_form_id)
        ->where('originator_id', $user_id)
        ->has('cms_form');
}

function isHOD($cms_form_id, $user_id)
{
    return Database::getDbh()->where('cms_form_id', $cms_form_id)
        ->where('hod_id', $user_id)
        ->has('cms_form');
}

/**
 *Concats array elements with $symbol and $symbolForlastElem.
 *
 * @param array $array
 *
 * @return string
 */
function concatWith(string $symbol, $symbolForLastElem, array $array)
{
    if (count($array) == 1) {
        return $array[0];
    }

    if (count($array) < 1) {
        return '';
    }

    $lastElem = end($array);
    $lastElemKey = key($array);

    unset($array[$lastElemKey]);
    $result = implode($symbol, $array);

    return $result . ', ' . $symbolForLastElem . $lastElem;
}

function notifyOHSForMonitoring($cms_form_id)
{
    $cms_form = new CMSForm(['cms_form_id' => $cms_form_id]);
    $link = URL_ROOT . '/cms-forms/view-change-process/' . $cms_form_id;
    $subject = genEmailSubject($cms_form_id);
    $hod = new User($cms_form->hod_id);
    $ohs_id = Database::getDbh()->where('department', OHS_DEPARTMENT)->
    getValue(TABLE_DEPARTMENT, 'department_id');
    $ohs_superintendent = Database::getDbh()->where('department_id', $ohs_id)
        ->where('role', 'Superintendent')
        ->getOne('users');
    $ohs_manager = Database::getDbh()->where('department_id', $ohs_id)
        ->where('role', 'Manager')
        ->getOne('users');
    $body = 'Hi ' . ucwords($ohs_superintendent['first_name'] . ' ' . $ohs_superintendent['last_name'], '-. ') . ' a Change Proposal application '
        . ' has been approved by ' . ucwords($hod->first_name . '.' . $hod->last_name, '-. ') . ($hod->job_title) . '.' .
        'Use this link to monitor the change progress' . "<a href='$link'>$link</a>";
    $email_model = new EmailModel();
    if ($ohs_superintendent) {
        $email_model->add([
            'subject' => $subject,
            'body' => $body,
            'recipient_address' => $ohs_superintendent['email'],
            'recipient_name' => ucwords($ohs_superintendent['first_name'] . ' ' . $ohs_superintendent['last_name'], '-. '),
            'sender_user_id' => getUserSession()->user_id
        ]);
    }
    if ($ohs_manager) {
        $email_model->add([
            'subject' => $subject,
            'body' => 'Hi ' . ucwords($ohs_manager['first_name'] . ' ' . $ohs_manager['last_name'] . ', ', '-. ') . HTML_NEW_LINE . 'A Change Proposal application '
                . ' has been approved by ' . ucwords($hod->first_name . ' ' . $hod->last_name, '-. ') . ' (' . $hod->job_title . ') .' .
                'Use this link to monitor the change progress: ' . "<a href='$link'>$link</a>",
            'recipient_address' => $ohs_manager['email'],
            'recipient_name' => ucwords($ohs_manager['first_name'] . ' ' . $ohs_manager['last_name'], '-. '),
            'sender_user_id' => getUserSession()->user_id
        ]);
    }
}

function notifyGm($cms_form_id, $cms_form)
{
    $risk_budget_level = '';
    if ($cms_form->risk_level == STATUS_HIGH_RISK_LEVEL && $cms_form->budget_level == STATUS_HIGH_BUDGET_LEVEL) {
        $risk_budget_level = ' high risk and budget';
    } else {
        if (($cms_form->risk_level == STATUS_HIGH_RISK_LEVEL)) {
            $risk_budget_level = ' high risk ';
        } else {
            $risk_budget_level = ' high budget ';
        }
    }
    $link = URL_ROOT . '/cms-forms/view-change-process/' . $cms_form_id;
    $subject = genEmailSubject($cms_form_id);
    $gm = (new User($cms_form->gm_id))->jsonSerialize();
    $hod = (new User($cms_form->hod_id))->jsonSerialize();
    $email_model = new EmailModel();
    $email_model->add([
        'subject' => $subject,
        'body' => 'Hi ' . ucwords($gm['first_name'] . ' ' . $gm['last_name'], '-. ') . ', ' . HTML_NEW_LINE .
            'A Change Proposal with a' . $risk_budget_level . ' level has been
        reviewed by ' . ucwords($hod['first_name'] . ' ' . $hod['last_name'], '-. ') . ' (' . $hod['job_title'] . ').' .
            ' This requires your approval. Kindly click this link to approve it: '
            . "<a href='$link'> $link</a>",
        'recipient_address' => $gm['email'],
        'recipient_name' => ucwords($gm['first_name'] . ' ' . $gm['last_name'], '-. '),
        'sender_user_id' => getUserSession()->user_id
    ]);
}


function isBudgetHigh($cms_form_id)
{
    $ret = Database::getDbh()->where('cms_form_id', $cms_form_id)
        ->getValue('cms_form', 'budget_level');
    return $ret === STATUS_HIGH_BUDGET_LEVEL;
}

function isRiskHigh($cms_form_id)
{
    $ret = Database::getDbh()->where('cms_form_id', $cms_form_id)
        ->getValue('cms_form', 'risk_level');
    return $ret === STATUS_HIGH_RISK_LEVEL;
}

function alert($message, $class)
{
    echo "<p class='$class'>" . $message . '</p>';
}

function getAffectedDepartments($cms_form_id)
{
    $results = [];
    $dept_model = new DepartmentModel();
    $affected_dept = Database::getDbh()->where('cms_form_id', $cms_form_id)
        ->getValue('cms_form', 'affected_dept');
    if (!empty($affected_dept)) {
        foreach (explode(',', $affected_dept) as $dept_id) {
            $results[] = $dept_model->getDepartment($dept_id);
        }
    }

    return $results;
}

function getImpactQuestions($department_id = null)
{
    if (empty($department_id)) {
        return Database::getDbh()->objectbuilder()->
        get('cms_impact_question');
    }

    return Database::getDbh()->where('department_id', $department_id)->
    objectBuilder()->
    get('cms_impact_question');
}

function getGms()
{
    $result = [];
    $gms = Database::getDbh()->where('staff_category', 'Management')
        ->objectBuilder()
        ->get('users');
    foreach ($gms as $gm) {
        if (in_array($gm->job_title, GMs)) {
            $result[] = $gm;
        }
    }

    return $result;
}

function getOriginatorId($cms_form_id)
{
    return Database::getDbh()->where('cms_form_id', $cms_form_id)->getValue('cms_form', 'originator_id');
}

function getHodId($cms_form_id)
{
    return Database::getDbh()->where('cms_form_id', $cms_form_id)->getValue('cms_form', 'hod_id');
}

function getGmId($cms_form_id)
{
    return Database::getDbh()->where('cms_form_id', $cms_form_id)->getValue('cms_form', 'gm_id');
}

function genEmailSubject($cms_form_id)
{
    return EMAIL_SUBJECT . ' Form #' . $cms_form_id;
}

function genLink($cms_form_id, $controller)
{
    $link = URL_ROOT . "/cms-forms/$controller/$cms_form_id";
    return '<a href="' .
        $link . '" >' . $link . '</a>';
}

function genThreadId($cms_form_id)
{
    return '<' . EMAIL_SUBJECT . ' Form #' . $cms_form_id . '@cms>';
}

if (!function_exists('array_key_last')) {
    /**
     * Polyfill for array_key_last() function added in PHP 7.3.
     *
     * Get the last key of the given array without affecting
     * the internal array pointer.
     *
     * @param array $array An array
     *
     * @return mixed the last key of array if the array is not empty; NULL otherwise
     */
    function array_key_last($array)
    {
        $key = null;

        if (is_array($array)) {
            end($array);
            $key = key($array);
        }

        return $key;
    }
}

function notifyImpactAccessReps($cms_form_id)
{
// Department reps responsible for impact assessment
    $cms_form = new CMSForm(['cms_form_id' => $cms_form_id]);
    $db = Database::getDbh();
    $originator = new User($cms_form->originator_id);
    $affected_departments = getAffectedDepartments($cms_form_id);
    $link = URL_ROOT . "/cms-forms/view-change-process/$cms_form_id";
    $subject = genEmailSubject($cms_form_id);
    foreach ($affected_departments as $affected_department) {
        $reps = $db->where('can_assess_impact', true)
            ->where('department_id', $affected_department->department_id)
            ->objectBuilder()
            ->get('users');
        foreach ($reps as $rep) {
            $body = "Hi, " . ucwords($rep->first_name . ' ' . $rep->last_name, '-. ') . HTML_NEW_LINE .
                "A Change Proposal raised by " . ($rep->user_id === $originator->user_id ? " you " : ucwords($originator->first_name . ' ' . $originator->last_name, '-. ')) .
                " requires response to questions on Possible Impacts related to your department (" . $affected_department->department . "). " .
                "Click this link if you wish to respond to the questions: " . '<a href="' .
                $link . '" />' . $link . '</a>';
            insertEmail($subject, $body, $rep->email, ucwords($rep->first_name . ' ' . $rep->last_name, '-. '));
        }
    }
}

function canAssessImpactForDept($department_id)
{
    $u = (new User(getUserSession()->user_id));
    return (($u->department_id == $department_id) && $u->can_assess_impact);
}

function populateImpactResponse(array $affected_depts, $cms_form_id)
{
    foreach ($affected_depts as $dept_id) {
        $questions = getImpactQuestions($dept_id);
        $response_model = new CmsImpactResponseModel();
        foreach ($questions as $ques) {
            $insert_data = [
                'cms_form_id' => $cms_form_id,
                'cms_impact_question_id' => $ques->cms_impact_question_id,
            ];
            $response_model->add($insert_data);
            (new ImpactAssStatusModel())->setCmsFormId($cms_form_id)
                ->setStatus(STATUS_IMPACT_ASSESSMENT_RESPONSE_PENDING)
                ->setDepartmentId($dept_id)->insert();
        }
    }
}

function isAssessmentComplete($cms_form_id)
{
    $db = Database::getDbh();
    return $db->where('cms_form_id', $cms_form_id)->
    where('response', null, 'IS')->
    has('cms_impact_response');
}

function getImpactResponsesForDepartment($cms_form_id, $department_id)
{
    $db = Database::getDbh();
    return $db->where('cms_form_id', $cms_form_id)->
    objectBuilder()->
    where('department_id', $department_id)->
    join('cms_impact_question ciq', 'ciq.cms_impact_question_id=cir.cms_impact_question_id', 'left')->
    join('departments d', 'd.department_id=ciq.department_id', 'left')->
    get('cms_impact_response');
}

/**
 * Summary of getResponseForQuestion
 * @param mixed $question_id
 * @param $cms_form_id
 * @return object
 */
function getResponseForQuestion($question_id, $cms_form_id)
{
    return (object)Database::getDbh()->where('cms_impact_question_id', $question_id)->
    where('cms_form_id', $cms_form_id)->
    objectBuilder()->
    getOne('cms_impact_response');
}

function sectionCompleted($cms_form_id, $section)
{
    $section_completed = (new CMSForm(['cms_form_id' => $cms_form_id]))->getSectionCompleted();
    if (empty($section_completed)) {
        return [];
    }
    return in_array($section, explode(',', trim($section_completed, ',')));
}

function completeSection($cms_form_id, $section)
{
    $db = Database::getDbh();
    $s = $db->where('cms_form_id', $cms_form_id)->
    getValue('cms_form', 'section_completed');
    if (!strpos($s, $section)) {
        $section = trim($section . ',' . $s, ',');
    }
    $db->where('cms_form_id', $cms_form_id)->
    update('cms_form', ['section_completed' => $section]);
}

/**
 * @param $cms_form_id
 * @param string $action
 * @param array|null $cols
 * @return array|object
 */
function getActionLog($cms_form_id, $action = '', array $cols = null, $single = false)
{
    $db = Database::getDbh();
    $db = $db->objectBuilder();
    if (!empty($action)) {
        $db = $db->where('cms_form_id', $cms_form_id)
            ->objectBuilder()
            ->where('action', $action);
        if (!empty($cols)) {
            foreach ($cols as $col => $val) {
                $db = $db->where($col, $val);
            }
        }
    } else {
        $action_log = [];
        $ret = $db->where('cms_form_id', $cms_form_id)
            ->objectBuilder()
            ->get('cms_action_log');
        foreach ($ret as $value) {
            $action_log[$value->action] = $value;
        }
        return $action_log;
    }
    if ($single) {
        return $db->getOne('cms_action_log');
    }

    return $db->get('cms_action_log');
}

function setActionLog($data)
{
    $db = Database::getDbh();
    return $db->insert('cms_action_log', $data);
}

function concatName(array $parts, $capitalize = true)
{
    $full_name = '';
    foreach ($parts as $part) {
        if ($capitalize) {
            $full_name = trim($full_name . ' ' . ucwords($part, '-,. '), ' ');
        } else {
            $full_name = trim($full_name . ' ' . $part, ' ');
        }
    }
    return $full_name;
}

function concatNameWithUserId($user_id, $capitalize = true)
{
    $u = (new User($user_id));
    return ucwords($u->first_name . ' ' . $u->last_name, '- .');
}

function actionLog($cms_form_id, $action, $performed_by, $department_affected = null)
{
    return $log_id = (new CmsActionLogModel())->setAction($action)
        ->setPerformedBy($performed_by)
        ->setCmsFormId($cms_form_id)
        ->setDepartmentAffected($department_affected)
        ->insert();
}

function echoDate(string $date, $return = false)
{
    try {
        $d = (new \Moment\Moment($date))->calendar(false);
        $t = (new \Moment\Moment($date))->format('hh:mma', new \Moment\CustomFormats\MomentJs());
        if ($return) {
            return $d . ' at ' . $t;
        }
        echo $d . ' at ' . $t;
    } catch (\Moment\MomentException $e) {
    }
}

function message($message_id, array $data = [])
{
    switch ($message_id) {
        case MESSAGE_IMPACT_ASSESSMENT_APPROVED:
            return $data['department'] . " Impact Assessment approved!";
            break;
        default:
            return 'Success!';
    }
}

function getDepartmentHods($department_id)
{
    $db = Database::getDbh();
    return $db->where('role', 'Manager')
        ->where('department_id', $department_id)
        ->objectBuilder()
        ->get('users');
}

function echoCompleted($date, $user_id, $return = false)
{
    $user = new User($user_id);
    $department = new Department($user->department_id);
    if ($return) {
        return "[Completed " . echoDate($date, true) . " by " .
        its_logged_in_user($user_id) ? ' You ' : concatNameWithUserId($user_id) . " - " . $user->job_title . " @ " . $department->department . "]";
    }
    echo "[Completed ";
    echoDate($date);
    echo " by " . (its_logged_in_user($user_id) ? ' You ]' : concatNameWithUserId($user_id) . " - " . $user->job_title . " @ " . $department->department . "]");
}

function insertEmail($subject, $body, $recipient_address, $recipient_name)
{
    $email_model = new EmailModel();
    $email_model->add([
        'subject' => $subject,
        'body' => $body,
        'recipient_address' => $recipient_address,
        'recipient_name' => $recipient_name,
        'sender_user_id' => getUserSession()->user_id
    ]);
}

function its_logged_in_user($user_id)
{
    return getUserSession()->user_id === $user_id;
}