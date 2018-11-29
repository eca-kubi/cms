<?php
class Users extends Controller
{
    public function __construct()
    {
    }


    function login()
    {
    	$data = [
            'title' => 'Login'
        ];
        $this->view('users/login', $data);
    }

    function dashboard()
    {
    	$data = [
            'title' => 'Dashboard'
        ];
        $this->view('users/dashboard', $data);
    }

}
