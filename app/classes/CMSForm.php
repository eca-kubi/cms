<?php

/**
 * CMSForm short summary.
 *
 * CMSForm description.
 *
 * @version 1.0
 * @author UNCLE CHARLES
 */
class CMSForm  implements \JsonSerializable
{
    public $cms_form_id;
    public $originator_id;
    public $gm_id;
    public $date_raised;
    public $change_type;
    public $change_description;
    public $advantages;
    public $alternatives;
    public $area_affected;
    public $hod_id;
    public $hod_approval;
    public $hod_ref_num;
    public $hod_reasons;
    public $gm_approval;
    public $gm_reasons;
    public $hod_auth_change_implem;
    public $proj_leader_id;
    public $proj_leader_acceptance;
    public $hod_close_change;
    public $originator_close_change;
    public $proj_leader_close_change;
    public $department_id;
    public $cms_form_model;
    public $cms_form;
    public $other_type;
    public $certify_details;
    public $next_action;
    public $budget_level;
    public $risk_level;
    public $additional_info;
    public $affected_dept;
    public $hod_approval_date;
    public $section_completed;

    public function __construct($cms_form_id = -1)
    {
        $this->cms_form_model = new CMSFormModel();
        $cms_form = $this->cms_form_model->getCMSForm($cms_form_id);
        if (!empty((array)$cms_form))
        {
        	$this->cms_form_id = $cms_form->cms_form_id;
            $this->originator_id = $cms_form->originator_id;
            $this->date_raised = $cms_form->date_raised;
            $this->change_type = $cms_form->change_type;
            $this->change_description = $cms_form->change_description;
            $this->advantages = $cms_form->advantages;
            $this->alternatives = $cms_form->alternatives;
            $this->area_affected = $cms_form->area_affected;
            $this->hod_id = $cms_form->hod_id;
            $this->hod_approval = $cms_form->hod_approval;
            $this->hod_ref_num = $cms_form->hod_ref_num;
            $this->gm_approval = $cms_form->gm_approval;
            $this->gm_reasons = $cms_form->gm_reasons;
            $this->hod_auth_change_implem = $cms_form->hod_auth_change_implem;
            $this->proj_leader_id = $cms_form->proj_leader_id;
            $this->proj_leader_acceptance = $cms_form->proj_leader_acceptance;
            $this->hod_close_change = $cms_form->hod_close_change;
            $this->originator_close_change = $cms_form->originator_close_change;
            $this->proj_leader_close_change = $cms_form->proj_leader_close_change;
            $this->next_action = $cms_form->next_action;
            $this->risk_level = $cms_form->risk_level;
            $this->budget_level = $cms_form->budget_level;
            $this->additional_info = $cms_form->additional_info;
            $this->affected_dept = $cms_form->affected_dept;
            $this->hod_approval_date = $cms_form->hod_approval_date;
            $this->section_completed = $cms_form->section_completed;
            $this->hod_reasons = $cms_form->hod_reasons;
        }
    }

    public function jsonSerialize(){
        return [
            'cms_form_id' => $this->cms_form_id,
            'originator_id' => $this->originator_id,
            'date_raised' => $this->date_raised,
            'change_type' => $this->change_type,
            'change_description' => $this->change_description,
            'advantages' => $this->advantages,
            'alternatives' => $this->alternatives,
            'area_affected' => $this->area_affected,
            'hod_id' => $this->hod_id,
            'hod_approval' => $this->hod_approval,
            'hod_ref_num' => $this->hod_ref_num,
            'gm_approval' => $this->gm_approval,
            'gm_reasons' => $this->gm_reasons,
            'hod_auth_change_implem' => $this->hod_auth_change_implem,
            'proj_leader_id' => $this->proj_leader_id,
            'proj_leader_acceptance' => $this->proj_leader_acceptance,
            'hod_close_change' => $this->hod_close_change,
            'originator_close_change' => $this->originator_close_change,
            'proj_leader_close_change' => $this->proj_leader_close_change,
            'next_action' => $this->next_action,
            'budget_level' => $this->budget_level,
            'risk_level' => $this->risk_level,
            'additional_info' => $this->additional_info,
            'hod_reasons' =>$this->hod_reasons,
            'affected_dept' => $this->affected_dept,
            'hod_approval_date' => $this->hod_approval_date,
            'section_completed' => $this->section_completed
        ];
    }
}