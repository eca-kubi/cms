<?php
class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        redirect('users/login');
    }


    public function about()
    {
        $data = new ArrayObject();
        $data->title = 'About us';
        $this->view('pages/about', $data);
    }
}
