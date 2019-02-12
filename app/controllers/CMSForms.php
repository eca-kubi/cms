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
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->db = Database::getDbh();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
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
        $department_id = getUserSession()->department_id;
        $user_id = getUserSession()->user_id;
        $payload['title'] = 'New Change Proposal Form';
        $payload['ref_num'] = getDeptRef($department_id);
        $payload['hod'] = Database::getDbh()
            ->objectBuilder()
            ->where('role', 'Manager')
            ->where('department_id', $department_id)
            ->orWhere('role', 'Superintendent')
            ->get('users', null, '*');
        $payload['reference'] = getDeptRef($department_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $form = new CMSFormModel();
            $form->change_description = $_POST['change_description'];
            $form->advantages = $_POST['advantages'];
            $form->alternatives = $_POST['alternatives'];
            $form->area_affected = $_POST['area_affected'];
            $form->change_type = concatWith(', ', ' & ', $_POST['change_type']);
            $form->originator_id = $user_id;
            $form->certify_details = $_POST['certify_details'];
            $form->setState(STATUS_ACTIVE);
            $form->setHodRefNum(getDeptRef($department_id));
            $form->setDepartmentId($department_id);
            //$form->risk_level = $_POST['risk_level'];
            //$form->budget_level = $_POST['budget_level'];
            if (isset($_POST['other_type'])) {
                $form->other_type = $_POST['other_type'];
            }

            // upload additional info
            $form->hod_id = $_POST['hod_id'];
            //$form->next_action = ACTION_HOD_ASSESSMENT;
            $cms_form_id = $form->insert();
            if ($cms_form_id) {
                /*$result = uploadAdditionalInfo('additional_info', $cms_form_id);
                if ($result['success']) {
                    $form_model->updateForm($cms_form_id, ['additional_info' => $result['file']]);
                }*/
                flash('flash_view_change_process', 'Your Change Proposal has been submitted successfully.
                            Your manager has been notified for approval.',
                    'text-success text-sm text-center alert');
                $originator_name = concatNameWithUserId(getUserSession()->user_id);
                $hod = new User($_POST['hod_id']);
                //$subject = 'Change Proposal, Assessment and Implementation';
                $body = 'Hi ' . ucwords($hod->first_name . ' ' . $hod->last_name, '-. ') . ', ' . HTML_NEW_LINE . 'A Change Proposal application has been raised by ' .
                    getNameJobTitleAndDepartment(getOriginatorId($cms_form_id)) . '.' .
                    ' Kindly use the link below to approve it.' . HTML_NEW_LINE . genLink($cms_form_id, 'view-change-process');
                insertEmail(genEmailSubject($cms_form_id), $body, $hod->email, $hod->first_name . ' ' . $hod->last_name);

                $body = 'Hi ' . $originator_name . ', ' . HTML_NEW_LINE .
                    'Your Change Proposal has been submitted to your manager for approval. ' .
                    ' Kindly use the link below to monitor progress.' . HTML_NEW_LINE .
                    genLink($cms_form_id, 'view-change-process');
                insertEmail(genEmailSubject($cms_form_id), $body, getUserSession()->email, $originator_name);

                //set action log
                (new CmsActionLogModel())->setAction(ACTION_START_CHANGE_PROCESS_COMPLETED)
                    ->setPerformedBy(getUserSession()->user_id)
                    ->setCmsFormId($cms_form_id)
                    ->setSectionAffected(SECTION_START_CHANGE_PROCESS)
                    ->insert();
                completeSection($cms_form_id, SECTION_START_CHANGE_PROCESS);
                redirect('cms-forms/view-change-process/' . $cms_form_id);
            }
        }
        $this->view('cms_forms/start_change_process', $payload);
    }

    public function HODAssessment(int $cms_form_id = -1)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $payload = array();
        $payload['title'] = "HOD's Approval ";
        $payload['form'] = $form = new CMSForm(['cms_form_id' => $cms_form_id]);
        $payload['originator'] = $originator = new User($payload['form']->originator_id);
        $payload['hod'] = $hod = new User($payload['form']->hod_id);
        $payload['gms'] = getGms();
        $payload['action_log'] = getActionLog($cms_form_id);
        $link = URL_ROOT . "/cms-forms/view-change-process/$cms_form_id";
        $subject = genEmailSubject($cms_form_id);
        $_POST = filterPost();
        $form->next_action = ACTION_RISK_ASSESSMENT;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (getUserSession()->user_id !== $payload['form']->hod_id) {
                flash('flash_index', 'You are not the HoD assigned to approve this form.', 'text-danger text-center alert', '');
                redirect('notices/index');
                exit();
            }
            $form->hod_approval = $_POST['hod_approval'];
            $form->hod_reasons = $_POST['hod_reasons'];
            //$form->hod_ref_num = $_POST['hod_ref_num'];
            try {
                $form->hod_approval_date = (new DateTime())->format(DFB_DT);
            } catch (Exception $e) {
            }
            if (!empty($_POST['gm_id'])) {
                $form->gm_id = $_POST['gm_id'];
            }
            if ($form->hod_approval == STATUS_REJECTED) {
                $body = "Hi, " . ucwords($originator->first_name . ' ' . $originator->last_name, '-. ') . HTML_NEW_LINE .
                    "Your Change Proposal has been <u>rejected</u> by your HoD, " . ucwords($hod->first_name . ' ' . $hod->last_name) . '.' . HTML_NEW_LINE .
                    "Click this link for more details" . '<a href="' . $link . '" />' . $link . '</a>';
                insertEmail($subject, $body, $originator->email, concatNameWithUserId($originator->user_id));
                $form->state = STATUS_REJECTED;
            } elseif ($form->hod_approval == STATUS_APPROVED) {
                $body = "Hi, " . ucwords($originator->first_name . ' ' . $originator->last_name, '-. ') . HTML_NEW_LINE .
                    "Your Change Proposal has been <u>approved</u> by your HoD, " . ucwords($hod->first_name . ' ' . $hod->last_name) . '.' . HTML_NEW_LINE .
                    "Click this link to start Risk Assessment " . '<a href="' . $link . '" />' . $link . '</a>';
                insertEmail($subject, $body, $originator->email, concatNameWithUserId($originator->user_id));
                notifyOHSForMonitoring($cms_form_id);
                /** if (!empty($_POST['gm_id'])) {
                 * notifyGm($cms_form_id, $form);
                 * } */
            } /*else {
                $body = "Hi, " . ucwords($originator->first_name . ' ' . $originator->last_name, '-. ') . HTML_NEW_LINE .
                    "Your Change Proposal has been <u>delayed</u> by your HoD, " . ucwords($hod->first_name . ' ' . $hod->last_name) . '.' . HTML_NEW_LINE .
                    "Click this link for more details " . '<a href="' . $link . '" />' . $link . '</a>';
                $form->state = STATUS_DELAYED;
                insertEmail($subject, $body, $originator->email, concatNameWithUserId($originator->user_id));
            }*/
            $data = $form->jsonSerialize();
            (new CMSFormModel(null))->updateForm($cms_form_id, $data);

            completeSection($cms_form_id, SECTION_HOD_ASSESSMENT);
            //set action log
            (new CmsActionLogModel())->setAction(ACTION_HOD_ASSESSMENT_COMPLETED)
                ->setPerformedBy(getUserSession()->user_id)
                ->setCmsFormId($cms_form_id)
                ->setSectionAffected(SECTION_HOD_ASSESSMENT)
                ->insert();
            redirect('cms-forms/view-change-process/' . $cms_form_id);
        }
        $this->view('cms_forms/view_change_process', $payload);
    }

    public function RiskAssessment(int $cms_form_id = -1)
    {
        $payload = array();
        $payload['user'] = getUserSession();
        $payload['title'] = 'Risk Assessment';
        $payload['form'] = new CMSForm(['cms_form_id' => $cms_form_id]);
        $payload['originator'] = new User($payload['form']->originator_id);
        $payload['hod'] = new User($payload['form']->hod_id);
        $payload['departments'] = (new DepartmentModel())->getAllDepartments();
        $payload['affected_departments'] = getAffectedDepartments($cms_form_id);
        $payload['cms_questions'] = getImpactQuestions();
        $payload['action_log'] = getActionLog($cms_form_id);
        $log = new CmsActionLogModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $payload['form']->affected_dept = implode(',', $_POST['affected_dept']);
            // populate impact questions

            $form_model = new CMSFormModel(null);
            $uploaded = uploadRiskAttachment('risk_attachment', $cms_form_id);
            if (!$uploaded['success']) {
                flash('flash_view_change_process', $uploaded['reason'], 'text-danger text-center alert text-sm');
                redirect('cms-forms/view-change-process/' . $cms_form_id);
            }
            $form_model->updateForm($cms_form_id, [
                'affected_dept' => $payload['form']->affected_dept,
                'risk_attachment' => $uploaded['success'] ? $uploaded['file'] : ''
            ]);
            $log->setSectionAffected(SECTION_RISK_ASSESSMENT)
                ->setAction(ACTION_RISK_ASSESSMENT_COMPLETED)
                ->setPerformedBy(getUserSession()->user_id)
                ->setCmsFormId($cms_form_id)
                ->setDepartmentAffected($payload['form']->affected_dept)
                ->insert();
            completeSection($cms_form_id, SECTION_RISK_ASSESSMENT);
            // Notify impact assessment reps
            notifyImpactAccessReps($cms_form_id);
            populateImpactResponse(explode(',', $payload['form']->affected_dept), $cms_form_id);
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
        $hods = getDepartmentHods($department_id);
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

                // notify hods
                foreach ($hods as $hod) {
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
                }
                actionLog($cms_form_id, ACTION_IMPACT_ASSESSMENT_RESPONSE_COMPLETED, getUserSession()->user_id, $department->department_id, SECTION_IMPACT_ASSESSMENT);
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
            } elseif ($cms_form->gm_approval == STATUS_DELAYED) {
                $cms_form->state = STATUS_DELAYED;
            }
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
        if (!isDepartmentManager(getUserSession()->user_id, getOriginatorDepartmentID($cms_form_id))) {
            redirect('cms-forms/view-change-process/' . $cms_form_id);
        }

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
            $body = "Hi, " . concatNameWithUserId($originator->user_id) . HTML_NEW_LINE .
                getNameJobTitleAndDepartment($hod->user_id) . " has selected " .
                ($project_leader->user_id === $originator->user_id ? "you " : getNameJobTitleAndDepartment($project_leader->user_id)) .
                " as Project Leader for this Change Proposal." . HTML_NEW_LINE .
                "Click this link for more details: " . '<a href="' . $link . '" />' . $link . '</a>';
            insertEmail($subject, $body, $originator->email, concatNameWithUserId($originator->user_id));

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
            (new CMSFormModel(null))->updateForm($cms_form_id, $data);
            completeSection($cms_form_id, SECTION_PL_ACCEPTANCE);
            (new CmsActionLogModel())->setAction(ACTION_PROJECT_LEADER_ACCEPTANCE_COMPLETED)
                ->setPerformedBy(getUserSession()->user_id)
                ->setCmsFormId($cms_form_id)
                ->setSectionAffected(SECTION_HOD_AUTHORISATION)
                ->insert();
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
            ->where('role', 'Manager', '<>')
            ->where('role', 'Superintendent', '<>')
            ->objectBuilder()
            ->get('users');
        $this->view('cms_forms/view_change_process', $payload);
        //redirect('cms-forms/' . $payload['form']->next_action . '/' . $cms_form_id);
    }

    public function StopChangeProcess($cms_form_id)
    {
        $db = Database::getDbh();
        $db->where('cms_form_id', $cms_form_id)
            ->update('cms_form', array(
                'state' => STATUS_REJECTED
            ));
        if (isset($_GET['redirect'])) {
            header('location: ' . $_GET['redirect']);
            exit;
        } else {
            redirect('cms-forms/view-change-process');
        }
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
        $file_name = (new CMSForm(['cms_form_id' => $cms_form_id]))->getAdditionalInfo();
        download_file(PATH_ADDITIONAL_INFO . $file_name);
    }

    public function DownloadRiskAttachment($cms_form_id)
    {
        $file_name = (new CMSForm(['cms_form_id' => $cms_form_id]))->getRiskAttachment();
        download_file(PATH_RISK_ATTACHMENT . $file_name);
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

}
