<?php
class Helpers extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        //$this->userModel = $this->model('user');
        $this->db = Database::getDbh();
    }

    public function index()
    {
        redirect('errors/index/400');
    }

    public function proxyMail()
    {
        return sendMail();
    }

    public function execInBackground($cmd = 'bash.exe') {
       if (substr(php_uname(), 0, 7) == "Windows"){
            pclose(popen("start  ". $cmd, "r"));
        }
        else {
            exec($cmd . " > /dev/null &");
        }
        echo 'exec returned' ;
    }

    function execB()
    {
    	$cm = "c:\\xampp\php\php.exe divisibility-by-three.php";
        pclose(popen("start /B ". $cm, "a"));
    }

}

?>