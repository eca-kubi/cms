<?php
class Pages extends Controller
{
    public function __construct()
    {
        if (isLoggedIn())
        {
        	
        }
        
    }

    public function index()
    {
        redirect('users/login');
    }


    public function about()
    {
        $data = [
            'title' => 'About Us'
        ];

        $this->view('pages/about', $data);
    }
}
