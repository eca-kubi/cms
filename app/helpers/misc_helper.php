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

/**
 * @param string $model
 * @return mixed
 */
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

function isAssignedHOD($cms_form_id, $user_id)
{
    return Database::getDbh()->where('cms_form_id', $cms_form_id)
        ->where('hod_id', $user_id)
        ->has('cms_form');
}

function isHOD($cms_form_id, $user_id)
{
    return Database::getDbh()->where('cms_form_id', $cms_form_id)
        ->where('hod_id', $user_id)
        ->has('cms_form');
}

function isAssignedGM($cms_form_id, $user_id)
{
    return Database::getDbh()->where('cms_form_id', $cms_form_id)
        ->where('gm_id', $user_id)
        ->has('cms_form');
}

function isGM($user_id = '')
{
    $job_title = !empty($user_id) ? (new User($user_id))->job_title : getUserSession()->job_title;
    return in_array($job_title, GMs);
}

function isCurrentGM($user_id = '')
{
    if (empty($user_id)) {
        $user_id = getUserSession()->user_id;
    }
    return $user_id === getCurrentGM();
}

/**
 *Concats array elements with $symbol and $symbolForlastElem.
 *
 * @param string $symbol
 * @param $symbolForLastElem
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

    $array = array_filter($array, function ($value) {
        return !empty($value);
    });

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
        . ' has been approved by ' . getNameJobTitleAndDepartment($hod->user_id) . '. ' .
        'Use this link to monitor the change progress: ' . "<a href='$link'>$link</a>";
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
                . ' has been approved by ' . getNameJobTitleAndDepartment($hod->user_id) . '. Use this link to monitor the change progress: ' . "<a href='$link'>$link</a>",
            'recipient_address' => $ohs_manager['email'],
            'recipient_name' => ucwords($ohs_manager['first_name'] . ' ' . $ohs_manager['last_name'], '-. '),
            'sender_user_id' => getUserSession()->user_id
        ]);
    }
}

function notifyGm($cms_form_id)
{
    /*
     * if ($cms_form->risk_level == STATUS_HIGH_RISK_LEVEL && $cms_form->budget_level == STATUS_HIGH_BUDGET_LEVEL) {
        $risk_budget_level = ' high risk and budget';
    } else {
        if (($cms_form->risk_level == STATUS_HIGH_RISK_LEVEL)) {
            $risk_budget_level = ' high risk ';
        } else {
            $risk_budget_level = ' high budget ';
        }
    }
     * */
    $cms_form = new CMSForm($cms_form_id);
    // get the hod who approved the start change process ie. hod-assessment
    $link = URL_ROOT . '/cms-forms/view-change-process/' . $cms_form_id;
    $subject = genEmailSubject($cms_form_id);
    $gm = (new User($cms_form->gm_id))->jsonSerialize();
    $hod = (new User($cms_form->hod_id))->jsonSerialize();
    $email_model = new EmailModel();
    $email_model->add([
        'subject' => $subject,
        'body' => 'Hi ' . ucwords($gm['first_name'] . ' ' . $gm['last_name'], '-. ') . ', ' . HTML_NEW_LINE .
            'A Change Proposal has been reviewed by ' . ucwords($hod['first_name'] . ' ' . $hod['last_name'], '-. ') . ' (' . $hod['job_title'] . ').' .
            ' This requires your approval. Kindly click this link to approve it: '
            . "<a href='$link'> $link</a>",
        'recipient_address' => $gm['email'],
        'recipient_name' => ucwords($gm['first_name'] . ' ' . $gm['last_name'], '-. '),
        'sender_user_id' => getUserSession()->user_id
    ]);
}

/**To notify Gms for their approval
 * This function can be customized with the help of
 * its parameters for general notifications to GMs
 * @param $cms_form_id
 * @param null $message
 * @param null $action
 * @param null $action_options
 */
