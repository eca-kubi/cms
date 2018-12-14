<?php
class Errors extends Controller
{
    public function __construct()
    {
    }

    public function index($error_code)
    {
        $status = $error_code? $error_code : $_SERVER['REDIRECT_STATUS'];
        $codes = array(
            400 => array('400', 'Bad Request'),
            403 => array('403', 'You do not have permission to perform this action.'),
            404 => array('404', 'Looks like that page was not found.'),
            405 => array('405', 'The method specified in the Request-Line is not allowed for the specified resource.'),
            408 => array('408', 'Your browser failed to send a request in the time allowed by the server.'),
            500 => array('500', 'The request was unsuccessful due to an unexpected condition encountered by the server.'),
            502 => array('502', 'The server received an invalid response from the upstream server while trying to fulfill the request.'),
            504 => array('504', 'The upstream server failed to send a request in the time allowed by the server.'),
        );

        $title = $codes[$status][0];
        $message = $codes[$status][1];
        $payload = [];
        $payload[
            'title']=  $title;
          $payload['message'] = $message;
        ob_start();
        header("HTTP/1.1 $title");
        $this->view('errors/index', $payload);
        ob_flush();
    }
}
