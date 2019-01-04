<?php
class CmsImpactResponseModel extends Model
{
    public $cms_form_id;
    public $department_id;
    public $response;
    public $cms_impact_question_id;
    public $cms_impact_response_id;
    public static $table = 'cms_impact_response';

    public function __construct()
    {
        parent::__construct();
    }

    public function add(array $insertData)
    {
        return Database::getDbh()->
        onDuplicate(['cms_form_id', 'cms_impact_question_id'])->
        insert(self::$table, $insertData);
    }

    public function updateAffectedDept($cms_impact_response_id, $insertData)
    {
        return Database::getDbh()->where('cms_impact_response_id', $cms_impact_response_id)->
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