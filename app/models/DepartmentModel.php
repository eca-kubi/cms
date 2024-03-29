<?php

class DepartmentModel extends Model implements \JsonSerializable
{
    public static $table = 'departments';
    public $department;
    public $department_id;
    public $short_name;
    public $current_manager;

    public function __construct()
    {
        parent::__construct();
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

    /**
     * @return mixed
     */
    public function getDepartmentId()
    {
        return $this->department_id;
    }

    /**
     * @param mixed $department_id
     * @return DepartmentModel
     */
    public function setDepartmentId($department_id)
    {
        $this->department_id = $department_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShortName()
    {
        return $this->short_name;
    }

    /**
     * @param mixed $short_name
     * @return DepartmentModel
     */
    public function setShortName($short_name)
    {
        $this->short_name = $short_name;
        return $this;
    }

    /**
     * Summary of getDepartment
     * @param mixed $department_id
     * @return mixed
     */
    public function getDepartment($department_id = null)
    {
        $ret = Database::getDbh()
            ->where('department_id', $department_id)
            ->objectBuilder()
            ->getOne(self::$table);
        /*        if (count((array)$ret) < 1) {
                    $ret = isset($ret) ? $ret : new stdClass();
                    $ret->department = 'N/A';
                }*/
        return $ret;
    }

    // Verify existence of column value

    public function getAllDepartments()
    {
        return
            Database::getDbh()
                ->objectBuilder()
                ->get(self::$table);
    }

    public function jsonSerialize()
    {
        return [
            'department' => $this->department,
            'department_id' => $this->department_id,
            'short_name' => $this->short_name,
            'current_manager' => $this->current_manager
        ];
    }
}