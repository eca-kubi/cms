<?php

/**
 * @property UserModel userModel
 */
class CMSForms extends Controller
{
    private $db;

    /**
     * CMSForms constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getDbh();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        redirect('cms-forms/dashboard');
    }

    public function Dashboard($filter = '')
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $payload['title'] = 'CMS Dashboard';
        $payload['active'] = CMSFormModel::getActive();
        $payload['closed'] = CMSFormModel::getClosed();
        $payload['rejected'] = CMSFormModel::getRejected();
        $payload['gms'] = getGms();
        $payload['current_gm'] = (new CmsSettingsModel())->getValue('current_gm');
        $payload['dashboard'] = true;
        if (!empty($filter)) {
            $payload['filter'] = $filter;
        }
        if (!empty($filter)) {
            $this->view('cms_forms/dashboard_filter', $payload);
        } else {
            $this->view('cms_forms/dashboard', $payload);
        }
    }

    public function StartChangeProcess()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $current_user = getUserSession();
        $payload['title'] = 'New Change Proposal Form';
        $payload['ref_num'] = $payload['reference'] = getDeptRef($current_user->department_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $form_model = prepPostData(SECTION_START_CHANGE_PROCESS);
            $cms_form_id = $form_model->insert();
            if ($cms_form_id) {
                $form_model = new CMSFormModel(['cms_form_id' => $cms_form_id]);
                $result = uploadFile('additional_info', $cms_form_id, PATH_ADDITIONAL_INFO);
                $ret = false;
                if ($result['success']) {
                    $form_model->additional_info = $result['file'];
                    $ret = $form_model->updateForm($cms_form_id);
                } else {
                    flash_error('start-change-process');
                    redirect('cms-forms/start-change-process/');
                }
                if ($ret) {
                    flash_success('view-change-process');
                    $performed_by = concatNameWithUserId($current_user->user_id);
                    $hods = getHodsWithCurrent($current_user->department_id);
                    $hods[] = $current_user;
                    $recipients = array_unique_multidim_array($hods, 'user_id');
                    $subject = genEmailSubject($cms_form_id);
                    $data = array(
                        'subject' => $subject,
                        'performed_by' => $performed_by,
                        'link' => site_url("cms-forms/view-change-process/$cms_form_id")
                    );
                    insertEmailBulk('email_templates/change_raised', $recipients, $data);
                    $data['performed_by'] = getNameJobTitleAndDepartment($current_user->user_id);
                    $remarks = get_include_contents('action_remarks_templates/change_raised', $data);
                    insertLog($cms_form_id, ACTION_START_CHANGE_PROCESS_COMPLETED, $remarks, $current_user->user_id);
                    completeSection($cms_form_id, SECTION_START_CHANGE_PROCESS);
                    redirect('cms-forms/view-change-process/' . $cms_form_id);
                } else {
                    flash_error('start_change_process');
                    redirect('cms-forms/start-change-process/');
                }
            }
        }
        $this->view('cms_forms/start_change_process', $payload);
    }

    public function HODAssessment(int $cms_form_id = -1)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $current_user = getUserSession();
            //$payload['action_log'] = getActionLog($cms_form_id);
            $form_model = prepPostData(SECTION_HOD_ASSESSMENT, $cms_form_id);
            $payload['form'] = $form_model;
            $ret = $form_model->updateForm($cms_form_id);
            if ($ret) {
                flash_success();
            } else {
                flash_error();
            }
            $link = site_url("cms-forms/view-change-process/$cms_form_id");
            $subject = genEmailSubject($cms_form_id);
            $data = array(
                'subject' => $subject,
                'performed_by' => concatNameWithUserId($current_user->user_id),
                'link' => $link,
                'approval_status' => $form_model->hod_approval,
            );
            $dept_mgr = getDepartmentHod($current_user->department_id);
            $recipients[] = new User($form_model->originator_id);
            $recipients[] = $current_user;
            if (!empty($dept_mgr)) {
                $recipients[] = $dept_mgr;
            }
            $recipients = array_unique_multidim_array($recipients, 'user_id');
            insertEmailBulk('email_templates/hod_assessment', $recipients, $data);
            $data['performed_by'] = getNameJobTitleAndDepartment($current_user->user_id);
            $remarks = get_include_contents('action_remarks_templates/hod_assessment', $data);
            insertLog($cms_form_id, ACTION_HOD_ASSESSMENT_COMPLETED, $remarks, $current_user->user_id);
            completeSection($cms_form_id, SECTION_HOD_ASSESSMENT);
            redirect('cms-forms/view-change-process/' . $cms_form_id);
        }
        redirect('cms-forms/view-change-process/' . $cms_form_id);
    }

    public function RiskAssessment(int $cms_form_id = -1)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $current_user = getUserSession();
            $form_model = prepPostData(SECTION_RISK_ASSESSMENT, $cms_form_id);
            $uploaded = uploadFile('risk_attachment', $cms_form_id, PATH_RISK_ATTACHMENT);
            if (!$uploaded['success']) {
                flash_error();
                redirect('cms-forms/view-change-process/' . $cms_form_id);
            } else {
                $form_model->risk_attachment = $uploaded['file'];
            }
            $ret = $form_model->updateForm($cms_form_id);
            if ($ret) {
                $data = array(
                    'subject' => genEmailSubject($cms_form_id),
                    'performed_by' => getNameJobTitleAndDepartment($current_user->user_id)
                );
                $remarks = get_include_contents('action_remarks_templates/risk_assessment_completed', $data);
                insertLog($cms_form_id, ACTION_RISK_ASSESSMENT_COMPLETED, $remarks, $current_user->user_id);
                completeSection($cms_form_id, SECTION_RISK_ASSESSMENT);
                notifyAllHODs($cms_form_id);
                setReminder($cms_form_id, REMINDER_INTERVAL, REMINDER_LIMIT);
                populateImpactResponse(explode(',', $form_model->affected_dept), $cms_form_id);
                flash_success();
            } else {
                flash_error();
            }
            redirect('cms-forms/view-change-process/' . $cms_form_id);
        }
        redirect('cms-forms/view-change-process/' . $cms_form_id);
    }

    /**
     * @param $cms_form_id
     * @param $department_id
     */
    public function ImpactResponse($cms_form_id, $department_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $current_user = getUserSession();
            $form_model = new CMSForm(['cms_form_id' => $cms_form_id]);
            $payload['form'] = $form_model;
            $department = getDepartment($current_user->user_id);
            $ret = false;
            foreach ($_POST as $key => $response) {
                $array_key_value = explode('_', $key);
                $cms_response_id = end($array_key_value);
                $ret = Database::getDbh()
                    ->where('cms_impact_response_id', $cms_response_id)
                    ->update('cms_impact_response', ['response' => $response]);
            }
            if ($ret) {
                //flash_success();
                $recipients[] = new User(getCurrentManager($form_model->department_id));
                $recipients[] = new User($form_model->originator_id);
                $dept_mgr = getDepartmentHod($form_model->department_id);
                if (!empty($dept_mgr)) {
                    $recipients[] = $dept_mgr;
                }
                $recipients = array_unique_multidim_array($recipients, 'user_id');
                $link = site_url("cms-forms/view-change-process/$cms_form_id");
                $subject = genEmailSubject($cms_form_id);
                $data = array(
                    'subject' => $subject,
                    'performed_by' => concatNameWithUserId($current_user->user_id),
                    'link' => $link
                );
                insertEmailBulk('email_templates/impact_assessment_completed', $recipients, $data);
                $data['performed_by'] = getNameJobTitleAndDepartment($current_user->user_id);
                $data['department'] = $department;
                $remarks = get_include_contents('action_remarks_templates/impact_assessment_completed', $data);
                insertLog($cms_form_id, ACTION_IMPACT_ASSESSMENT_RESPONSE_COMPLETED, $remarks, $current_user->user_id);
                $impact_ass_status = new ImpactAssStatusModel(['department_id' => $department_id, 'cms_form_id' => $cms_form_id]);
                $impact_ass_status->setHodComment($_POST['hod_comment'])
                    ->setStatus(STATUS_IMPACT_ASSESSMENT_COMPLETED)
                    ->setCompletedBy($current_user->user_id)
                    ->setApprovedBy(getUserSession()->user_id);
                try {
                    $impact_ass_status->setCompletedDate((new DateTime())->format(DFB_DT));
                } catch (Exception $e) {
                }
                $data = $impact_ass_status->jsonSerialize();
                $ret = $impact_ass_status->updateForm([
                    'cms_form_id' => $cms_form_id,
                    'department_id' => $department_id
                ], $data);
                if ($ret) {
                    flash_success('', "Impact Assessment for " . $department . " completed successfully!");
                    if (isAllImpactAssessmentComplete($cms_form_id)) {
                        $current_gm = new User(getCurrentGM());
                        $data = array(
                            'recipient_name' => concatNameWithUserId($current_gm->user_id),
                            'subject' => $subject,
                            'hod' => getNameJobTitleAndDepartment($current_user->user_id),
                            'link' => $link
                        );
                        $body = get_include_contents('email_templates/notify_gm', $data);
                        insertEmail($subject, $body, $current_gm->email, concatNameWithUserId($current_gm->user_id));
                        completeSection($cms_form_id, SECTION_IMPACT_ASSESSMENT);
                    }
                } else {
                    flash_error();
                }
            } else {
                flash_error();
            }
        }
        redirect('cms-forms/view-change-process/' . $cms_form_id);
    }

    public function GMAssessment(int $cms_form_id = -1)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $form_model = new CMSFormModel(['cms_form_id' => $cms_form_id]);
            $originator = new User($form_model->originator_id);
            $hod = getDepartmentHod($form_model->department_id);
            $current_user = getUserSession();
            $current_hod = getCurrentManager($form_model->department_id);
            $subject = genEmailSubject($cms_form_id);
            $_POST = filterPost();
            $form_model->gm_approval = $_POST['gm_approval'];
            $form_model->gm_approval_reasons = $_POST['gm_approval_reasons'];
            try {
                $form_model->gm_approval_date = (new DateTime())->format(DFB_DT);
            } catch (Exception $e) {
            }
            $form_model->gm_id = getUserSession()->user_id;
            if ($form_model->gm_approval == STATUS_REJECTED) {
                $form_model->state = STATUS_REJECTED;
            }
            if ($form_model->updateForm($cms_form_id)) {
                flash_success();
                $data['performed_by'] = concatNameWithUserId($current_user->user_id);
                $data['subject'] = $subject;
                $data['link'] = site_url("cms-forms/view-change-process/$cms_form_id");
                $data['approval_status'] = $form_model->gm_approval;
                $recipients[] = new User($current_hod);
                if (!empty($hod)) {
                    $recipients[] = $hod;
                }
                $recipients[] = $originator;
                $recipients = array_unique_multidim_array($recipients, 'user_id');
                insertEmailBulk('email_templates/gm_assessment', $recipients, $data);
                completeSection($cms_form_id, SECTION_GM_ASSESSMENT);
                $remarks = get_include_contents('action_remarks_templates/gm_assessment', $data);
                insertLog($cms_form_id, ACTION_GM_ASSESSMENT_COMPLETED, $remarks, $current_user->user_id);
            } else {
                flash_error();
            }
        }
        redirect('cms-forms/view-change-process/' . $cms_form_id);
    }

    public function HODAuthorisation(int $cms_form_id = -1)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $current_user = getUserSession();
            $recipients = [];
            $form_model = new CMSFormModel(['cms_form_id' => $cms_form_id]);
            $originator = new User($form_model->originator_id);
            $current_mgr = new User(getCurrentManager($form_model->department_id));
            $dept_hod = getDepartmentHod($form_model->department_id);
            $link = site_url("cms-forms/view-change-process/$cms_form_id");
            $subject = genEmailSubject($cms_form_id);
            $_POST = filterPost();
            $form_model->hod_authorization = $_POST['hod_authorization'];
            $form_model->hod_authorization_comment = $_POST['hod_authorization_comment'];
            $form_model->project_leader_id = $_POST['project_leader_id'];
            $project_leader = new User($form_model->project_leader_id);
            try {
                $form_model->hod_authorization_date = (new DateTime())->format(DFB_DT);
            } catch (Exception $e) {
            }
            $ret = $form_model->updateForm($cms_form_id);
            if ($ret) {
                flash_success();
                if (!empty($dept_hod)) {
                    $recipients[] = $dept_hod;
                }
                $recipients[] = $originator;
                $recipients[] = $current_mgr;
                $recipients = array_unique_multidim_array($recipients, 'user_id');
                $recipients = array_filter_multidim_by_obj_prop($recipients, 'user_id', $current_user->user_id, function ($a, $b) {
                    return $a != $b;
                });
                $template_data = array(
                    'performed_by' => concatNameWithUserId($current_user->user_id),
                    'subject' => $subject,
                    'link' => $link
                );
                insertEmailBulk('email_templates/hod_authorization', $recipients, $template_data);
                $remarks = get_include_contents('action_remarks_templates/hod_authorization', $template_data);
                insertLog($cms_form_id, ACTION_HOD_AUTHORISATION_COMPLETED, $remarks, $current_user->user_id);
                $template_data['project_leader'] = concatNameWithUserId($project_leader->user_id);
                $template_data['project_owner'] = concatNameWithUserId($current_user->user_id);
                $body = get_include_contents('email_templates/pl_selected', $template_data);
                insertEmail($subject, $body, $project_leader->email, concatNameWithUserId($project_leader->user_id));
                completeSection($cms_form_id, SECTION_HOD_AUTHORISATION);
            } else {
                flash_error();
            }
        }
        redirect('cms-forms/view-change-process/' . $cms_form_id);
    }

    public function ProjectLeaderAcceptance(int $cms_form_id = -1)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $current_user = getUserSession();
            $form_model = new CMSFormModel(['cms_form_id' => $cms_form_id]);
            $_POST = filterPost();
            $form_model->setProjectLeaderAcceptance(STATUS_ACCEPTED);
            $form_model->project_leader_acceptance_comment = $_POST['project_leader_acceptance_comment'];
            try {
                $form_model->project_leader_acceptance_date = (new DateTime())->format(DFB_DT);
            } catch (Exception $e) {
            }
            $ret = $form_model->updateForm($cms_form_id);
            if ($ret) {
                flash_success();
                completeSection($cms_form_id, SECTION_PL_ACCEPTANCE);
                $data = [
                    'performed_by' => concatNameWithUserId($current_user->user_id),
                    'subject' => genEmailSubject($cms_form_id)
                ];
                $remarks = get_include_contents('action_remarks_templates/pl_acceptance', $data);
                insertLog($cms_form_id, ACTION_PROJECT_LEADER_ACCEPTANCE_COMPLETED, $remarks, $current_user->user_id);
            } else {
                flash_error();
            }
        }
        redirect('cms-forms/view-change-process/' . $cms_form_id);
    }

    public function ProjectLeaderClosure($cms_form_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $current_user = getUserSession();
            $_POST = filterPost();
            $form_model = new CMSFormModel(['cms_form_id' => $cms_form_id]);
            $subject = genEmailSubject($cms_form_id);
            $performed_by = getNameJobTitleAndDepartment($current_user->user_id);
            $link = site_url("cms-forms/view-change-process/$cms_form_id");
            $role = 'Project Leader';
            $data = compact('subject', 'performed_by', 'role', 'link');
            try {
                dbStartTransaction();
                $ret = $form_model->updateForm($cms_form_id, [
                    'project_leader_close_change' => (new DateTime())->format(DFB_DT),
                    'pl_closure_comment' => $_POST['pl_closure_comment']
                ]);
                if ($ret) {
                    completeSection($cms_form_id, SECTION_ACTION_LIST);
                    $recipients[] = getDepartmentHod($form_model->department_id);
                    $cur_mgr_id = getCurrentManager($form_model->department_id);
                    $recipients[] = new User($cur_mgr_id);
                    $recipients = array_unique_multidim_array($recipients, 'user_id');
                    $recipients = array_filter_multidim_by_obj_prop($recipients, 'user_id', $current_user->user_id, function ($a, $b) {
                        return $a != $b;
                    });
                    foreach ($recipients as $recipient) {
                        $recipient_name = concatNameWithUserId($recipient['user_id']);
                        $data['role'] = $role;
                        $data['recipient_user_id'] = $recipient['user_id'];
                        $body = get_include_contents('email_templates/change_closed', $data);
                        $ret = insertEmail($subject, $body, $recipient['email'], $recipient_name);
                    }
                    if ($ret) {
                        $remarks = get_include_contents('action_remarks_templates/change_closed', $data);
                        $performed_by = $current_user->user_id;
                        $ret = insertLog($cms_form_id, ACTION_PL_CLOSURE, $remarks, $performed_by);
                        if ($ret) {
                            if (dbCommit()) {
                                flash_success();
                            }
                        } else {
                            dbRollBack();
                            flash_error();
                        }
                    }
                }
            } catch (Exception $e) {
                flash_error();
            }
        }
        redirect("cms-forms/view-change-process/$cms_form_id");
    }

    public function OriginatorClosure(int $cms_form_id = -1)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $current_user = getUserSession();
            $_POST = filterPost();
            $form_model = new CMSFormModel(['cms_form_id' => $cms_form_id]);
            $subject = genEmailSubject($cms_form_id);
            $performed_by = getNameJobTitleAndDepartment($current_user->user_id);
            $link = site_url("cms-forms/view-change-process/$cms_form_id");
            $role = 'Originator';
            $data = compact('subject', 'performed_by', 'role', 'link');
            try {
                dbStartTransaction();
                $ret = $form_model->updateForm($cms_form_id, [
                    'originator_close_change' => (new DateTime())->format(DFB_DT),
                    'originator_closure_comment' => $_POST['pl_closure_comment']
                ]);
                if ($ret) {
                    $recipients[] = getDepartmentHod($form_model->department_id);
                    $cur_mgr_id = getCurrentManager($form_model->department_id);
                    $recipients[] = new User($cur_mgr_id);
                    $recipients = array_unique_multidim_array($recipients, 'user_id');
                    $recipients = array_filter_multidim_by_obj_prop($recipients, 'user_id', $current_user->user_id, function ($a, $b) {
                        return $a != $b;
                    });
                    foreach ($recipients as $recipient) {
                        $recipient_name = concatNameWithUserId($recipient['user_id']);
                        $data['recipient_user_id'] = $recipient['user_id'];
                        $data['role'] = $role;
                        $body = get_include_contents('email_templates/change_closed', $data);
                        $ret = insertEmail($subject, $body, $recipient['email'], $recipient_name);
                    }
                    if ($ret) {
                        $remarks = get_include_contents('action_remarks_templates/change_closed', $data);
                        $performed_by = $current_user->user_id;
                        $ret = insertLog($cms_form_id, ACTION_ORIGINATOR_CLOSURE, $remarks, $performed_by);
                        if ($ret) {
                            if (dbCommit()) {
                                flash_success();
                            }
                        } else {
                            dbRollBack();
                            flash_error();
                        }
                    }
                }
            } catch (Exception $e) {
                flash_error();
            }
        }
        redirect("cms-forms/view-change-process/$cms_form_id");
    }

    public function HODClosure(int $cms_form_id = -1)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $current_user = getUserSession();
            $_POST = filterPost();
            $form_model = new CMSFormModel(['cms_form_id' => $cms_form_id]);
            $subject = genEmailSubject($cms_form_id);
            $performed_by = getNameJobTitleAndDepartment($current_user->user_id);
            $link = site_url("cms-forms/view-change-process/$cms_form_id");
            $role = 'HoD';
            $data = compact('subject', 'performed_by', 'role', 'link');
            try {
                dbStartTransaction();
                $ret = $form_model->updateForm($cms_form_id, [
                    'hod_close_change' => (new DateTime())->format(DFB_DT),
                    'hod_closure_comment' => $_POST['pl_closure_comment'],
                    'state' => STATUS_CLOSED,
                    'date_closed' => now()
                ]);
                if ($ret) {
                    $recipients[] = getDepartmentHod($form_model->department_id);
                    $cur_mgr_id = getCurrentManager($form_model->department_id);
                    $recipients[] = new User($cur_mgr_id);
                    $recipients = array_unique_multidim_array($recipients, 'user_id');
                    $recipients = array_filter_multidim_by_obj_prop($recipients, 'user_id', $current_user->user_id, function ($a, $b) {
                        return $a != $b;
                    });
                    foreach ($recipients as $recipient) {
                        $recipient_name = concatNameWithUserId($recipient['user_id']);
                        $data['recipient_user_id'] = $recipient['user_id'];
                        $data['role'] = $role;
                        $body = get_include_contents('email_templates/change_closed', $data);
                        $ret = insertEmail($subject, $body, $recipient['email'], $recipient_name);
                    }
                    if ($ret) {
                        $remarks = get_include_contents('action_remarks_templates/change_closed', $data);
                        $performed_by = $current_user->user_id;
                        $ret = insertLog($cms_form_id, ACTION_HOD_CLOSURE, $remarks, $performed_by);
                        if ($ret) {
                            if (dbCommit()) {
                                completeSection($cms_form_id, SECTION_PROCESS_CLOSURE);
                                flash_success();
                            }
                        } else {
                            dbRollBack();
                            flash_error();
                        }
                    }
                }
            } catch (Exception $e) {
                flash_error();
            }
        }
        redirect("cms-forms/view-change-process/$cms_form_id");
    }

    public function ProcessClosed(int $cms_form_id = -1)
    {
    }

    public function ViewChangeProcess(int $cms_form_id = -1)
    {
        $payload = array();
        if (!CMSFormModel::has('cms_form_id', $cms_form_id)) {
            //redirect('errors/index/404');
            redirect('cms-forms/dashboard');
        }
        if (!isLoggedIn()) {
            redirect("users/login/$cms_form_id");
        }
        $payload['title'] = 'Change Proposal, Assessment & Implementation';
        $payload['form'] = new CMSForm(['cms_form_id' => $cms_form_id]);
        //$payload['active'] = CMSFormModel::getActive();
        //$payload['closed'] = CMSFormModel::getClosed();
        $payload['originator'] = new User($payload['form']->originator_id);
        $payload['hod'] = new User($payload['form']->hod_id);
        $payload['departments'] = (new DepartmentModel())->getAllDepartments();
        $payload['affected_departments'] = getAffectedDepartments($cms_form_id);
        $payload['cms_questions'] = getImpactQuestions();
        $payload['action_log'] = getActionLog($cms_form_id);
        $payload['gms'] = getGms();
        $payload['department_members'] = Database::getDbh()->where('department_id', getUserSession()->department_id)
            /*->where('role', 'Manager', '<>')
            ->where('role', 'Superintendent', '<>')*/
            ->objectBuilder()
            ->get('users');
        $this->view('cms_forms/view_change_process', $payload);
        //redirect('cms-forms/' . $payload['form']->next_action . '/' . $cms_form_id);
    }

    public function StopChangeProcess($cms_form_id)
    {
        $db = Database::getDbh();
        $date_stopped = "";
        $cms_form = new CMSFormModel(['cms_form_id' => $cms_form_id]);
        $subject = genEmailSubject($cms_form_id);
        $current_user = getUserSession();
        try {
            $date_stopped = (new DateTime())->format(DFB_DT);
        } catch (Exception $e) {
        }
        $db->where('cms_form_id', $cms_form_id)
            ->update('cms_form', array(
                'state' => STATUS_STOPPED,
                'date_stopped' => $date_stopped
            ));
        $user_id = getUserSession()->user_id;
        $name = getNameJobTitleAndDepartment($user_id);
        $arr = array(
            'performed_by' => $name,
            'subject' => genEmailSubject($cms_form_id)
        );
        $remarks = get_include_contents('action_remarks_templates/change_stopped', $arr);
        /*(new CmsActionLogModel())->setAction(ACTION_CHANGE_CANCELLED)
            ->setPerformedBy($user_id)
            ->setCmsFormId($cms_form_id)
            ->setRemarks($remarks)
            ->setSectionAffected(SECTION_ALL)
            ->insert();*/
        insertLog($cms_form_id, ACTION_CHANGE_STOPPED, $remarks, $current_user->user_id);
        $hods = getHodsWithCurrent($cms_form->department_id);
        foreach ($hods as $hod) {
            $arr = array(
                'user_id' => $user_id,
                'performed_by' => $name,
                'subject' => genEmailSubject($cms_form_id)
            );
            $body = get_include_contents('email_templates/change_stopped', $arr);
            insertEmail($subject, $body, $hod->email, concatNameWithUserId($hod->user_id));
        }
        // todo: send email to hod (change owner)
        flash($flash = "flash_" . the_method(), "Change stopped successfully!", 'text-sm text-center text-success alert');
        goBack();
        /*if (isset($_GET['redirect'])) {
            header('location: ' . $_GET['redirect']);
            exit;
        } else {
            redirect('cms-forms/view-change-process');
        }*/
    }

    public function test()
    {
        try {
            echo (new DateTime())->format(DFB);
        } catch (Exception $e) {
        }
    }

    public function DownloadAdditionalInfo($cms_form_id)
    {
        $cms = new CMSFormModel(array('cms_form_id' => $cms_form_id));
        $file_name = $cms->getAdditionalInfo();
        $ref = $cms->getHodRefNum();
        if (empty($ref)) {
            $ref = getDeptRef($cms->department_id);
        }
        $files = explode(',', $file_name);
        $title = "Additional Documents";
        if (!file_exists('zip')) {
            mkdir('zip', 0777, true);
        }
        $zipname = 'zip/' . $title . "_$cms_form_id.zip";
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
            $the_file = PATH_ADDITIONAL_INFO . "$cms_form_id\\" . $file;
            $zip->addFile($the_file, basename($the_file));
        }
        $zip->close();
        if (headers_sent()) {
            echo 'HTTP header already sent';
        } else {
            if (!is_file($zipname)) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
                echo 'File not found';
            } else if (!is_readable($zipname)) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
                echo 'File not readable';
            } else {
                header("Content-Disposition: attachment; filename=\"$title.$ref.zip\"");
                header("Content-Type: " . "application/zip");
                readfile($zipname);
                exit;
            }
        }
    }

    public function DownloadRiskAttachment($cms_form_id)
    {
        $cms = new CMSFormModel(array('cms_form_id' => $cms_form_id));
        $file_name = $cms->getRiskAttachment();
        $ref = $cms->getHodRefNum();
        if (empty($ref)) {
            $ref = getDeptRef($cms->department_id);
        }
        $files = explode(',', $file_name);
        $title = "Risk Assessment Documents";
        if (!file_exists('zip')) {
            mkdir('zip', 0777, true);
        }
        $zipname = 'zip/' . $title . "_$cms_form_id.zip";
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
            $the_file = PATH_RISK_ATTACHMENT . "$cms_form_id\\" . $file;
            $zip->addFile($the_file, basename($the_file));
        }
        $zip->close();
        if (headers_sent()) {
            echo 'HTTP header already sent';
        } else {
            if (!is_file($zipname)) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
                echo 'File not found';
            } else if (!is_readable($zipname)) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
                echo 'File not readable';
            } else {
                header("Content-Disposition: attachment; filename=\"$title.$ref.zip\"");
                header("Content-Type: " . "application/zip");
                readfile($zipname);
                exit;
            }
        }
    }

    public function DownloadPlDocuments($cms_form_id)
    {
        $cms = new CMSFormModel(array('cms_form_id' => $cms_form_id));
        $file_name = $cms->pl_documents;
        $ref = $cms->getHodRefNum();
        if (empty($ref)) {
            $ref = getDeptRef($cms->department_id);
        }
        $files = explode(',', $file_name);
        $title = "PL Documents";
        if (!file_exists('zip')) {
            mkdir('zip', 0777, true);
        }
        $zipname = 'zip/' . $title . "_$cms_form_id.zip";
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
            $the_file = PATH_PL_DOCUMENTS . "$cms_form_id\\" . $file;
            $zip->addFile($the_file, basename($the_file));
        }
        $zip->close();
        if (headers_sent()) {
            echo 'HTTP header already sent';
        } else {
            if (!is_file($zipname)) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
                echo 'File not found';
            } else if (!is_readable($zipname)) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
                echo 'File not readable';
            } else {
                header("Content-Disposition: attachment; filename=\"$title.$ref.zip\"");
                header("Content-Type: " . "application/zip");
                readfile($zipname);
                exit;
            }
        }
    }
    /*
        public function downloadFile()
        {
        }*/

    /*public function HODComment($cms_form_id, $department_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $impact_ass_status = new ImpactAssStatusModel(['department_id' => $department_id, 'cms_form_id' => $cms_form_id]);
            $impact_ass_status->setHodComment($_POST['hod_comment'])
                ->setStatus(STATUS_IMPACT_ASSESSMENT_COMPLETED)
                ->setApprovedBy(getUserSession()->user_id);
            try {
                $impact_ass_status->setHodCommentDate((new DateTime())->format(DFB_DT));
            } catch (Exception $e) {
            }

            $data = $impact_ass_status->jsonSerialize();
            $impact_ass_status->updateForm([
                'cms_form_id' => $cms_form_id,
                'department_id' => $department_id
            ], $data);

            // set action log
            (new CmsActionLogModel())->setAction(ACTION_IMPACT_ASSESSMENT_HOD_COMMENTED)
                ->setPerformedBy(getUserSession()->user_id)
                ->setCmsFormId($cms_form_id)
                ->setSectionAffected(SECTION_IMPACT_ASSESSMENT)
                ->setDepartmentAffected($department_id)
                ->insert();

            updateImpactAssessmentCompleteList($cms_form_id, $department_id);

            if (isAllImpactAssessmentComplete($cms_form_id)) {
                notifyGms($cms_form_id);
                completeSection($cms_form_id, SECTION_IMPACT_ASSESSMENT);
            }
        }
        redirect('cms-forms/view-change-process/' . $cms_form_id);
    }*/

    public function completedForm($cms_form_id)
    {
        $payload = [];
        $db = Database::getDbh();
        $form = $db->where('cms_form_id', $cms_form_id)
            ->objectBuilder()
            ->getOne('cms_form');
        $payload['cms_form_id'] = $cms_form_id;
        $payload['form'] = $form;

        flash('completed_form', 'Under Construction. Will be ready in a bit!', 'alert text-warning');
        $this->view('cms_forms/completed_form', $payload);
    }

    public function changeGM()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $flash = "flash_" . the_method();
            $db = Database::getDbh();
            $gm = $_POST['gm'];
            $gm_name = concatNameWithUserId($gm);
            $user = getUserSession();
            $user_name = concatNameWithUserId($user->user_id);
            $ret = $db->where('prop', 'current_gm')
                ->update('cms_settings', array('value' => $gm));
            if ($ret) {
                // set action log
                $remarks = "$user_name changed the GM to "
                    . " $gm_name";
                $action_log_model = new CmsActionLogModel();
                $action_log_model->setAction(ACTION_CHANGED_GM)
                    ->setPerformedBy(getUserSession()->user_id)
                    ->setRemarks($remarks)
                    ->insert();
                flash($flash, 'GM changed successfully!', 'text-center text-success alert text-sm');
            } else {
                flash($flash, 'An error occurred!', 'text-center text-danger alert text-sm');
            }
        }
        goBack();
    }

    public function changeManager($department_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $db = Database::getDbh();
            $new_mgr = new User($_POST['mgr']);
            $current_mgr = getCurrentManager($department_id);
            if (!empty($current_mgr)) {
                $current_mgr = new User(getCurrentManager($department_id));
            }
            $department = new Department($department_id);
            $current_user = getUserSession();
            $ret = $db->where('department_id', $department_id)
                ->update('departments', array('current_manager' => $new_mgr->user_id));
            if ($ret) {
                $data = array(
                    'subject' => SUBJECT_MANAGER_CHANGED . " for " . $department->department,
                    'performed_by' => concatNameWithUserId($current_user->user_id),
                    'performed_by_user_id' => $current_user->user_id,
                    'new_mgr_user_id' => $new_mgr->user_id,
                    'new_mgr_name' => concatNameWithUserId($new_mgr->user_id)
                );
                $recipients[] = $current_mgr;
                $recipients[] = new User($new_mgr->user_id);
                $recipients = array_unique_multidim_array($recipients, 'user_id');
                insertEmailBulk('email_templates/change_manager', $recipients, $data);
                $data['performed_by'] = getNameJobTitleAndDepartment($current_user->user_id);
                $data['new_mgr'] = getNameJobTitleAndDepartment($new_mgr->user_id);
                $data['department'] = $department->department;
                $remarks = get_include_contents('action_remarks_templates/change_manager', $data);
                insertLog(0, ACTION_CHANGED_MANAGER, $remarks, $current_user->user_id);
                flash_success('', 'Manager changed successfully!');
            } else {
                flash_error('', 'An error occurred!');
            }
        }
        goBack();
    }

    public function departmentManagers()
    {
        if (!isLoggedIn()) {
            redirect("users/login");
        }
        $payload = array();
        $payload['title'] = 'Department Managers';
        $current_user = getUserSession();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $mgrs = $_POST['mgrs'];
            $db = Database::getDbh();
            $recipients = [];
            foreach ($mgrs as $mgr) {
                if (!empty($mgr)) {
                    $dept_id = getDepartmentID($mgr);
                    $department = new Department($dept_id);
                    $current_mgr = getCurrentManager($dept_id);
                    $new_mgr = new User($mgr);
                    $new_mgr_name = concatNameWithUserId($new_mgr->user_id);
                    $subject = SUBJECT_MANAGER_CHANGED . " for " . $department->department;
                    if ($current_mgr !== (int)$mgr) {
                        $recipients[] = new User($mgr);
                        $ret = $db->where('department_id', $dept_id)
                            ->update('departments', array('current_manager' => $mgr));
                        if ($ret) {
                            $data = array(
                                'subject' => $subject,
                                'performed_by' => concatNameWithUserId($current_user->user_id),
                                'performed_by_user_id' => $current_user->user_id,
                                'new_mgr_user_id' => $new_mgr->user_id,
                                'new_mgr_name' => $new_mgr_name,
                                'recipient_user_id' => $new_mgr->user_id,
                                'recipient_department' => $department->department
                            );
                            $body = get_include_contents('email_templates/change_manager', $data);
                            insertEmail($subject, $body, $new_mgr->email, $new_mgr_name);
                            if (!empty($current_mgr)) {
                                $current_mgr = new User($current_mgr);
                                $current_mgr_name = concatNameWithUserId($current_mgr->user_id);
                                $data['recipient_user_id'] = $current_mgr->user_id;
                                $body = get_include_contents('email_templates/change_manager', $data);
                                insertEmail($subject, $body, $current_mgr->email, $current_mgr_name);
                            }
                            $data['performed_by'] = getNameJobTitleAndDepartment($current_user->user_id);
                            $data['new_mgr'] = getNameJobTitleAndDepartment($new_mgr->user_id);
                            $data['department'] = $department->department;
                            $remarks = get_include_contents('action_remarks_templates/change_manager', $data);
                            insertLog(0, ACTION_CHANGED_MANAGER, $remarks, $current_user->user_id);
                            flash_success();
                        } else {
                            flash_error();
                            redirect('cms-forms/department_managers');
                            break;
                        }
                    }
                }
            }
        }
        $this->view('cms_forms/department_managers', $payload);
    }

    public function uploadAdditionalDocuments($cms_form_id)
    {
        $current_user = getUserSession();
        $performed_by = getNameJobTitleAndDepartment($current_user->user_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $form_model = new CMSFormModel(['cms_form_id' => $cms_form_id]);
            $result = uploadFile('additional_info', $cms_form_id, PATH_ADDITIONAL_INFO);
            if ($result['success']) {
                $files = explode(',', trim($result['file'] . ',' . $form_model->additional_info, ','));
                $files = implode(',', array_unique($files));
                $ret = $form_model->updateForm($cms_form_id, ['additional_info' => $files]);
                if ($ret) {
                    flash_success('', 'File upload success!');
                } else {
                    flash_error('', 'An error occurred!');
                }
                $remarks = get_include_contents('action_remarks_templates/additional_doc_uploaded', array(
                    'file_name' => $result['file'],
                    'performed_by' => $performed_by,
                    'subject' => genEmailSubject($cms_form_id)
                ));
                insertLog($cms_form_id, ACTION_ADDITIONAL_FILE_UPLOADED, $remarks, $current_user->user_id);
            } else {
                flash_error('', 'An error occurred!');
            }
        }
        goBack();
    }

    public function uploadRiskAssDocuments($cms_form_id)
    {
        $current_user = getUserSession();
        $performed_by = getNameJobTitleAndDepartment($current_user->user_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $form_model = new CMSFormModel(['cms_form_id' => $cms_form_id]);
            $result = uploadFile('additional_info', $cms_form_id, PATH_RISK_ATTACHMENT);
            if ($result['success']) {
                $files = explode(',', trim($result['file'] . ',' . $form_model->risk_attachment, ','));
                $files = array_unique($files);
                $form_model->risk_attachment = implode(',', $files);
                $ret = $form_model->updateForm($cms_form_id);
                if ($ret) {
                    flash_success('', 'File upload success!');
                    $remarks = get_include_contents('action_remarks_templates/risk_assessment_uploaded', array(
                        'file_name' => $result['file'],
                        'performed_by' => $performed_by,
                        'subject' => genEmailSubject($cms_form_id)
                    ));
                    insertLog($cms_form_id, ACTION_RISK_ASSESSMENT_DOCUMENT_UPLOADED, $remarks, $current_user->user_id);
                } else {
                    flash_error('', 'An error occurred!');
                }
            } else {
                flash_error('', 'An error occurred!');
            }
        }
        goBack();
    }

    public function uploadPlDocuments($cms_form_id)
    {
        $current_user = getUserSession();
        $performed_by = getNameJobTitleAndDepartment($current_user->user_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $form_model = new CMSFormModel(['cms_form_id' => $cms_form_id]);
            $result = uploadFile('additional_info', $cms_form_id, PATH_PL_DOCUMENTS);
            if ($result['success']) {
                $files = explode(',', trim($result['file'] . ',' . $form_model->pl_documents, ','));
                $files = array_unique($files);
                $files = implode(',', $files);
                $ret = $form_model->updateForm($cms_form_id, ['pl_documents' => $files]);
                if ($ret) {
                    flash_success('', 'File upload success!');
                    $remarks = get_include_contents('action_remarks_templates/project_document_uploaded', array(
                        'file_name' => $result['file'],
                        'performed_by' => $performed_by,
                        'subject' => genEmailSubject($cms_form_id)
                    ));
                    insertLog($cms_form_id, ACTION_PROJECT_DOCUMENT_UPLOADED, $remarks, $current_user->user_id);
                } else {
                    flash_error('', 'An error occurred!');
                }
            } else {
                flash_error('', 'An error occurred!');
            }
        }
        goBack();
    }

    public function print($cms_form_id)
    {
        $payload = array();
        if (!CMSFormModel::has('cms_form_id', $cms_form_id)) {
            //redirect('errors/index/404');
            redirect('cms-forms/dashboard');
        }
        if (!isLoggedIn()) {
            redirect("users/login/$cms_form_id");
        }
        $payload['title'] = 'Change Proposal, Assessment & Implementation';
        $payload['form'] = new CMSForm(['cms_form_id' => $cms_form_id]);
        $payload['originator'] = new User($payload['form']->originator_id);
        $payload['hod'] = new User($payload['form']->hod_id);
        $payload['departments'] = (new DepartmentModel())->getAllDepartments();
        $payload['affected_departments'] = getAffectedDepartments($cms_form_id);
        $payload['cms_questions'] = getImpactQuestions();
        $payload['action_log'] = getActionLog($cms_form_id);
        $payload['gms'] = getGms();
        $payload['department_members'] = Database::getDbh()->where('department_id', getUserSession()->department_id)
            /*->where('role', 'Manager', '<>')
            ->where('role', 'Superintendent', '<>')*/
            ->objectBuilder()
            ->get('users');
        $this->view('cms_forms/print', $payload);
    }
}

?>