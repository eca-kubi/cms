<?php
class User extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
        $this->columns = [
            'first_name',
            'last_name',
            'role',
            'password',
            'profile_pic',
            'email',
            'job_title',
            'staff_id',
            'employment_date',
            'phone_number',
            "contract_start",
            "contract_end",
            'department_id'
        ];
    }

    // Login User
    public function login($staff_id, $password)
    {
        $ret = $this->db->ObjectBuilder()
            ->where('staff_id', $staff_id)
            ->getOne($this->table);
        if ($ret) {
            $hashed_password = $ret->password;
            if (password_verify($password, $hashed_password)) {
                return $ret;
            }
            else {
                return false;
            }
        }
        return false;
    }

    // Verify existence of staff_id
    public function has($staff_id)
    {
        $this->db->where('staff_id', $staff_id);
        if ($this->db->has($this->table)) {
            return 'true';
        }
        return '';
    }

    // Verify existence of staff_id with id_
    public function hasWithIdUser($staff_id)
    {
        $this->db->where('staff_id', $staff_id);
        if ($this->db->has($this->table)) {
            return 'true';
        }
        return false;
    }

    public function hasRole($role, $staff_id)
    {
        $this->db->where('role', $role);
        $this->db->where('staff_id', $staff_id);
        if ($this->db->has($this->table)) {
            return 'true';
        }
        return '';
    }

    public function getUsersByRole($role)
    {
        $this->db->where('role', $role)->orderBy('first_name', 'asc');
        return $this->db->ObjectBuilder()->get($this->table);
    }


    public function hasManager($dept_id)
    {
        return $this->db->where('department', $dept_id)
        ->where('role', 'mgr')
        ->has($this->table);
    }
}