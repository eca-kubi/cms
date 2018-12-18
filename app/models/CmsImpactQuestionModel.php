<?php
class CmsImpactQuestionModel extends Model
{
    public $department_id;
    public $question;
    public $cms_impact_question_id;
    public static $table = 'cms_impact_question';

    public function __construct()
    {
        parent::__construct();
    }

    public function add(array $insertData)
    {
    	return Database::getDbh()->insert(self::$table, $insertData);
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

    function getImpactQuestions($department_id = null)
    {
        if (empty($department_id))
        {
            return Database::getDbh()->objectbuilder()->
            get('cms_impact_question');
        }

        return Database::getDbh()->where('department_id', $department_id)->
        objectBuilder()->
        get('cms_impact_question');
    }
}