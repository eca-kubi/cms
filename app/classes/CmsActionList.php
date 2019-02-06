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

    public function fetchSingle($cms_action_list_id)
    {
        $db = Database::getDbh()
            ->objectBuilder()
            ->where('cms_action_list_id', $cms_action_list_id)
            ->get(self::$table);
        return $db;
    }

    public function initialize($col_val)
    {
        foreach ($col_val as $col => $value) {
            $this->$col = $value;
        }
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
            $this->cms_form_id = $db->getInsertId();
            return $this->cms_form_id;
        }
        return null;
    }

    public function jsonSerialize()
    {
        return [
            'action' => $this->action,
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

    public function update($cms_action_list_id, array $col_vals)
    {
        $db = Database::getDbh();
        $ret = $db->where('cms_action_list_id', $cms_action_list_id)
            ->update(self::$table, $col_vals);
        return $ret;
    }

    public function destroy($cms_action_list_id)
    {
        $db = Database::getDbh();
        return $db->where('cms_action_list_id', $cms_action_list_id)
            ->delete(self::$table);
    }
}
