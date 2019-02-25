<?php
/**
 * Created by PhpStorm.
 * User: UNCLE CHARLES
 * Date: 1/7/2019
 * Time: 1:07 PM
 */
spl_autoload_register(function ($class_name) {
    $dirs = array(
        '../models/',
        '../libraries/',
        '../classes/'
    );
    foreach ($dirs as $dir) {
        if (!file_exists("../app/$dir$class_name.php")) {
            continue;
        } else {
            require_once("../app/$dir$class_name.php");
        }
    }
});
require_once '../../vendor/autoload.php';
require_once '../config/host.php';
require_once '../config/config.php';
require_once 'misc_helper.php';

while (true) {
    $pending = getRemindersPending();
    foreach ($pending as $reminder_pending) {
        $cms_form_id = $reminder_pending->cms_form_id;
        $remind_at = $reminder_pending->remind_at;
        $limit = $reminder_pending->limit;
        $expired = $reminder_pending->expired;
        try {
            $current_time = (new DateTime())->format(DFB_DT);
        } catch (Exception $e) {
            $current_time = '';
        }
        // notify  if time has expired
        if ($remind_at < $current_time && !$expired) {
            $statuses = getUnrespondedDeptStatus($cms_form_id);
            foreach ($statuses as $status) {
                $message = array();
                $dept_id = $status->department_id;
                $department = new Department($dept_id);
                $subject = genEmailSubject($cms_form_id);
                $hods = getHodsWithCurrent($dept_id);
                foreach ($hods as $hod) {
                    $recipient_name = concatNameWithUserId($hod->user_id);
                    $message['department'] = $department->department;
                    $message['recipient'] = $recipient_name;
                    $message['link'] = site_url("cms-forms/view-change-process/$cms_form_id");
                    $body = get_include_contents('impact_assessment_reminder', $message);
                    $address = $hod->email;
                    insertEmail($subject, $body, $address, $recipient_name);
                }
            }
            // set next remind time, decrease limit and set expired
            if ($limit <= 1) {
                $expired = 1;
            }
            updateReminder($cms_form_id, $remind_at, REMINDER_INTERVAL, --$limit, $expired);
        }
    }
    sleep(10);
}




    