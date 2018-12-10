<?php
class UserModel extends Model
{
    public $first_name;
    public $last_name;
    public $staff_id;
    public $user_id;
    public $password;
    public $role;
    public $email;
    public $profile_pic;
    public $title;
    public $job_title;
    public $department_id;
    public static $table = 'users';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Summary of getUser
     * @param mixed $user_id
     * @return object|false
     */
    public function getUser(int $user_id)
    {
        return (object)
            Database::getDbh()->where('user_id', $user_id)->
                        objectBuilder()->
                        getOne('users u');
    }

    public function getUserWhere(array $condition_array)
    {
    $db = Database::getDbh();
    foreach ($condition_array as $key => $value)
    {
    	$db->where($key, $value);
    }
    
        return (object)
            $db->objectBuilder()->
                 getOne('users u');
    }

    // Login User
    /**
     * Summary of login
     * @param mixed $staff_id
     * @param mixed $password
     * @return array|bool
     */
    public static function login($staff_id, $password)
    {
        $db = Database::getDbh();
        $ret = $db->where('staff_id', $staff_id)->
                getOne(self::$table);
        if ($ret) {
            $hashed_password = $ret['password'];
            if (password_verify($password, $hashed_password)) {
                return $ret;
            }
        }
        return false;
    }

    // Verify existence of column value
    public static function has($column, $value )
    {
        $db = Database::getDbh();
        $db->where($column, $value);
        if ($db->has(self::$table)) {
            return 'true';
        }
        return false;
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


}