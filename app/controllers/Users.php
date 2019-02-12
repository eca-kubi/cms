<?php
class Users extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data = [];
    }


    function login()
    {
        $this->data['title'] = 'CMS Login';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->data['post'] = validatePost('login_form');
            $post = $this->data['post'];
            if(!empty($post->staff_id_err) || !empty($post->password_err))   {
                flash('flash', 'Invalid Username/Password', 'alert text-danger text-center');
                $this->view('users/login', $this->data);
            }
            else {
                $loggedInUser = UserModel::login($post->staff_id, $post->password);
                if ($loggedInUser)
                {
                    $u = new \User($loggedInUser['user_id']);
                	createUserSession($u);
                    redirect('cms-forms/dashboard');
                }
            }
        } else {
            $this->data['post'] = validatePost('login_form');
            $this->view('users/login', $this->data);
        }
    }

    public function profile($user_id = null)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        if (empty($user_id) || !userExists($user_id)) {
            $user_id = getUserSession()->user_id;
        }

        $this->data['title'] = 'Profile';

        try {
            $post = Database::getDbh()
                ->ObjectBuilder()
                ->where('u.user_id', $user_id)
                ->join('departments d', 'd.department_id=u.department_id', 'LEFT')
                ->getOne('users u');
        } catch (Exception $e) {
        }

        $this->data['mgrs'] =
            getDepartmentHods(getUserSession()->department_id);
        $this->data['post'] = $post;
        $this->data['user'] = getUserSession();
        $this->view('users/profile', $this->data);
    }

    public function logout()
    {
        logout();
    }
}
