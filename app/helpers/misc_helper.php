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

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $multiple ? $file_post[$key][$i] : $file_post[$key];
        }
    }

    return $file_ary;
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

function getData($payload)
{
    return (array)$payload;
}

function today()
{
	echo ((new DateTime)->format(DFF));
}

/**
 * Summary of removeEmptyVal
 * @param array|object $value
 * @return array
 */
function removeEmptyVal($value)
{
    $value = (array)$value;
	foreach ($value as $key => $item)
    {
        if (empty($item))
        {
        	unset($value[$key]);
        }
    }
    return $value;
}

function echoIfEmpty($target, $replacement)
{
	echo empty($target)? $replacement: $target;
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
 *Concats array elements with $symbol and $symbolForlastElem
 * @param array $array
 * @return string
 */
function concatWith(string $symbol, $symbolForLastElem, array $array)
{
	if(count($array) == 1) {
        return $array[0];
    }

    if (count($array) < 1)
    {
    	return '';
    }

    $lastElem = end($array);
    $lastElemKey = key($lastElem);

    unset($array[$lastElemKey]);
    $result = implode($symbol, $array);
    return $result . $symbolForLastElem. $lastElem;
}

function notifyOHSForMonitoring($cms_form_id)
{
	$originator = getUserSession()->first_name . ' '. getUserSession()->last_name;
    $link = URL_ROOT . '/cms-forms/view-change-process/'. $cms_form_id;
    $subject = 'Change Proposal, Assessment and Implementation';
    $body = 'Hi, ' . HTML_NEW_LINE . 'A Change Proposal application has been raised by '. $originator. HTML_NEW_LINE.
                'Use the link below to approve it.' . HTML_NEW_LINE. $link;
    $ohs_id = Database::getDbh()->where('department', OHS_DEPARTMENT)->
        getValue(TABLE_DEPARTMENT, 'department_id');
    $ohs_superintendent = Database::getDbh()->where('department_id', $ohs_id)
        ->where('role', 'Superintendent')
        ->getValue('users', 'user_id');
    $ohs_manager = Database::getDbh()->where('department_id', $ohs_id)
        ->where('role', 'Manager')
        ->getValue('users', 'user_id');
    $email_model = new EmailModel();
    if ($ohs_superintendent)
    {
    	$email_model->add([
        'subject' => $subject,
        'body' => $body,
        'recipient_user_id' => $ohs_superintendent
    ]);
    }
    if ($ohs_manager)
    {
    	$email_model->add([
        'subject' => $subject,
        'body' => $body,
        'recipient_user_id' => $ohs_manager
    ]);
    }
}

function isBudgetHigh($cms_form_id) {

}

function alert($message, $class)
{
	echo "<p class=$class>". $message . '</p>';
}

function getAffectedDepartments($cms_form_id)
{
    $results = [];
    $dept_model = new DepartmentModel();
    $affected_dept = Database::getDbh()->where('cms_form_id', $cms_form_id)
        ->getValue('cms_form', 'affected_dept');
    if (!empty($affected_dept))
    {
        foreach (explode(',', $affected_dept) as $dept_id)
        {
    	    $results[] = $dept_model->getDepartment($dept_id);
        }
    }
    return $results;
}

if ( ! function_exists( 'array_key_last' ) ) {
    /**
     * Polyfill for array_key_last() function added in PHP 7.3.
     *
     * Get the last key of the given array without affecting
     * the internal array pointer.
     *
     * @param array $array An array
     *
     * @return mixed The last key of array if the array is not empty; NULL otherwise.
     */
    function array_key_last( $array ) {
        $key = NULL;

        if ( is_array( $array ) ) {

            end( $array );
            $key = key( $array );
        }

        return $key;
    }
}