function notifyGms($cms_form_id, $message = null, $action = null, $action_options = null)
{
    // get the hod or the change owner who approved the start change process ie. hod-assessment
    $change_owner = new User(getActionLog($cms_form_id, $action ? $action : ACTION_HOD_ASSESSMENT_COMPLETED,
        $action_options ? $action_options : [], true)->performed_by);
    $gms = getGms();
    $link = URL_ROOT . '/cms-forms/view-change-process/' . $cms_form_id;
    $subject = genEmailSubject($cms_form_id);
    foreach ($gms as $gm) {
        $m = $message ? $message : 'Hi ' . concatNameWithUserId($gm->user_id) . ', ' . HTML_NEW_LINE .
            'A Change Proposal owned by ' . getNameJobTitleAndDepartment($change_owner->user_id) .
            ', requires your approval as GM. You may click this link to approve it: '
            . "<a href='$link'> $link</a>";
        insertEmail($subject, $m, $gm->email, concatNameWithUserId($gm->user_id));
    }
}

/**To notify Department heads; managers & superintendents for their approval
 * This function can be customized with the help of
 * its parameters for general notifications to department heads
 * @param $cms_form_id
 * @param $department_id
 * @param null $message
 * @param null $action
 * @param null $action_options
 */
function notifyDepartmentManagers($cms_form_id, $department_id, $message = null, $action = null, $action_options = null)
{
    // get the hod who approved the start change process ie. hod-assessment
    //$action_hod_commented = getActionLog($cms_form_id, ACTION_HOD_ASSESSMENT_COMPLETED, [], true);
    $hods = getHodsWithCurrent($department_id);
    //$link = URL_ROOT . '/cms-forms/view-change-process/' . $cms_form_id;
    $subject = genEmailSubject($cms_form_id);
    //$hod = new User($action_hod_commented->performed_by);
    foreach ($hods as $hod) {
        insertEmail($subject, $message, $hod->email, concatNameWithUserId($hod->user_id));
    }
}

function notifyAllHODs($cms_form_id)
{
    $cms_form = new CMSForm(array('cms_form_id' => $cms_form_id));
    $affected_department = new Department($cms_form->department_id);
    $subject = genEmailSubject($cms_form_id);
    $link = site_url("cms-forms/view-change-process/$cms_form_id");
    $managers = getManagers();
    foreach ($managers as $manager) {
        $name = concatNameWithUserId($manager->user_id);
        $body = "Hi, " . $name . ', ' . HTML_NEW_LINE .
            "A Change Proposal raised by " . ($manager->user_id === $cms_form->originator_id ? " you " : getNameJobTitleAndDepartment($cms_form->originator_id)) .
            " requires response to questions on Possible Impacts related to your department (" . $affected_department->department . "). " .
            "Click this link if you wish to respond to the questions: " . '<a href="' . $link . '" />' . $link . '</a>';
        insertEmail($subject, $body, $manager->email, $name);
    }
}

function getManagers(): array
{
    $db = Database::getDbh();
    return $db->where('role', ROLE_MANAGER)
        ->orWhere('role', ROLE_SUPERINTENDENT)
        ->objectBuilder()
        ->get('users');
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
    global $pending_sections;
    echo "<p class='$class mb-0 small text-bold py-1 alert alert-dismissible'>" . "<i class='fa fa-warning text-warning'></i> " . $message . '</p>';
    $ps = "<p class='$class mb-0 small text-bold py-1 alert alert-dismissible'>" . "<i class='fa fa-warning text-warning'></i> " . $message . '</p>';
    array_push($pending_sections, $ps);
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
    //return EMAIL_SUBJECT . ' Form #' . $cms_form_id;
    // we use ref number and change title
    $cms = (new CMSFormModel(array('cms_form_id' => $cms_form_id)));
    //$change_type = explode(',', $cms->getChangeType());
    $ref = $cms->getHodRefNum();
    $title = $cms->title;
    $ref = "Change Management System [" . $ref . ' - ' . $title . "]";
    /*  if (!empty($title)) {
      } else {
          $ref = "Change Management System [" . $ref . ' - ' . concatWith(',', '&', $change_type) . "]";
      }*/
    return $ref;
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
            $body = "Hi, " . ucwords($rep->first_name . ' ' . $rep->last_name, '-. ') . ', ' . HTML_NEW_LINE .
                "A Change Proposal raised by " . ($rep->user_id === $originator->user_id ? " you " : getNameJobTitleAndDepartment($originator->user_id)) .
                " requires response to questions on Possible Impacts related to your department (" . $affected_department->department . "). " .
                "Click this link if you wish to respond to the questions: " . '<a href="' . $link . '" />' . $link . '</a>';
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
        }
        (new ImpactAssStatusModel())
            ->setCmsFormId($cms_form_id)
            ->setStatus(STATUS_IMPACT_ASSESSMENT_RESPONSE_PENDING)
            ->setDepartmentId($dept_id)
            ->insert();
    }
}

