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
     * @return object|false
     */
    public function getDepartment(int $department_id)
    {
        return (object) 
            Database::getDbh()->where('department_id', $department_id)->
                        objectBuilder()->
                        getOne(self::$table);
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