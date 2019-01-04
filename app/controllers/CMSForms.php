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
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->db = Database::getDbh();
        $this->userModel = new UserModel(getUserSession()->user_id);
    }

    public function index()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        redirect('cms-forms/dashboard');
    }

    public function dashboard()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $payload['title'] = 'CMS Dashboard';
        $payload['active'] = CMSFormModel::getActive();
        $payload['closed'] = CMSFormModel::getClosed();
        $this->view('cms_forms/dashboard', $payload);
    }

    public function StartChangeProcess()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $payload = array();
        $payload['title'] = 'New Change Proposal Form';
        $payload['hod'] = Database::getDbh()->
            objectBuilder()->
            where('role', 'Manager')->
            orWhere('role', 'Superintendent')->
            get('users', null, '*');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $form = new CMSForm();
            $form->change_description = $_POST['change_description'];
            $form->advantages = $_POST['advantages'];
            $form->alternatives = $_POST['alternatives'];
            $form->area_affected = $_POST['area_affected'];
            $form->change_type = concatWith(', ', ' & ', $_POST['change_type']);
            $form->originator_id = getUserSession()->user_id;
            if (isset($_POST['other_type'])) {
                $form->other_type = $_POST['other_type'];
            }
            if (isset($_POST['certify_details'])) {
                $form->certify_details = $_POST['certify_details'];
            }
            // upload additional info
            $form->hod_id = $_POST['hod_id'];
            $form->next_action = ACTION_HOD_ASSESSMENT;
            $form->section_completed = ACTION_START_CHANGE_PROCESS;
            $form = removeEmptyVal($form->jsonSerialize());
            $form_model = new CMSFormModel();
            if ($cms_form_id = $form_model->add($form)) {
                $result = uploadAdditionalInfo('additional_info', $cms_form_id);
                if ($result['success']) {
                    $form_model->updateForm($cms_form_id, ['additional_info' => $result['file']]);
                }
                flash('flash_dashboard', 'Your change process application has been submitted successfully.
                            Your manager has been notified for approval.',
                            'text-success text-sm text-center alert');
                $originator = getUserSession()->first_name.' '.getUserSession()->last_name;
                $recipient = new User($_POST['hod_id']);
                $link = URL_ROOT.'/cms-forms/hod-assessment/'.$cms_form_id;
                //$subject = 'Change Proposal, Assessment and Implementation';
                $body = 'Hi '. ucwords($recipient->first_name . ' '. $recipient->last_name, '-. '). ', '.HTML_NEW_LINE.'A Change Proposal application has been raised by '.$originator. '.'.
                    ' Kindly use the link below to approve it.' . HTML_NEW_LINE . genLink($cms_form_id, 'hod-assessment');

                $email_model = new EmailModel();
                // email to the hod
                $email_model->add([
                    'subject' => genEmailSubject($cms_form_id),
                    'body' => $body,
                    'recipient_address' => $recipient->email,
                    'recipient_name' => $recipient->first_name . ' '. $recipient->last_name,
                    'sender_user_id' => getUserSession()->user_id,
                    'parent' => true,
                    'cms_form_id' => $cms_form_id
                ]);
                // email to the originator
                $email_model->add([
                    'subject' => genEmailSubject($cms_form_id),
                    'body' => "Hi, $originator, the Change Process Application you raised has been submitted to your 
                    HOD for review. You will be notified accordingly.",
                    'recipient_address' => getUserSession()->email,
                    'recipient_name' => $originator,
                    'sender_user_id' => getUserSession()->user_id,
                    'parent' => true,
                    'cms_form_id' => $cms_form_id
                ]);
                redirect('cms-forms/dashboard/');
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
        $payload['title'] = 'Further Assessment by HOD';
        $payload['form'] = new CMSForm($cms_form_id);
        $payload['originator'] = new User($payload['form']->originator_id);
        $payload['hod'] = new User($payload['form']->hod_id);
        $payload['gms'] = getGms();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (getUserSession()->user_id !== $payload['form']->hod_id) {
                flash('flash_index', 'You are not the HOD assigned to approve this form.', 'text-danger text-center alert', '');
                redirect('notices/index');
                exit();
            }
            $_POST = filterPost();
            $form = new CMSForm($cms_form_id);
            $form->hod_approval = $_POST['hod_approval'];
            $form->hod_reasons = $_POST['hod_reasons'];
            $form->hod_ref_num = $_POST['hod_ref_num'];
            $form->hod_approval_date = (new DateTime())->format(DFB_DT);
            if (isset($_POST['gm_id'])) {
                $form->gm_id = $_POST['gm_id'];
            }

            $form->section_completed = ACTION_HOD_ASSESSMENT;
            $form->next_action = ACTION_RISK_ASSESSMENT;
            $form = $form->jsonSerialize();
            if ((new CMSFormModel())->updateForm($cms_form_id, $form)) {
                if ($form['hod_approval'] == 'approved') {
                    notifyOHSForMonitoring($cms_form_id);
                }
                if (isset($_POST['gm_id']))
                {
                    notifyGm($cms_form_id);
                }
                $originator = $payload['originator'];
                $hod = $payload['hod'];
                $link = URL_ROOT. "/cms-forms/risk-assessment/$cms_form_id";
                $subject = genEmailSubject($cms_form_id);
                $body = "Hi, ". ucwords($originator->first_name. ' '. $originator->last_name, '-. '). HTML_NEW_LINE.
                    "Your Change Process Applicaton has been reviewed by " . ucwords($hod->first_name . ' ' . $hod->last_name) . '.' . HTML_NEW_LINE .
                    "Use the link below to continue the process." . HTML_NEW_LINE . '<a href="' .
                    $link . '" />' . $link . '</a>';
                $email_model = new EmailModel();
                // email to originator
                $email_model->add([
                    'subject' => $subject,
                     'body' =>$body,
                    'recipient_address' => $originator->email,
                     'recipient_name' => ucwords($originator->first_name. ' '. $originator->last_name, '-. '),
                    'sender_user_id' => getUserSession()->user_id,
                    'follow_up' => true,
                    'cms_form_id' => $cms_form_id
                ]);
                flash('flash_dashboard', 'Change Process updated successfully!', 'alert text-sm text-success text-center');
                redirect('cms-forms/dashboard');
            }
        }
        $this->view('cms_forms/hod_assessment', $payload);
    }

    public function RiskAssessment(int $cms_form_id = -1)
    {
        $payload = array();
        $payload['user'] = getUserSession();
        $payload['title'] = 'Risk Assessment';
        $payload['form'] = new CMSForm($cms_form_id);
        $payload['originator'] = new User($payload['form']->originator_id);
        $payload['hod'] = new User($payload['form']->hod_id);
        $payload['departments'] = (new DepartmentModel())->getAllDepartments();
        $payload['affected_departments'] = getAffectedDepartments($cms_form_id);
        $payload['cms_questions'] = getImpactQuestions();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $payload['form']->affected_dept = implode(',', $_POST['affected_dept']);
            // populate impact questions

            $form_model = new CMSFormModel();
            $uploaded = uploadRiskAttachment('risk_attachment', $cms_form_id);
            if (!$uploaded['success']) {
                flash('flash_risk_assessment', $uploaded['reason'], 'text-danger text-center alert');
                redirect('cms-forms/risk-assessment/' . $cms_form_id);
            }
            if ($form_model->updateForm($cms_form_id, [
                'affected_dept' => $payload['form']->affected_dept,
                'risk_attachment' => $uploaded['success'] ? $uploaded['file'] : ''
                ])) {
                // Notify hod
                (new EmailModel)->add([
                    'subject' => genEmailSubject($cms_form_id),
                    'recipient_address' => $payload['hod']->email,
                    'sender_user_id' => getUserSession()->user_id,
                    'recipient_name' => ucwords($payload['hod']->first_name . ' ' . $payload['hod']->last_name),
                    'body' => 'Hi ' . ucwords($payload['hod']->first_name . ' ' . $payload['hod']->last_name) . ', ' . HTML_NEW_LINE .
                        'Risk Assessment for this Change Process' .
                        ' has been performed by' . ' ' . ucwords($payload['originator']->first_name . '  ' . $payload['originator']->last_name, '-. ') . '. ' . HTML_NEW_LINE .
                        'Use this link to view it: ' . genLink($cms_form_id, 'view-change-process'),
                    'follow_up' => true,
                    'cms_form_id' => $cms_form_id
                ]);
                // Notify impact assessment reps
                //notifyImpactAccessReps($cms_form_id);
                populateImpactResponse(explode(',', $payload['form']->affected_dept), $cms_form_id);
            } else {
                flash('flash_risk_assessment', 'An error occurred!', 'text-danger text-center alert');
            }
            redirect('cms-forms/risk-assessment/'.$cms_form_id);
        }
        $this->view('cms_forms/risk_assessment', $payload);
    }

    public function ImpactResponse($cms_form_id)
    {
        $payload = array();
        $payload['user'] = getUserSession();
        $payload['title'] = 'Risk Assessment';
        $payload['form'] = new CMSForm($cms_form_id);
        $payload['originator'] = new User($payload['form']->originator_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filterPost();
            $ret = false;
            foreach ($_POST as $key => $response) {
                @ $cms_response_id = end(explode('_', $key));
                $ret = Database::getDbh()->where('cms_impact_response_id', $cms_response_id)->
                update('cms_impact_response', ['response' => $response]);
            }
            if ($ret) {
                flash('flash_risk_assessment', 'Impact Assessment Updated Successfully!', 'text-sm text-center text-success alert');
                // Notify hod
                $hod = new User(getHodId($cms_form_id));
                $department = new Department(getUserSession()->department_id);
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
        }
        redirect('cms-forms/risk-assessment/' . $cms_form_id);
    }

    public function GMAssessment(int $cms_form_id = -1)
    {
        $payload = array();
        $payload['user'] = getUserSession();
        $payload['title'] = 'GM Assessment';
        $this->view('cms_forms/gm_assessment', $payload);
    }

    public function HODAuthorisation(int $cms_form_id = -1)
    {
        $payload = array();
        $payload['user'] = getUserSession();
        $payload['title'] = 'Authorisation by HOD to Implement Change';
        $this->view('cms_forms/hod_authorisation', $payload);
    }

    public function PLAcceptance(int $cms_form_id = -1)
    {
        $payload = array();
        $payload['user'] = getUserSession();
        $payload['title'] = 'Project Leader Acceptance';
        $this->view('cms_forms/pl_acceptance', $payload);
    }

    public function ActionList(int $cms_form_id = -1)
    {
        $payload = array();
        $payload['user'] = getUserSession();
        $payload['title'] = 'Action List';
        $this->view('cms_forms/action_list', $payload);
    }

    public function PLClosure(int $cms_form_id = -1)
    {
        $payload = array();
        $payload['user'] = getUserSession();
        $payload['title'] = 'Process Closure by Project Leader';
        $this->view('cms_forms/pl_closure', $payload);
    }

    public function OriginatorClosure(int $cms_form_id = -1)
    {
        $payload = array();
        $payload['user'] = getUserSession();
        $payload['title'] = 'Process Closure by Originator';
        $this->view('cms_forms/orig_closure', $payload);
    }

    public function HODClosure(int $cms_form_id = -1)
    {
        $payload = array();
        $payload['user'] = getUserSession();
        $payload['title'] = 'Process Closure by HOD';
        $this->view('cms_forms/hod_closure', $payload);
    }

    public function ProcessClosed(int $cms_form_id = -1)
    {
        $payload = array();
        $payload['user'] = getUserSession();
        $payload['title'] = 'Process Closed';
        flash('process_closed','This Change Process is complete and has been closed!', 'text-danger text-center',
                            '&nbsp');
        $this->view('cms_forms/process_closed', $payload);
    }

    public function ViewChangeProcess(int $cms_form_id = -1)
    {
        $payload = array();
        $payload['title'] = 'Change Proposal, Assessment & Implementation';
        $payload['form'] = new CMSForm($cms_form_id);
        $payload['originator'] = new User($payload['form']->originator_id);
        redirect('cms-forms/'.$payload['form']->next_action.'/'.$cms_form_id);
    }

    public function StopChangeProcess()
    {
        //$payload = array();
    }

    public function test()
    {
        try {
            echo (new DateTime())->format(DFB);
        } catch (Exception $e) {
        }
    }
}