function isAssessmentComplete($cms_form_id)
{
    $db = Database::getDbh();
    return $db->where('cms_form_id', $cms_form_id)->
    where('response', null, 'IS')->
    has('cms_impact_response');
}

/**
 * @param $cms_form_id
 * @param $department_id
 * @return array
 * @throws Exception
 */
function getImpactResponsesForDepartment($cms_form_id, $department_id)
{
    $db = Database::getDbh();
    return $db->where('cms_form_id', $cms_form_id)
        ->objectBuilder()
        ->where('department_id', $department_id)
        ->join('cms_impact_question ciq', 'ciq.cms_impact_question_id=cir.cms_impact_question_id', 'left')
        ->join('departments d', 'd.department_id=ciq.department_id', 'left')
        ->get('cms_impact_response');
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
    $s = $db->where('cms_form_id', $cms_form_id)
        ->getValue('cms_form', 'section_completed');
    if (!strpos($s, $section)) {
        $section = trim($section . ',' . $s, ',');
    }
    $db->where('cms_form_id', $cms_form_id)
        ->update('cms_form', ['section_completed' => $section]);
}

/**
 * Add a department to the list of departments who have completed
 * their impact assessment
 * @param $cms_form_id
 * @param $department_id
 */
function updateImpactAssessmentCompleteList($cms_form_id, $department_id)
{
    $db = Database::getDbh();
    $list = (new CMSForm(['cms_form_id' => $cms_form_id]))->getImpactAssCompletedDept();
    $arr = explode(",", $list . "");
    if (!in_array($department_id, $arr)) {
        $list = trim($department_id . ',' . $list, ',');
        $db->where('cms_form_id', $cms_form_id)
            ->update('cms_form', ['impact_ass_completed_dept' => $list]);
    }
}

/**
 * @param $cms_form_id
 * @param string $action
 * @param array|null $cols
 * @param bool $single
 * @return array|object
 */
