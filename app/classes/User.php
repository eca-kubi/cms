<?php

/**
 * User short summary.
 *
 * User description.
 *
 * @version 1.0
 * @author UNCLE CHARLES
 * @var Department department
 */
class User
{
    private $user_model;
    public $first_name;
    public $last_name;
    public $staff_id;
    public $user_id;
    public $password;
    public $role;
    public $email;
    public $profile_pic;
    public $job_title;
    public $department;
    public $department_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
        $this->user_model = new UserModel();
        $user = $this->user_model->getUser($user_id);
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->staff_id = $user->staff_id;
        $this->user_id = $user->user_id;
        $this->password = $user->password;
        $this->role = $user->role;
        $this->email = $user->email;
        $this->profile_pic = $user->profile_pic;
        $this->job_title = $user->job_title;
        $this->department_id = $user->department_id;
        $this->department = new Department($this->department_id);
    }

    public function jsonSerialize(){
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'staff_id' => $this->staff_id,
            'email' => $this->email,
            'role' => $this->role,
            'profile_pic' => $this->profile_pic,
            'job_title' => $this->job_title,
            'department' => $this->department,
            'department_id' => $this->department_id,
            'password' => $this->password,
            'user_id' => $this->user_id
        ];
    }
}