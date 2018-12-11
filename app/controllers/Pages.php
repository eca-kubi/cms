<?php
class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        if (isLoggedIn())
        {
        	redirect('cms-forms/dashboard');
        }
        
        redirect('users/login');
    }


    public function about()
    {
        $data = [];
        $data['title'] = 'About us';
        $this->view('pages/about', $data);
    }
}
