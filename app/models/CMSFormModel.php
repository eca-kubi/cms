<?php
class CMSFormModel extends Model
{
    public $cms_form_id;
    public $originator_id;
    public $date_raised;
    public $change_type;
    public $change_description;
    public $advantages;
    public $alternatives;
    public $area_affected;
    public $hod_id;
    public $hod_approval;
    public $hod_ref_num;
    public $gm_approval;
    public $gm_reasons;
    public $hod_auth_change_implem;
    public $proj_leader_id;
    public $proj_leader_acceptance;
    public $hod_close_change;
    public $originator_close_change;
    public $proj_leader_close_change;
    public $department_id;
    public $additional_info;
    public static $table = 'cms_form';
    public $cms_form = null;
    public function __construct()
    {
        parent::__construct();
    }

    public function add($insertData)
    {
    	return Database::getDbh()->insert(self::$table, $insertData);
    }

    public function getCMSForm(int $cms_form_id)
    {
        $db = Database::getDbh();
        return  (object)$db->where('cms_form_id', $cms_form_id)->
                      objectBuilder()->
                      getOne('cms_form');
    }

    public static function getActive()
    {
        return (object)Database::getDbh()->where('closed', false)->
                objectBuilder()->
                get('cms_form');
    }

    public static function getClosed()
    {
        return (object)Database::getDbh()->where('closed', true)->
                   objectBuilder()->
                   get('cms_form');
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