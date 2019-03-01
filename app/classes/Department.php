<?php

/**
 * Department short summary.
 *
 * Department description.
 *
 * @version 1.0
 * @author UNCLE CHARLES
 * @var department string
 */
class Department
{
    private $department_model;
    public $department;
    public $department_id;
    public $short_name;

    public function __construct($department_id)
    {
        $this->department_model = new DepartmentModel();
        $this->department_id = $department_id;
        $department = $this->department_model->getDepartment($this->department_id);
        $this->department = empty($department) ? "N/A" : $department->department;
        $this->short_name = empty($department) ? "N/A" : $department->short_name;
    }
}