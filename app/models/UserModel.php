<?php

class UserModel extends Model
{
    public static $table = 'users';
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
    public $can_change_gm;

    public function __construct()
    {
        parent::__construct();
    }

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

    public static function has($column, $value)
    {
        $db = Database::getDbh();
        $db->where($column, $value);
        if ($db->has(self::$table)) {
            return 'true';
        }
        return false;
    }

    // Login User

    public static function getUsers(array $where_val)
    {
        $db = Database::getDbh();
        foreach ($where_val as $key => $value) {
            $db->where($key, $value);
        }
        return
            $db->objectBuilder()->
            get('users');
    }

    // Verify existence of column value

    /**
     * Summary of getUser
     * @param mixed $user_id
     * @return object|UserModel|false
     */
    public function getUser(int $user_id)
    {
        return (object)
        Database::getDbh()->where('user_id', $user_id)->objectBuilder()->getOne('users u');
    }

    public function getUserWhere(array $condition_array)
    {
        $db = Database::getDbh();
        foreach ($condition_array as $key => $value) {
            $db->where($key, $value);
        }
        return (object)
        $db->objectBuilder()->
        getOne('users u');
    }
}