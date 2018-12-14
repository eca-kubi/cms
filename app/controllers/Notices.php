<?php
class Notices extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $payload['title'] = 'Notice';
        $payload['user'] = getUserSession();
        $this->view('notices/index', $payload);
    }

    public function success()
    {
      $payload['title'] = 'Success Notice';
      $payload['user'] = getUserSession();
      $this->view('notices/index', $payload);
    }

    public function failure()
    {
      $payload['title'] = 'Failure Notice';
      $payload['user'] = getUserSession();
      $this->view('notices/index', $payload);
    }

    public function warning()
    {

    }
}
