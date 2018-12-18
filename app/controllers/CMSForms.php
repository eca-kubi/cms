<?php
class CMSForms extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn())
        {
        	redirect('users/login');
        }
        $this->db = Database::getDbh();
        $this->userModel = new UserModel(getUserSession()->user_id);
    }

    public function index()
    {
        if (!isLoggedIn())
        {
        	redirect('users/login');
        }
        redirect('cms-forms/dashboard');
    }

    function dashboard()
    {
        if (!isLoggedIn())
        {
        	redirect('users/login');
        }
        $payload['title'] = 'CMS Dashboard';
        $payload['active'] = CMSFormModel::getActive();
        $payload['closed'] = CMSFormModel::getClosed();
        $this->view('cms_forms/dashboard', $payload);
    }


    public function StartChangeProcess()
    {
        if (!isLoggedIn())
        {
            redirect('users/login');
        }
        $payload = array();
        $payload['title'] = 'New Change Proposal Form';
        $payload['hod'] = Database::getDbh()->
            objectBuilder()->
            where('role', 'Manager')->
            orWhere('role', 'Superintendent')->
            get('users', null, '*');
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
        	$_POST = filterPost();
            $form  = new CMSForm();
            $form->change_description = $_POST['change_description'];
            $form->advantages = $_POST['advantages'];
            $form->alternatives = $_POST['alternatives'];
            $form->area_affected = $_POST['area_affected'];
            $form->change_type = concatWith(', ', ' & ', $_POST['change_type']);
            $form->originator_id = getUserSession()->user_id;
            if (isset($_POST['other_type']))
            {
            	$form->other_type = $_POST['other_type'];
            }
            if (isset($_POST['certify_details']))
            {
            	$form->certify_details = $_POST['certify_details'];
            }
            $form->hod_id = $_POST['hod_id'];
            $form->next_action = ACTION_HOD_ASSESSMENT;
            $form->section_completed = ACTION_START_CHANGE_PROCESS;
            $form = removeEmptyVal($form->jsonSerialize());
            $form_model = new CMSFormModel();
            if ($cms_form_id = $form_model->add($form))
            {
            	flash('flash_dashboard', 'Your change process application has been submitted successfully.
                            Your manager has been notified for approval.',
                            'text-success text-sm text-center alert');
                $originator = getUserSession()->first_name . ' '. getUserSession()->last_name;
                $link = URL_ROOT . '/cms/cms-forms/hod-assessment/'. $cms_form_id;
                $subject = 'Change Proposal, Assessment and Implementation';
                $body = 'Hi, ' . HTML_NEW_LINE . 'A Change Proposal application has been raised by '. $originator. HTML_NEW_LINE.
                            'Use the link below to approve it.' . $link;

                $email_model = new EmailModel();
                $email_model->add([
                    'subject' => $subject,
                    'body' => $body,
                    'recipient_user_id' => $_POST['hod_id']
                ]);
                redirect('cms-forms/dashboard/');
            }
        }
        $this->view('cms_forms/start_change_process', $payload);
    }

    public function HODAssessment(int $cms_form_id = -1)
    {
        if (!isLoggedIn())
        {
            redirect('users/login');
        }
        $payload = array();
        $payload['title'] = 'Further Assessment by HOD';
        $payload['form'] = new CMSForm($cms_form_id);
        $payload['originator'] = new User($payload['form']->originator_id);
        $payload['hod'] = new User($payload['form']->hod_id);
        $payload['gms'] = getGms();
        if (getUserSession()->user_id !== $payload['form']->hod_id)
        {
        	flash('flash_index','You are not the HOD assigned to approve this form.', 'text-danger text-center alert', '');
            $this->view('notices/index');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
        	$_POST = filterPost();
            $form = new CMSForm($cms_form_id);
            $form->hod_approval = $_POST['hod_approval'];
            $form->hod_reasons = $_POST['hod_reasons'];
            $form->hod_ref_num = $_POST['hod_ref_num'];
            $form->hod_approval_date = (new DateTime)->format(DFB);
            if (isset($_POST['gm_id']))
            {
            	$form->gm_id = $_POST['gm_id'];
            }

            $form->section_completed = ACTION_HOD_ASSESSMENT;

            if ($form->hod_approval == 'approved')
            {
            	notifyOHSForMonitoring($cms_form_id);
            }
            $form->next_action = ACTION_RISK_ASSESSMENT;
            $form = $form->jsonSerialize();
            if ((new CMSFormModel())->updateForm($cms_form_id, $form)) {
                flash('flash_dashboard', 'Change Process updated successfully!', 'alert text-success text-center');
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filterPost($_POST);
            $payload['form']->affected_dept = implode(',', $_POST['affected_dept']);
            if ((new CMSFormModel())->updateForm($cms_form_id, [
                'affected_dept' => payload['form']->affected_dept,
                'section_completed' => ACTION_RISK_ASSESSMENT,
                'next_action' => ACTION_IMPACT_ASSESSMENT
                ]))
            {
                if (isset($_POST['risk_attachment']))
                {
            	    $ret = uploadRiskAttachment('risk_attachment', $cms_form_id);
                    if (!$ret['success'])
                    {
                        flash('flash_risk_assessment', $ret['reason'], 'text-danger text-center alert');
                    }
                }
            }
            else {
                flash('flash_risk_assessment', 'An error occured!', 'text-danger text-center alert');
            }
            redirect('cms-forms/risk-assessment/'.$cms_form_id);
        }
        $this->view('cms_forms/risk_assessment', $payload);
    }

    public function ImpactAssessment($cms_form_id)
    {
        
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
        redirect('cms-forms/'.$payload['form']->next_action . '/'. $cms_form_id);
    }

    public function StopChangeProcess(int $cms_form_id = -1)
    {
        $payload = array();
    }
}