function getActionLog($cms_form_id, $action = '', array $cols = null, $single = false)
{
    $db = Database::getDbh();
    $db->objectBuilder();
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

function concatNameWithUserId($user_id)
{
    if (empty($user_id)) {
        return "";
    }
    $u = (new User($user_id));
    return ucwords($u->first_name . ' ' . $u->last_name, '- .');
}

function actionLog($cms_form_id, $action, $performed_by, $department_affected = null, $section_affected = null)
{
    return $log_id = (new CmsActionLogModel())->setAction($action)
        ->setPerformedBy($performed_by)
        ->setCmsFormId($cms_form_id)
        ->setDepartmentAffected($department_affected)
        ->setSectionAffected($section_affected)
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
    return '';
}

function returnDate($date, $official = false)
{
    try {
        if (!$official) {
            $d = (new \Moment\Moment($date))->calendar(false);
            $t = (new \Moment\Moment($date))->format('hh:mm a', new \Moment\CustomFormats\MomentJs());
            return $d . ' at ' . $t;
        } else {
            return $d = (new \Moment\Moment($date))->format('ddd, MMM D YYYY hh:mm a', new \Moment\CustomFormats\MomentJs());
        }
    } catch (\Moment\MomentException $e) {
    }
    return '';
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
    $ret = $db->where('department_id', $department_id)
        ->where("(role = ? or role = ?)", Array(ROLE_SUPERINTENDENT, ROLE_MANAGER))
        ->objectBuilder()
        ->get('users');
    return $ret;
}

function getCurrentManager($department_id)
{
    $db = Database::getDbh();
    return $db->where('department_id', $department_id)
        ->getValue('departments', 'current_manager');
}

function getHodsWithCurrent($department_id)
{
    $current_mgr_id = getCurrentManager($department_id);
    $mgrs = getDepartmentHods($department_id);
    array_walk($mgrs, function (&$mgr, $key) use ($current_mgr_id, &$mgrs) {
        if ($mgr->user_id === $current_mgr_id) {
            unset($mgrs[$key]);
        }
    });
    if (!empty($current_mgr_id)) {
        $current_mgr = new User($current_mgr_id);
        $mgrs[] = $current_mgr;
    }
    return $mgrs;
}

/*
 * function echoCompleted($date, $user_id, $return = false)
{
    $user = new User($user_id);
    $department = new Department($user->department_id);
    $department_name = (!empty($department->department) ? $department->department : 'Adamus');
    if ($return) {
        return "[Completed " . echoDate($date, true) . " by " .
        its_logged_in_user($user_id) ? ' You ' : concatNameWithUserId($user_id) . " - " . $user->job_title . " @ " .
            $department_name . "]";
    }
    echo "[Completed ";
    echoDate($date);
    echo " by " . (its_logged_in_user($user_id) ? ' You ]' : concatNameWithUserId($user_id) . " - " . $user->job_title . " @ " .
            $department_name . "]");
    return '';
}
 * */

function echoCompleted()
{
    return "<span class=\"font-italic completed\"> <span class=\"small animated completed\">[Completed]</span>  <i
                            class=\"fa fa-check fa-1x completed d-none animated\"></i></span>";
}

function echoInComplete($append = '')
{
    return "<span class=\"font-italic \"> <span class=\"text-dark small animated incomplete ml-1\">[Incomplete] $append</span> </span> ";
}

function insertEmail($subject, $body, $recipient_address, $recipient_name)
{
    $email_model = new EmailModel();
    return $email_model->add([
        'subject' => $subject,
        'body' => $body,
        'recipient_address' => $recipient_address,
        'recipient_name' => $recipient_name,
        //'sender_user_id' => getUserSession()->user_id
    ]);
}

/**
 * @return int gm user_id
 */
function getCurrentGM(): int
{
    return (new CmsSettingsModel())->getValue('current_gm');
}

function its_logged_in_user($user_id)
{
    return getUserSession()->user_id === $user_id;
}

function isProjectLeader($user_id, $cms_form_id)
{
    $pl_id = (new CMSForm(['cms_form_id' => $cms_form_id, 'project_leader_id' => $user_id]))->getProjectLeaderId();
    return $pl_id === $user_id;
}

function isDepartmentManager($user_id, $department_id)
{
    $user = new User($user_id);
    return ($user->department_id === $department_id && ($user->role === ROLE_MANAGER || $user->role === ROLE_SUPERINTENDENT));
}

function echoPendingSections()
{
    global $pending_sections;
    foreach ($pending_sections as $section) {
        echo '<input  value=' . "$section" . 'class="pending-section">';
    }
    if (!empty($pending_sections)) {
        echo json_encode($pending_sections);
    }
    echo json_encode([""]);
}

function isAllImpactAssessmentComplete($cms_form_id)
{
    /*
     * Check if all departments affected have completed
     * impact assessment
     * */
    $completed_departments_string = (new CMSForm(['cms_form_id' => $cms_form_id]))->getImpactAssCompletedDept();
    if (!empty($completed_departments_string)) {
        $completed_departments_array = explode(',', trim($completed_departments_string, ', '));
        return count(getAffectedDepartments($cms_form_id)) === count($completed_departments_array);
    }
    return false;
}

/**
 * @param $user_id
 * @return string
 */
function getDepartment($user_id)
{
    return ((new User($user_id))->department)->department;
}

function getDepartmentID($user_id)
{
    return ((new User($user_id))->department)->department_id;
}

/**
 * @param $user_id
 * @return string
 */
function getJobTitle($user_id)
{
    return (new User($user_id))->job_title;

}

function getNameJobTitleAndDepartment($user_id)
{
    $user = new User($user_id);
    return concatNameWithUserId($user_id) .
        " - " . $user->job_title . " @ " .
        getDepartment($user_id);
}

function getOriginatorDepartmentID($cms_form_id)
{
    return (new User((new CMSForm(['cms_form_id' => $cms_form_id]))->getOriginatorId()))->department_id;
}

/**Return current date & time
 * @return string
 */
function now()
{
    try {
        return (new DateTime())->format(DFB_DT);
    } catch (Exception $e) {
    } finally {
        return '';
    }
}

function inDelimiteredString($needle, $delimiter, $delimetered_string)
{
    $arr = explode($delimiter, $delimetered_string . "");
    return in_array($needle, $arr);
}

function getDeptRef($department_id)
{
    $db = Database::getDbh();
    $ref = '';
    $ret = $db->where('department_id', $department_id)
        ->get('cms_form');
    $department = new Department($department_id);
    $short_name = $department->short_name;
    $count = count($ret) + 1 . "";
    $char_count = strlen($count);
    if ($char_count === 1) {
        $ref = '00' . $count;
    } elseif ($char_count === 2) {
        $ref = '0' . $count;
    }
    return $short_name . '-' . $ref;
}

function site_url($url = '')
{
    return URL_ROOT . '/' . $url;
}

function modal($modal, $payload = [])
{
    // todo: extract payload
    //extract($payload);
    if (file_exists(APP_ROOT . '/views/modals/' . $modal . '.php')) {
        require_once APP_ROOT . '/views/modals/' . $modal . '.php';
    } else {
        // Modal does not exist
        die('Modal is missing.');
    }
}

function goBack()
{

    if (!empty($_SERVER['HTTP_REFERER'])) {
        $referer = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);
        // echo '<p><a href="'. $referer .'" title="Return to the previous page">&laquo; Go back</a></p>';
        header("Location: $referer");

    } else {

        //echo '<p><a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a></p>';
        echo '<script>history.go(-1)</script>';
        exit;
    }
}

