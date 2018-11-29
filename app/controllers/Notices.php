<?php
class Notices extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data['title'] = 'Notice';
        $data['user'] = getUserSession();
        $this->view('notices/index', $data);
    }

    public function success()
    {
      $data['title'] = 'Success Notice';
      $data['user'] = getUserSession();
      $this->view('notices/index', $data);
    }

    public function failure()
    {
      $data['title'] = 'Failure Notice';
      $data['user'] = getUserSession();
      $this->view('notices/index', $data);
    }

    public function warning()
    {

    }
}
