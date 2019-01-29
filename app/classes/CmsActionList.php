<?php

/**
 * CmsActionList short summary.
 *
 * CmsActionList description.
 *
 * @version 1.0
 *
 * @author UNCLE CHARLES
 */
class CmsActionList implements \JsonSerializable
{
    public static $table = 'cms_action_list';
    public $cms_form_id;
    public $action;
    public $person_responsible;
    public $completed;
    public $date;

    /**
     * CmsActionList constructor.
     * @param array|null $where_col_val
     */
    public function __construct(array $where_col_val = null)
    {
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

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action): void
    {
        $this->action = $action;
    }

    public function insert()
    {
        $db = Database::getDbh();
        $ret = $db->insert(self::$table, $this->jsonSerialize());
        if ($ret) {
            return $db->getInsertId();
        }
        return null;
    }

    public function jsonSerialize()
    {
        return [
            'cms_form_id' => $this->cms_form_id,
            'date' => $this->getDate(),
            'completed' => $this->getCompleted(),
            'person_responsible' => $this->getPersonResponsible()
        ];
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
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * @param mixed $completed
     */
    public function setCompleted($completed): void
    {
        $this->completed = $completed;
    }

    /**
     * @return mixed
     */
    public function getPersonResponsible()
    {
        return $this->person_responsible;
    }

    /**
     * @param mixed $person_responsible
     */
    public function setPersonResponsible($person_responsible): void
    {
        $this->person_responsible = $person_responsible;
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
     * @return CmsActionList
     */
    public function setCmsFormId($cms_form_id)
    {
        $this->cms_form_id = $cms_form_id;
        return $this;
    }
}