function the_controller($url = ''): string
{
    $controller = '';
    if (!$url) {
        $url = the_url();
    }
    $parts = explode('/', $url);
    if (!empty($parts[4])) {
        $controller = str_replace('-', '_', $parts[4]);
    }
    return $controller;
}

function the_method($url = ''): string
{
    $method = '';
    if (!$url) {
        $url = the_url();
    }
    $parts = explode('/', $url);
    if (!empty($parts[5])) {
        $method = str_replace('-', '_', $parts[5]);
    }
    return $method;
}

/**
 * @return string | bool
 */
function the_url()
{
    return $referer = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);
}

function getDepartmentMembers($department_id)
{
    $db = Database::getDbh();
    return $db->where('department_id', $department_id)
        ->objectBuilder()
        ->get('users');
}

function script($content)
{
    echo <<<heredoc
<script>
$(
    $content
);
</script>
heredoc;

}

function setReminder($cms_form_id, $interval, $limit)
{
    $ret = false;
    $db = Database::getDbh();
    try {
        $ret = $db->insert('assessment_reminder', array(
            'cms_form_id' => $cms_form_id,
            'remind_at' => (new DateTime())->add(new DateInterval('PT' . $interval . 'H'))->format(DFB_DT),
            'limit' => $limit
        ));
    } catch (Exception $e) {
    } finally {
        return $ret;
    }
}

function updateReminder($cms_form_id, $time, $interval, $limit, $expired)
{
    $ret = false;
    $db = Database::getDbh();
    try {
        $ret = $db->update('assessment_reminder', array(
            'cms_form_id' => $cms_form_id,
            'remind_at' => (new DateTime($time))->add(new DateInterval('PT' . $interval))->format(DFB_DT),
            'limit' => $limit,
            'expired' => $expired
        ));
    } catch (Exception $e) {
    } finally {
        return $ret;
    }
}

function getUnrespondedDeptStatus($cms_form_id)
{
    $db = Database::getDbh();
    return $db->where('status', STATUS_IMPACT_ASSESSMENT_RESPONSE_PENDING)
        ->where('cms_form_id', $cms_form_id)
        ->objectBuilder()
        ->get('impact_ass_status');
}

function get_include_contents($filename, $variablesToMakeLocal)
{
    extract($variablesToMakeLocal);
    $file = APP_ROOT . "/templates/$filename.php";
    if (is_file($file)) {
        ob_start();
        require "$file";
        $body = ob_get_clean();
        return $body;
    } else {
        return "";
    }
}

function getRemindersPending()
{
    $db = Database::getDbh();
    $ret = $db->where('expired', NULL, 'IS')
        ->objectBuilder()
        ->get('assessment_reminder');
    return $ret;
}

function echoYou($user_id, $substitute)
{
    /*if (empty($user_id)) {
        $user_id = getUserSession()->user_id;
    }*/
    if (its_logged_in_user($user_id)) {
        return " You ";
    }
    return $substitute;
}

function insertLog($cms_form_id, $action, $remarks, $performed_by)
{
    $db = Database::getDbh();
    $data = array(
        'cms_form_id' => $cms_form_id,
        'action' => $action,
        'remarks' => $remarks,
        'performed_by' => $performed_by
    );
    return $db->insert('cms_action_log', $data);
}