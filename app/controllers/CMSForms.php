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
        /*if (!isLoggedIn()) {
            redirect('users/login');
        }*/
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
        //$payload['show_search'] = true;
        // $payload['delayed'] = CMSFormModel::getDelayed();
        //$payload['stopped'] = CMSFormModel::getStopped();
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
        $payload = array();
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
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $current_user = getUserSession();
        $payload = array();
        $form_model = new CMSFormModel(['cms_form_id' => $cms_form_id]);
        $payload['title'] = "HOD's Approval ";
        $payload['action_log'] = getActionLog($cms_form_id);
        $payload['form'] = $form_model;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $form_model = prepPostData(SECTION_HOD_ASSESSMENT, $cms_form_id);
            $payload['form'] = $form_model;
            $ret = $form_model->updateForm($cms_form_id);
            if ($ret) {
                flash_success();
            } else {
                flash_error();
            }
            $link = site_url("/cms-forms/view-change-process/$cms_form_id");
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
                $recipients[] = $dept_mgr[0];
            }
            $recipients = array_unique_multidim_array($recipients, 'user_id');
            insertEmailBulk('email_templates/hod_assessment', $recipients, $data);
            $data['performed_by'] = getNameJobTitleAndDepartment($current_user->user_id);
            $remarks = get_include_contents('action_remarks_templates/hod_assessment', $data);
            insertLog($cms_form_id, ACTION_HOD_ASSESSMENT_COMPLETED, $remarks, $current_user->user_id);
            completeSection($cms_form_id, SECTION_HOD_ASSESSMENT);
            redirect('cms-forms/view-change-process/' . $cms_form_id);
        }
        $this->view('cms_forms/view_change_process', $payload);
    }

    public function RiskAssessment(int $cms_form_id = -1)
    {
        $payload = array();
        $current_user = getUserSession();
        //$payload['user'] = getUserSession();
        $payload['title'] = 'Risk Assessment';
        $payload['form'] = new CMSForm(['cms_form_id' => $cms_form_id]);
        //$payload['originator'] = new User($payload['form']->originator_id);
        //$payload['hod'] = new User($payload['form']->hod_id);
        //$payload['departments'] = (new DepartmentModel())->getAllDepartments();
        //$payload['affected_departments'] = getAffectedDepartments($cms_form_id);
        //$payload['cms_questions'] = getImpactQuestions();
        //$payload['action_log'] = getActionLog($cms_form_id);
        //$log = new CmsActionLogModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $form_model = prepPostData(SECTION_RISK_ASSESSMENT, $cms_form_id);
            $uploaded = uploadFile('risk_attachment', $cms_form_id, PATH_RISK_ATTACHMENT);
            if (!$uploaded['success']) {
                //flash('flash_view_change_process', $uploaded['reason'], 'text-danger text-center alert text-sm');
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
        $this->view('cms_forms/view_change_process', $payload);
    }

    /**
     * @param $cms_form_id
     * @param $department_id
     */
    public function ImpactResponse($cms_form_id, $department_id)
    {
        $payload = array();
        $payload['user'] = getUserSession();
        $payload['title'] = 'Risk Assessment';
        $payload['form'] = new CMSForm(['cms_form_id' => $cms_form_id]);
        $payload['originator'] = new User($payload['form']->originator_id);
        $department = new Department($department_id);
        $cms = new CMSFormModel(array('cms_form_id' => $cms_form_id));
        //$hods = getDepartmentHods($department_id);
        //$current_hod =
        $change_owner = new User($cms->hod_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $ret = false;
            foreach ($_POST as $key => $response) {
                $array_key_value = explode('_', $key);
                $cms_response_id = end($array_key_value);
                $ret = Database::getDbh()->where('cms_impact_response_id', $cms_response_id)
                    ->update('cms_impact_response', ['response' => $response]);
            }
            if ($ret) {
                // Notify hods of affected department
                //set approval status
                try {
                    $where = [
                        'cms_form_id' => $cms_form_id,
                        'department_id' => $department->department_id
                    ];
                    $data = [
                        'completed_by' => getUserSession()->user_id,
                        'completed_date' => (new DateTime())->format(DFB_DT),
                        'status' => STATUS_IMPACT_ASSESSMENT_HOD_COMMENT_PENDING
                    ];
                    ImpactAssStatusModel::updateImpactAssStatus($where, $data);
                } catch (Exception $e) {
                }

                // notify change owner
                if ($change_owner->user_id !== getUserSession()->user_id) {
                    (new EmailModel)->add([
                        'subject' => genEmailSubject($cms_form_id),
                        'recipient_address' => $change_owner->email,
                        //'sender_user_id' => getUserSession()->user_id,
                        'recipient_name' => ucwords($change_owner->first_name . ' ' . $change_owner->last_name),
                        'body' => 'Hi ' . ucwords($change_owner->first_name . ' ' . $change_owner->last_name) . ', ' . HTML_NEW_LINE .
                            'Impact Assessment for ' . $department->department .
                            ' has been completed by ' . ' ' . ucwords(getUserSession()->first_name . '  ' . getUserSession()->last_name, '-. ') . HTML_NEW_LINE .
                            'Use this link to view the details: ' . genLink($cms_form_id, 'view-change-process'),
                        'cms_form_id' => $cms_form_id
                    ]);
                }
                // notify hods
                /*foreach ($hods as $hod) {
                    (new EmailModel)->add([
                        'subject' => genEmailSubject($cms_form_id),
                        'recipient_address' => $hod->email,
                        'sender_user_id' => getUserSession()->user_id,
                        'recipient_name' => ucwords($hod->first_name . ' ' . $hod->last_name),
                        'body' => 'Hi ' . ucwords($hod->first_name . ' ' . $hod->last_name) . ', ' . HTML_NEW_LINE .
                            'Impact Assessment for ' . $department->department .
                            ' has been completed by ' . ' ' . ucwords(getUserSession()->first_name . '  ' . getUserSession()->last_name, '-. ') . HTML_NEW_LINE .
                            'Use this link to add your comment: ' . genLink($cms_form_id, 'risk-assessment'),
                        'cms_form_id' => $cms_form_id
                    ]);
                }*/
                actionLog($cms_form_id, ACTION_IMPACT_ASSESSMENT_RESPONSE_COMPLETED, getUserSession()->user_id, $department->department_id, SECTION_IMPACT_ASSESSMENT);

                // Do HoD Comment here
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
                    //$impact_ass_status->setStatus(STATUS_IMPACT_ASSESSMENT_COMPLETED);
                    // we can now notify GMCMSForm.phps then any of them would approve
                    notifyGms($cms_form_id);
                    completeSection($cms_form_id, SECTION_IMPACT_ASSESSMENT);
                }
                flash('flash_view_change_process', ' Impact Assessment ' . 'for ' . $department->department . ' Completed Successfully!', 'text-sm text-center text-success alert');
                // Notify originator & hod
                /* if ($payload['originator']->user_id !== getUserSession()->user_id) {
                      $department = new Department(getUserSession()->department_id);
                      (new EmailModel)->add([
                          'subject' => genEmailSubject($cms_form_id),
                          'recipient_address' => $hod->email,
                          'sender_user_id' => getUserSession()->user_id,
                          'recipient_name' => ucwords($payload['originator']->first_name . ' ' . $payload['originator']->last_name),
                          'body' => 'Hi ' . ucwords($payload['originator']->first_name . ' ' . $payload['originator']->last_name) . ', ' . HTML_NEW_LINE .
                              'Impact Assessment for ' . $department->department .
                              ' has been completed by ' . ' ' . ucwords(getUserSession()->first_name . '  ' . getUserSession()->last_name, '-. ') . ', from ' .
                              $department->department . ' Department.' . HTML_NEW_LINE .
                              'Use this link to view it: ' . genLink($cms_form_id, 'risk-assessment'),
                          'follow_up' => true,
                          'cms_form_id' => $cms_form_id
                      ]);
                  } */
            }
        }
        redirect('cms-forms/view-change-process/' . $cms_form_id);
    }

    public function GMAssessment(int $cms_form_id = -1)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        if (!isGM()) {
            redirect('cms-forms/view-change-process/' . $cms_form_id);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cms_form = new CMSForm(['cms_form_id' => $cms_form_id]);
            $originator = new User($cms_form->originator_id);
            $hod = new User($cms_form->hod_id);
            $gm = new User(getUserSession()->user_id);
            $link = URL_ROOT . "/cms-forms/view-change-process/$cms_form_id";
            $subject = genEmailSubject($cms_form_id);
            $_POST = filterPost();
            $cms_form->gm_approval = $_POST['gm_approval'];
            $cms_form->gm_approval_reasons = $_POST['gm_approval_reasons'];
            try {
                $cms_form->gm_approval_date = (new DateTime())->format(DFB_DT);
            } catch (Exception $e) {
            }
            $cms_form->gm_id = getUserSession()->user_id;
            $body = "Hi, " . ucwords($originator->first_name . ' ' . $originator->last_name, '-. ') . HTML_NEW_LINE .
                "Your Change Proposal has been <u>$cms_form->gm_approval</u> by GM, " . ucwords($gm->first_name . ' ' . $gm->last_name) . '.' . HTML_NEW_LINE .
                "Click this link for more details" . '<a href="' . $link . '" />' . $link . '</a>';
            insertEmail($subject, $body, $originator->email, concatNameWithUserId($originator->user_id));

            // Notify manager and superintendents of the department
            $body = "Hi, " . concatNameWithUserId($hod->user_id) . ", " . HTML_NEW_LINE .
                ucwords($gm->first_name . ' ' . $gm->last_name) . '(GM)' . " has " . $cms_form->gm_approval . " this Change Proposal." . HTML_NEW_LINE .
                "Click this link for more details: " . '<a href="' . $link . '" />' . $link . '</a>';

            notifyDepartmentManagers($cms_form_id, $originator->department_id, $body);

            if ($cms_form->gm_approval == STATUS_REJECTED) {
                $cms_form->state = STATUS_REJECTED;
            } /*elseif ($cms_form->gm_approval == STATUS_DELAYED) {
                $cms_form->state = STATUS_DELAYED;
            }*/
            // update CMS form
            $data = $cms_form->jsonSerialize();
            (new CMSFormModel(null))->updateForm($cms_form_id, $data);
            completeSection($cms_form_id, SECTION_GM_ASSESSMENT);
            //set action log
            (new CmsActionLogModel())->setAction(ACTION_GM_ASSESSMENT_COMPLETED)
                ->setPerformedBy(getUserSession()->user_id)
                ->setCmsFormId($cms_form_id)
                ->setSectionAffected(SECTION_GM_ASSESSMENT)
                ->insert();
            redirect('cms-forms/view-change-process/' . $cms_form_id);
        }
        redirect('cms-forms/view-change-process/' . $cms_form_id);
    }

    public function ApproveImpactResponse($cms_form_id)
    {
        $payload = array();
        $payload['user'] = getUserSession();
        $payload['title'] = 'Risk Assessment';
        $payload['form'] = new CMSForm(['cms_form_id' => $cms_form_id]);
        $payload['originator'] = new User($payload['form']->originator_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            // Notify hod
            $hod = new User(getHodId($cms_form_id));
            $department = new Department(getUserSession()->department_id);
            flash('flash_view_change_process', 'Impact Assessment for ' . $department->department . ' Approved!', 'text-sm text-center text-success alert');
            //set approval status
            if (ImpactAssStatusModel::has('cms_form_id', $cms_form_id, ['department' => $department->department_id])) {
                ImpactAssStatusModel::updateImpactAssStatus([
                    'cms_form_id' => $cms_form_id,
                    'department_id' => $department->department_id
                ], ['status' => STATUS_PENDING_APPROVAL]);
            } else {
                (new ImpactAssStatusModel)->setDepartmentId($department->department_id)
                    ->setStatus(STATUS_PENDING_APPROVAL)
                    ->setCmsFormId($cms_form_id)
                    ->insert();
            }
            (new EmailModel)->add([
                'subject' => genEmailSubject($cms_form_id),
                'recipient_address' => $hod->email,
                'sender_user_id' => getUserSession()->user_id,
                'recipient_name' => ucwords($hod->first_name . ' ' . $hod->last_name),
                'body' => 'Hi ' . ucwords($hod->first_name . ' ' . $hod->last_name) . ', ' . HTML_NEW_LINE .
                    'Impact Assessment for ' . $department->department .
                    ' has been updated by ' . ' ' . ucwords(getUserSession()->first_name . '  ' . getUserSession()->last_name, '-. ') . ', from ' .
                    $department->department . ' Department.' . HTML_NEW_LINE .
                    'Use this link to view the update: ' . genLink($cms_form_id, 'risk-assessment'),
                'follow_up' => true,
                'cms_form_id' => $cms_form_id
            ]);
            if (CmsActionLogModel::has('cms_form_id', $cms_form_id, [
                'action' => ACTION_IMPACT_ASSESSMENT_COMPLETED,
                'department_affected' => $department->department_id
            ])) {
                actionLog($cms_form_id, ACTION_IMPACT_ASSESSMENT_MODIFIED, getUserSession()->user_id, $department->department_id);
            } else {
                actionLog($cms_form_id, ACTION_IMPACT_ASSESSMENT_COMPLETED, getUserSession()->user_id, $department->department_id);
            }
            // Notify originator
            if ($payload['originator']->user_id !== getUserSession()->user_id) {
                $department = new Department(getUserSession()->department_id);
                (new EmailModel)->add([
                    'subject' => genEmailSubject($cms_form_id),
                    'recipient_address' => $hod->email,
                    'sender_user_id' => getUserSession()->user_id,
                    'recipient_name' => ucwords($payload['originator']->first_name . ' ' . $payload['originator']->last_name),
                    'body' => 'Hi ' . ucwords($payload['originator']->first_name . ' ' . $payload['originator']->last_name) . ', ' . HTML_NEW_LINE .
                        'Impact Assessment for ' . $department->department .
                        ' has been updated by ' . ' ' . ucwords(getUserSession()->first_name . '  ' . getUserSession()->last_name, '-. ') . ', from ' .
                        $department->department . ' Department.' . HTML_NEW_LINE .
                        'Use this link to view the update: ' . genLink($cms_form_id, 'risk-assessment'),
                    'follow_up' => true,
                    'cms_form_id' => $cms_form_id
                ]);
            }

        }
        redirect('cms-forms/risk-assessment/' . $cms_form_id);
    }

    public function HODAuthorisation(int $cms_form_id = -1)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        /*if (!isDepartmentManager(getUserSession()->user_id, getOriginatorDepartmentID($cms_form_id))) {
            redirect('cms-forms/view-change-process/' . $cms_form_id);
        }*/

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cms_form = new CMSForm(['cms_form_id' => $cms_form_id]);
            $originator = new User($cms_form->originator_id);
            $hod = new User(getUserSession()->user_id);
            $link = URL_ROOT . "/cms-forms/view-change-process/$cms_form_id";
            $subject = genEmailSubject($cms_form_id);
            $_POST = filterPost();
            $cms_form->hod_authorization = $_POST['hod_authorization'];
            $cms_form->hod_authorization_comment = $_POST['hod_authorization_comment'];
            $cms_form->project_leader_id = $_POST['project_leader_id'];
            $project_leader = new User($cms_form->project_leader_id);
            try {
                $cms_form->hod_authorization_date = (new DateTime())->format(DFB_DT);
            } catch (Exception $e) {
            }
            $template_data = array(
                'project_owner' => concatNameWithUserId($hod->user_id),
                'project_leader' => concatNameWithUserId($project_leader->user_id),
                'subject' => genEmailSubject($cms_form_id),
                'link' => $link
            );
            /*$body = "Hi, " . concatNameWithUserId($originator->user_id) . HTML_NEW_LINE .
                getNameJobTitleAndDepartment($hod->user_id) . " has selected " .
                ($project_leader->user_id === $originator->user_id ? "you " : getNameJobTitleAndDepartment($project_leader->user_id)) .
                " as Project Leader for this Change Proposal." . HTML_NEW_LINE .
                "Click this link for more details: " . '<a href="' . $link . '" />' . $link . '</a>';*/
            if ($originator->user_id !== getUserSession()->user_id) {
                $body = get_include_contents('email_templates/pl_selected', $template_data);
                insertEmail($subject, $body, $project_leader->email, concatNameWithUserId($project_leader->user_id));
            }
            //insertEmail($subject, $body, $originator->email, concatNameWithUserId($originator->user_id));
            flash($flash = "flash_" . the_method(), "Success!", 'text-sm text-center text-success alert');
            $data = $cms_form->jsonSerialize();
            (new CMSFormModel(null))->updateForm($cms_form_id, $data);
            // complete section
            completeSection($cms_form_id, SECTION_HOD_AUTHORISATION);
            //set action log
            (new CmsActionLogModel())->setAction(ACTION_HOD_AUTHORISATION_COMPLETED)
                ->setPerformedBy(getUserSession()->user_id)
                ->setCmsFormId($cms_form_id)
                ->setSectionAffected(SECTION_HOD_AUTHORISATION)
                ->insert();
            redirect('cms-forms/view-change-process/' . $cms_form_id);
        }
        redirect('cms-forms/view-change-process/' . $cms_form_id);
    }

    public function ProjectLeaderAcceptance(int $cms_form_id = -1)
    {
        if (!isProjectLeader(getUserSession()->user_id, $cms_form_id)) {
            redirect('cms-forms/view-change-process/' . $cms_form_id);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cms_form = new CMSForm(['cms_form_id' => $cms_form_id]);
            $_POST = filterPost();
            $cms_form->setProjectLeaderAcceptance(STATUS_ACCEPTED);
            $cms_form->setProjectLeaderAcceptanceComment($_POST['project_leader_acceptance_comment']);
            $cms_form->setProjectLeaderAcceptanceDate(now());
            $data = $cms_form->jsonSerialize();
            $cms_form_model = new CMSFormModel(['cms_form_id' => $cms_form_id]);
            $ret = ($cms_form_model)->updateForm($cms_form_id, $data);
            if ($ret) {
                flash_success();
                completeSection($cms_form_id, SECTION_PL_ACCEPTANCE);
                (new CmsActionLogModel())->setAction(ACTION_PROJECT_LEADER_ACCEPTANCE_COMPLETED)
                    ->setPerformedBy(getUserSession()->user_id)
                    ->setCmsFormId($cms_form_id)
                    ->setSectionAffected(SECTION_HOD_AUTHORISATION)
                    ->insert();
            } else {
                flash_error();
            }
        }
        redirect('cms-forms/view-change-process/' . $cms_form_id);
    }

    public function ActionList(int $cms_form_id = -1)
    {


    }

    public function ProjectLeaderClosure(int $cms_form_id = -1)
    {
        $cms_form = new CMSFormModel(['cms_form_id' => $cms_form_id]);
        $cms_form->updateForm($cms_form_id, [
            'project_leader_close_change' => now()
        ]);
        completeSection($cms_form_id, SECTION_ACTION_LIST);
        redirect("cms-forms/view-change-process/$cms_form_id");
    }

    public function OriginatorClosure(int $cms_form_id = -1)
    {
        $cms_form = new CMSFormModel(['cms_form_id' => $cms_form_id]);
        $cms_form->updateForm($cms_form_id, ['originator_close_change' => now()]);
        redirect("cms-forms/view-change-process/$cms_form_id");
    }

    public function HODClosure(int $cms_form_id = -1)
    {
        $cms_form = new CMSFormModel(['cms_form_id' => $cms_form_id]);
        $cms_form->updateForm($cms_form_id, [
            'hod_close_change' => now(),
            'state' => STATUS_CLOSED
        ]);
        completeSection($cms_form_id, SECTION_PROCESS_CLOSURE);
        redirect("cms-forms/view-change-process/$cms_form_id");
    }

    public function ProcessClosed(int $cms_form_id = -1)
    {
    }

    public function ViewChangeProcess(int $cms_form_id = -1)
    {
        $payload = array();
        if (!CMSFormModel::has('cms_form_id', $cms_form_id)) {
            redirect('errors/index/404');
        }
        if (!isLoggedIn()) {
            redirect("users/login/$cms_form_id");
        }
        $payload['title'] = 'Change Proposal, Assessment & Implementation';
        $payload['form'] = new CMSForm(['cms_form_id' => $cms_form_id]);
        $payload['active'] = CMSFormModel::getActive();
        $payload['closed'] = CMSFormModel::getClosed();
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

    public function downloadFile()
    {
    }

    public function HODComment($cms_form_id, $department_id)
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
                //$impact_ass_status->setStatus(STATUS_IMPACT_ASSESSMENT_COMPLETED);
                // we can now notify GMCMSForm.phps then any of them would approve
                notifyGms($cms_form_id);
                completeSection($cms_form_id, SECTION_IMPACT_ASSESSMENT);
            }
        }
        redirect('cms-forms/view-change-process/' . $cms_form_id);
    }

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
                (new CmsActionLogModel())->setAction(ACTION_CHANGED_GM)
                    ->setPerformedBy(getUserSession()->user_id)
                    ->setRemarks($remarks)
                    ->insert();
                flash($flash, 'GM changed successfully!', 'text-center text-success alert text-sm');
            } else {
                flash($flash, 'An error occurred!', 'text-center text-danger alert text-sm');
            }
        }
        goBack();
        /* if (empty($_POST['cms_form_id'])) {
             redirect('cms-forms/dashboard/');
         } else {
             redirect('cms-forms/view-change-process/' . $_POST['cms_form_id']);
         }*/
    }

    public function changeManager($department_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $flash = "flash_" . the_method();
            $db = Database::getDbh();
            $dept_mgr = getDepartmentHod($department_id);
            $current_mgr = new User($_POST['mgr']);
            $mgr_name = concatNameWithUserId($current_mgr->user_id);
            $department = new Department($department_id);
            $current_user = getUserSession();
            $user_name = concatNameWithUserId($current_user->user_id);
            $ret = $db->where('department_id', $department_id)
                ->update('departments', array('current_manager' => $current_mgr->user_id));
            if ($ret) {
                $data = array(
                    'user_name' => $user_name,
                    'department' => $department->department,
                    'mgr_name' => $mgr_name,
                );
                $remarks = get_include_contents('action_remarks_templates/change_manager', $data);
                // set action log
                insertLog(0, ACTION_CHANGED_MANAGER, $remarks, $current_user->user_id);
                if ($current_mgr->user_id !== $current_user->user_id) {
                    $body = get_include_contents('email_templates/change_manager', $data);
                    insertEmail(SUBJECT_MANAGER_CHANGED . " for " . $department->department, $body, $current_mgr->email, $mgr_name);
                }

                if (!empty($dept_mgr) && ($current_mgr->user_id !== $dept_mgr[0]->user_id)) {
                    $user_name = echoYou($current_user->user_id);
                    $body = "$user_name changed the Manager for " . $department->department . " to $mgr_name.";
                    insertEmail(SUBJECT_MANAGER_CHANGED . " for " . $department->department, $body, $dept_mgr[0]->email, concatNameWithUserId($dept_mgr[0]->user_id));
                }

                /*
                $hods = getHodsWithCurrent($department_id);
                foreach ($hods as $hod) {
                    $data = array(
                        'user_id' => $user->user_id,
                        'user_name' => $user_name,
                        'department' => $department->department,
                        'mgr_name' => $mgr_name
                    );
                    $body = get_include_contents('email_templates/change_manager', $data);
                    $recipient_name = concatNameWithUserId($hod->user_id);
                    insertEmail(SUBJECT_MANAGER_CHANGED . " for " . $department->department, $body, $hod->email, $recipient_name);
                }*/
                flash($flash, 'Manager changed successfully!', 'text-center text-success alert text-sm');
            } else {
                flash($flash, 'An error occurred!', 'text-center text-danger alert text-sm');
            }
        }
        goBack();
        /*if (empty($_POST['cms_form_id'])) {
            redirect('cms-forms/dashboard/');
        } else {
            redirect('cms-forms/view-change-process/' . $_POST['cms_form_id']);
        }*/
    }

    public function departmentManagers()
    {
        $payload = array();
        $payload['title'] = 'Department Managers';
        $user = getUserSession();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $mgrs = $_POST['mgrs'];
            $db = Database::getDbh();
            foreach ($mgrs as $mgr) {
                if (!empty($mgr)) {
                    $dept_id = getDepartmentID($mgr);
                    $department = new Department($dept_id);
                    $remarks = "" . concatNameWithUserId($user->user_id) . " has changed the manager for "
                        . $department->department . " to " . concatNameWithUserId($mgr);
                    $db->where('department_id', $dept_id)
                        ->update('departments', array('current_manager' => $mgr));
                    (new CmsActionLogModel())->setAction(ACTION_CHANGED_MANAGER)
                        ->setPerformedBy($user->user_id)
                        ->setRemarks($remarks)
                        ->insert();
                }
            }
            flash_success();
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
}

?>