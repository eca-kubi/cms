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
        $data['title'] = 'CMS Dashboard';
        $data['active'] = CMSFormModel::getActive();
        $data['closed'] = CMSFormModel::getClosed();
        $this->view('cms_forms/dashboard', $data);
    }
    public function Active()
    {

    }


    public function Closed()
    {

    }

    public function Add()
    {
        if (!isLoggedIn())
        {
            redirect('users/login');
        }
        $data = array();
        $data['title'] = 'New Change Proposal Form';
        $data['hod'] = Database::getDbh()->
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
            $form->change_type = implode(',', $_POST['change_type']);
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
            $form->next_action = NEXT_ACTION_HOD_ASSESSMENT;
            $form = removeEmptyVal($form->jsonSerialize());
            $form_model = new CMSFormModel();
            if ($cms_form_id = $form_model->add($form))
            {
            	flash('flash_dashboard', 'Your change process application has been submitted successfully.
                            Your manager has been notified. Your manager\s approval is required for the change process to proceed.',
                            'text-success text-sm text-center');
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
                redirect('cms-forms/dashboard/'.$cms_form_id);
            }
        }
        $this->view('cms_forms/add', $data);
    }

    public function HODAssessment(int $cms_form_id = -1)
    {
        if (!isLoggedIn())
        {
            redirect('users/login');
        }
        $data = array();
        $data['title'] = 'Further Assessment by HOD';
        $data['form'] = new CMSForm($cms_form_id);
        if (getUserSession()->user_id !== $data['form']->hod_id)
        {
        	flash('flash_index','You are not the HOD assigned to approve this form.', 'text-danger text-center alert', '');
            $this->view('notices/index');
            exit();
        }
        $this->view('cms_forms/hod_assessment', $data);
    }

    public function RiskAssessment(int $cms_form_id = -1)
    {
        $data = array();
        $data['user'] = getUserSession();
        $data['title'] = 'Risk Assessment';
        $this->view('cms_forms/risk_assessment', $data);
    }

    public function GMAssessment(int $cms_form_id = -1)
    {
        $data = array();
        $data['user'] = getUserSession();
        $data['title'] = 'GM Assessment';
        $this->view('cms_forms/gm_assessment', $data);
    }

    public function HODAuthorisation(int $cms_form_id = -1)
    {
        $data = array();
        $data['user'] = getUserSession();
        $data['title'] = 'Authorisation by HOD to Implement Change';
        $this->view('cms_forms/hod_authorisation', $data);
    }

    public function PLAcceptance(int $cms_form_id = -1)
    {
        $data = array();
        $data['user'] = getUserSession();
        $data['title'] = 'Project Leader Acceptance';
        $this->view('cms_forms/pl_acceptance', $data);
    }

    public function ActionList(int $cms_form_id = -1)
    {
        $data = array();
        $data['user'] = getUserSession();
        $data['title'] = 'Action List';
        $this->view('cms_forms/action_list', $data);
    }

    public function PLClosure(int $cms_form_id = -1)
    {
        $data = array();
        $data['user'] = getUserSession();
        $data['title'] = 'Process Closure by Project Leader';
        $this->view('cms_forms/pl_closure', $data);
    }

    public function OriginatorClosure(int $cms_form_id = -1)
    {
        $data = array();
        $data['user'] = getUserSession();
        $data['title'] = 'Process Closure by Originator';
        $this->view('cms_forms/orig_closure', $data);
    }

    public function HODClosure(int $cms_form_id = -1)
    {
        $data = array();
        $data['user'] = getUserSession();
        $data['title'] = 'Process Closure by HOD';
        $this->view('cms_forms/hod_closure', $data);
    }

    public function ProcessClosed(int $cms_form_id = -1)
    {
        $data = array();
        $data['user'] = getUserSession();
        $data['title'] = 'Process Closed';
        flash('process_closed','This Change Process is complete and has been closed!', 'text-danger text-center',
                            '&nbsp');
        $this->view('cms_forms/process_closed', $data);
    }

    public function ViewChangeProcess(int $cms_form_id = -1)
    {
        $data = array();
        $data['title'] = 'Change Proposal, Assessment & Implementation';
        $data['form'] = new CMSForm($cms_form_id);
        $this->view('cms_forms/view_change_process', $data);
    }

    public function NextAction(int $cms_form_id = -1)
    {
        $data = array();

    }

    public function StopChangeProcess(int $cms_form_id = -1)
    {
        $data = array();
    }
}
