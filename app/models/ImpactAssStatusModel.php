<?php

class ImpactAssStatusModel extends Model implements \JsonSerializable
{
    public static $table = 'impact_ass_status';
    public $impact_ass_status_id;
    public $cms_form_id;
    public $department_id;
    public $status;
    public $approved_by;
    public $hod_comment;
    public $hod_comment_date;

    public function __construct(array $where_col_val = null)
    {
        parent::__construct();
        if (!empty($where_col_val)) {
            $ret = $this->fetchSingle($where_col_val);
            if ($ret) {
                foreach ($ret as $col => $value) {
                    $this->$col = $value;
                }
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
        return $db->getOne(self::$table);
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

    public static function updateImpactAssStatus($where_values, $data)
    {
        $db = Database::getDbh();
        foreach ($where_values as $col => $val) {
            $db->where($col, $val);
        }
        $db->update(self::$table, $data);
    }

    /**
     * @return mixed
     */
    public function getImpactAssStatusId()
    {
        return $this->impact_ass_status_id;
    }

    /**
     * @param mixed $impact_ass_status_id
     * @return ImpactAssStatusModel
     */
    public function setImpactAssStatusId($impact_ass_status_id)
    {
        $this->impact_ass_status_id = $impact_ass_status_id;
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
     * @return ImpactAssStatusModel
     */
    public function setCmsFormId($cms_form_id)
    {
        $this->cms_form_id = $cms_form_id;
        return $this;
    }

    public function insert()
    {
        $db = Database::getDbh();
        $data = $this->jsonSerialize();
        unset($data['impact_ass_status_id']);
        $ret = $db->insert(self::$table, $data);
        if ($ret) {
            return $db->getInsertId();
        }
    }

    public function jsonSerialize(): array
    {
        return [
            'department_id' => $this->getDepartmentId(),
            'status' => $this->getStatus(),
            'approved_by' => $this->getApprovedBy(),
            'cms_form_id' => $this->cms_form_id,
            'hod_comment_date' => $this->getHodCommentDate(),
            'hod_comment' => $this->getHodComment()
        ];
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
     * @return ImpactAssStatusModel
     */
    public function setDepartmentId($department_id)
    {
        $this->department_id = $department_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return ImpactAssStatusModel
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApprovedBy()
    {
        return $this->approved_by;
    }

    /**
     * @param mixed $approved_by
     * @return ImpactAssStatusModel
     */
    public function setApprovedBy($approved_by)
    {
        $this->approved_by = $approved_by;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHodCommentDate()
    {
        return $this->hod_comment_date;
    }

    /**
     * @param mixed $hod_comment_date
     * @return ImpactAssStatusModel
     */
    public function setHodCommentDate($hod_comment_date)
    {
        $this->hod_comment_date = $hod_comment_date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHodComment()
    {
        return $this->hod_comment;
    }

    /**
     * @param mixed $hod_comment
     * @return ImpactAssStatusModel
     */
    public function setHodComment($hod_comment)
    {
        $this->hod_comment = $hod_comment;
        return $this;
    }
}