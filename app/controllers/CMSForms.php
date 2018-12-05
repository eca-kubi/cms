<?php
class CMSForms extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn())
        {
        	redirect('users/login');
        }

    }

    public function index()
    {
        $data = array();
        $data['user'] = getUserSession();
        $data['title'] = 'CMS Forms';
        $this->view('cms_forms/index', $data);
    }

    public function Active()
    {

    }

    public function Closed()
    {

    }

    public function Add()
    {
        $data = array();
        $data['user'] = getUserSession();
        $data['title'] = 'New Change Proposal Form';
        $this->view('cms_forms/add', $data);
    }

    public function HODAssessment(int $cms_form_id = -1)
    {
        $data = array();
        $data['user'] = getUserSession();
        $data['title'] = 'Further Assessment by HOD';
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
}
