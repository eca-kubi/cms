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
    public $can_assess_impact;
    public $can_change_gm;
    public $default_password;
    public $can_change_dept_mgr;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
        $this->user_model = new UserModel();
        $userObj = $this->user_model->getUser($user_id);
        $this->first_name = $userObj->first_name;
        $this->last_name = $userObj->last_name;
        $this->staff_id = $userObj->staff_id;
        $this->user_id = $userObj->user_id;
        $this->password = $userObj->password;
        $this->role = $userObj->role;
        $this->email = $userObj->email;
        $this->profile_pic = $userObj->profile_pic;
        $this->job_title = $userObj->job_title;
        $this->department_id = $userObj->department_id;
        $this->department = new Department($this->department_id);
        $this->can_assess_impact = $userObj->can_assess_impact;
        $this->can_change_gm = $userObj->can_change_gm;
        $this->default_password = $userObj->default_password;
        $this->can_change_dept_mgr = $userObj->can_change_dept_mgr;
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
            'user_id' => $this->user_id,
            'can_assess_impact' => $this->can_assess_impact,
            'can_change_gm' => $this->can_change_gm,
            'default_password' => $this->default_password,
            'can_change_dept_mgr' => $this->can_change_dept_mgr
        ];
    }
}