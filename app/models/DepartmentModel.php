<?php
class DepartmentModel extends Model implements \JsonSerializable
{
    public $department;
    public $department_id;
    public static $table = 'departments';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Summary of getDepartment
     * @param mixed $department_id
     * @return array
     */
    public function getDepartment(int $department_id = null)
    {
        $ret = Database::getDbh()->where('department_id', $department_id)->
                        objectBuilder()->
                        getOne(self::$table);
        if (count((array)$ret) < 1)
        {
            $ret = isset($ret) ? $ret : new stdClass();
        	$ret->department ='N/A';
        }
        return $ret;
    }

    public function getAllDepartments()
    {
        return
            Database::getDbh()->
                        objectBuilder()->
                        get(self::$table);
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

    public function jsonSerialize(){
        return [
            'department' => $this->department,
            'department_id' => $this->department_id,
        ];
    }
}