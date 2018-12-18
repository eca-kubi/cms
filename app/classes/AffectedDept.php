<?php

/**
 * AffectedDept short summary.
 *
 * AffectedDept description.
 *
 * @version 1.0
 * @author UNCLE CHARLES
 */
class AffectedDept  implements \JsonSerializable
{
    public $cms_form_id;
    public $department_id;
    public $impact_ass_completed;
    public $affected_dept_id;
    public $date_completed;
    public $date_modified;
    public $completed_by;

    public function __construct($affected_dept_id = -1)
    {
        $this->affected_dept = new AffectedDeptModel();
        $affected_dept = $this->affected_dept->getAffectedDept($affected_dept_id);
        if (!empty((array)$affected_dept))
        {
        	$this->affected_dept_id = $affected_dept->affected_dept_id;
            $this->completed_by = $affected_dept->completed_by;
            $this->impact_ass_completed = $affected_dept->impact_ass_completed;
            $this->department_id = $affected_dept->department_id;
            $this->date_modified = $affected_dept->date_modified;
            $this->cms_form_id = $affected_dept->cms_form_id;
            $this->date_completed = $affected_dept->date_completed;
        }
    }

    public function jsonSerialize(){
        return [
            'cms_form_id' => $this->cms_form_id,
            'date_completed' =>$this->date_completed,
            'date_modified' => $this->date_modified,
            'completed_by' => $this->completed_by,
            'department_id' => $this->department_id,
            'affected_dept_id' => $this->affected_dept_id,
            'hod_approval_date' => $this->hod_approval_date
        ];
    }
}