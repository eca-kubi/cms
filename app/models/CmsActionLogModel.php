<?php

class CmsActionLogModel extends Model implements \JsonSerializable
{
    public static $table = 'cms_action_log';
    public $cms_action_log_id;
    public $cms_form_id;
    public $department_affected;
    public $section_affected;
    public $performed_by;
    public $action;
    public $date;

    public function __construct($where_col_val = null)
    {
        parent::__construct();
        if (!empty($where_col_val)) {
            $log = $this->fetchSingle($where_col_val);
            foreach ($log as $col => $value) {
                $this->$col = $value;
            }
        }
    }

    public function fetchSingle(array $where_col_val)
    {
        $db = Database::getDbh()->objectBuilder();
        if (!empty($where_col_val)) {
            foreach ($where_col_val as $col => $val) {
                $db = $db->where($col, $val);
            }
        }
        return $db->getOne('cms_action_log');
    }

    public static function has($column, $value, array $where = null)
    {
        $db = Database::getDbh();
        $db->where($column, $value);
        if (!empty($where)) {
            foreach ($where as $col => $value) {
                $db->where($col, $value);
            }
        }
        if ($db->has(self::$table)) {
            return 'true';
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getCmsActionLogId()
    {
        return $this->cms_action_log_id;
    }

    /**
     * @param mixed $cms_action_log_id
     * @return CmsActionLogModel
     */
    public function setCmsActionLogId($cms_action_log_id)
    {
        $this->cms_action_log_id = $cms_action_log_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartmentAffected()
    {
        return $this->department_affected;
    }

    /**
     * @param mixed $department_affected
     * @return CmsActionLogModel
     */
    public function setDepartmentAffected($department_affected)
    {
        $this->department_affected = $department_affected;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPerformedBy()
    {
        return $this->performed_by;
    }

    /**
     * @param mixed $performed_by
     * @return CmsActionLogModel
     */
    public function setPerformedBy($performed_by)
    {
        $this->performed_by = $performed_by;
        return $this;
    }

    public function insert()
    {
        $db = Database::getDbh();
        $ret = $db->insert(self::$table, $this->jsonSerialize());
        if ($ret) {
            return $db->getInsertId();
        }
    }

    public function jsonSerialize()
    {
        return [
            'department_affected' => $this->department_affected,
            'section_affected' => $this->getSectionAffected(),
            'date' => $this->getDate(),
            'action' => $this->getAction(),
            'performed_by' => $this->performed_by,
            'cms_form_id' => $this->getCmsFormId(),
        ];
    }

    /**
     * @return mixed
     */
    public function getSectionAffected()
    {
        return $this->section_affected;
    }

    /**
     * @param mixed $section_affected
     * @return CmsActionLogModel
     */
    public function setSectionAffected($section_affected)
    {
        $this->section_affected = $section_affected;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return CmsActionLogModel
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     * @return CmsActionLogModel
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCmsFormId()
    {
        return $this->cms_form_id;
    }

    /**
     * @param mixed $cms_form_id
     * @return CmsActionLogModel
     */
    public function setCmsFormId($cms_form_id)
    {
        $this->cms_form_id = $cms_form_id;
        return $this;
    }
}