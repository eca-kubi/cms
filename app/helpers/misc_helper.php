<?php

function arrToObj($arr)
{
    return json_decode(json_encode($arr));
}

function objToArr($obj)
{
    return json_decode(json_encode($obj), true);
}

// redirect to appropriate page based on role
function redirectByRole($role)
{
    switch ($role) {
        case 'hrsys':
        case 'hrsup':
            redirect('hrs');
            break;
        case 'meddoc':
            redirect('doctors');
            break;
        case 'sysadmin':
            redirect('sysadmins');
            break;
        case 'mgr':
            redirect('managers');
            break;
        case 'staff':
            redirect('staffs');
            break;
        default:
    }
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

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $multiple ? $file_post[$key][$i] : $file_post[$key];
        }
    }

    return $file_ary;
}

function isOffday($datetime, $workday_scheme = [0, 1, 1, 1, 1, 1, 0])
{
    $day_of_week = $datetime->format('w');
    return $workday_scheme[$day_of_week] == 0;
}

function computeDaysEarnedOld(&$value)
{
    $earning_start = new \DateTime($value->employment_date);
    $now = new \DateTime;
    $value->annual_earning = $value->unit_earning;
    if ($value->accruable == 1) {
        $unit_earning = $value->annual_earning/12;
        $accrued = ($earning_start->diff($now)->m) * $unit_earning;
        $days_remaining = $value->annual_earning - $value->total_days_taken;
        $value->accrued = $accrued;
        $value->days_remaining = $days_remaining;
    } else {
        if (!empty($value->annual_earning)) {
            $value->accrued = $value->annual_earning;
            $value->days_remaining = $value->accrued - $value->total_days_taken;
        } else {
            $value->annual_earning = 'N/A';
            $value->accrued = 'N/A';
            $value->days_remaining ='N/A';
        }
    }
}

function computeDaysEarned(&$value)
{
    $now = new \DateTime;
    $start_accrual = empty($value->contract_start)? $value->employment_date : $value->contract_start;
    if ($value->accruable == 1) {
        $start_accruing_from = new \DateTime($start_accrual);
        $value->accrued = ($start_accruing_from->diff($now)->m) * 2.5;
        $value->days_remaining = $value->accrued - $value->days_taken;
    }
    elseif (empty($value->annual_earning)) {
      $value->annual_earning = 'N/A';
      $value->accrued = 'N/A';
      $value->days_remaining ='N/A';
    } else {
        $value->days_remaining = $value->annual_earning - $value->days_taken;
        $value->accrued = 'N/A';
    }
}

function getLeaveStatus($user_id)
{
    $db = Database::getDbh();
    $leave_status = $db->where('user_id', $user_id)
        ->ObjectBuilder()
        ->groupBy('status')
        ->get('leave_transaction', null, 'status, count("status") total_count');
    return $leave_status;
}

/**
 * Summary of getPendingLeave
 * @return object
 */
function getPendingLeave()
{
    $db = Database::getDbh();
    $leave_status = $db->where('status', STATUS_LEAVE_PENDING)
        ->ObjectBuilder()
        ->get('leave_transaction', null, 'status, count("status") total_count');
    return (object)$leave_status;
}

function getNameInitials($first_name, $last_name) {

}

function userExists($user_id)
{
	 $db = Database::getDbh();
 return   $db->where('user_id', $user_id)
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
    if (!empty($_REQUEST['current_session']))
    {
        $current_session = $_REQUEST['current_session'];
    }

    return $current_session;
}

/**
 * Summary of filterPost
 * It returns filtered POST array
 * @return array
 */
function filterPost()
{
    return  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
}

function requireModel(string $model)
{
    require_once '../app/models/' . ucwords( $model) . '.php';
    return new $model();
}
