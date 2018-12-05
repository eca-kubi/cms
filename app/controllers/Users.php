<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->data = array();
        $this->userModel = $this->model('user');
    }


    function login()
    {
        $this->data['title'] = 'CMS Login';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->data['post'] = validatePost('login_form');
            /**
             * @var stdClass
             */
            $post = $this->data['post'];
            if(!empty($post->staff_id_err) || !empty($post->password_err))   {
                flash('flash', 'Invalid Username/Password', 'alert text-danger text-center');
                $this->view('users/login', $this->data);
            }
            else {
                $loggedInUser = $this->userModel->login($post->staff_id, $post->password);
                createUserSession($loggedInUser);
                redirect('users/dashboard');
            }
        } else {
            $this->data['post'] = validatePost('login_form');
            $this->view('users/login', $this->data);
        }
    }

    function dashboard()
    {
        if (!isLoggedIn())
        {
        	redirect('users/login');
        }
        
    	$data = [
            'title' => 'CMS Dashboard',
            'user' => getUserSession()
        ];
        $this->view('users/dashboard', $data);
    }

}
