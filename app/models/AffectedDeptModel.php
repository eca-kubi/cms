<?php
class AffectedDeptModel extends Model
{
    public $cms_form_id;
    public $department_id;
    public $impact_ass_completed;
    public $affected_dept_id;
    public $date_completed;
    public $date_modified;
    public $completed_by;
    public static $table = 'affected_dept';
    public function __construct()
    {
        parent::__construct();
    }

    public function add(array $insertData)
    {
    	return Database::getDbh()->insert(self::$table, $insertData);
    }

    public function updateAffectedDept($cms_form_id, $department_id, array $insertData) {
        return Database::getDbh()->where('department_id', $department_id)->
        where('cms_form_id', $cms_form_id)->
        update(self::$table, $insertData);
    }

    public function getAffectedDept(int $affected_dept_id)
    {
        $db = Database::getDbh();
        return  (object)$db->where('affected_dept_id', $affected_dept_id)->
                      objectBuilder()->
                      getOne(self::$table);
    }

    public function getAllAffectedDept(int $cms_form_id)
    {
        $db = Database::getDbh();
        return  $db->where('cms_form_id', $cms_form_id)->
                      objectBuilder()->
                      get(self::$table);
    }

    public function getCompleted(int $cms_form_id) : array
    {
        $db = Database::getDbh();
        return  $db->where('cms_form_id', $cms_form_id)->
        where('impact_ass_completed', true)->
                      objectBuilder()->
                      get(self::$table);
    }


    public static function has($column, $value )
    {
        $db = Database::getDbh();
        $db->where($column, $value);
        if ($db->has(self::$table)) {
            return 'true';
        }
        return false;
    }


}