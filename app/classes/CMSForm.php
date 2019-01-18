<?php

/**
 * CMSForm short summary.
 *
 * CMSForm description.
 *
 * @version 1.0
 *
 * @author UNCLE CHARLES
 */
class CMSForm implements \JsonSerializable
{
    private static $table = 'cms_form';
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
    public $gm_approval_reasons;
    public $gm_reasons;
    public $hod_authorization;
    public $hod_authorization_comment;
    public $project_leader_id;
    public $project_leader_acceptance;
    public $project_leader_comment;
    public $hod_close_change;
    public $originator_close_change;
    public $project_leader_close_change;
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
    public $email_subject;
    public $risk_attachment;
    public $state;

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
    public function getGmApprovalReasons()
    {
        return $this->gm_approval_reasons;
    }

    /**
     * @param mixed $gm_approval_reasons
     * @return CMSForm
     */
    public function setGmApprovalReasons($gm_approval_reasons)
    {
        $this->gm_approval_reasons = $gm_approval_reasons;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProjectLeaderId()
    {
        return $this->project_leader_id;
    }

    /**
     * @param mixed $project_leader_id
     * @return CMSForm
     */
    public function setProjectLeaderId($project_leader_id)
    {
        $this->project_leader_id = $project_leader_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProjectLeaderAcceptance()
    {
        return $this->project_leader_acceptance;
    }

    /**
     * @param mixed $project_leader_acceptance
     * @return CMSForm
     */
    public function setProjectLeaderAcceptance($project_leader_acceptance)
    {
        $this->project_leader_acceptance = $project_leader_acceptance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProjectLeaderComment()
    {
        return $this->project_leader_comment;
    }

    /**
     * @param mixed $project_leader_comment
     * @return CMSForm
     */
    public function setProjectLeaderComment($project_leader_comment)
    {
        $this->project_leader_comment = $project_leader_comment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProjectLeaderCloseChange()
    {
        return $this->project_leader_close_change;
    }

    /**
     * @param mixed $project_leader_close_change
     * @return CMSForm
     */
    public function setProjectLeaderCloseChange($project_leader_close_change)
    {
        $this->project_leader_close_change = $project_leader_close_change;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHodAuthorization()
    {
        return $this->hod_authorization;
    }

    /**
     * @param mixed $hod_authorization
     * @return CMSForm
     */
    public function setHodAuthorization($hod_authorization)
    {
        $this->hod_authorization = $hod_authorization;
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
     * @return CMSForm
     */
    public function setCmsFormId($cms_form_id)
    {
        $this->cms_form_id = $cms_form_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOriginatorId()
    {
        return $this->originator_id;
    }

    /**
     * @param mixed $originator_id
     * @return CMSForm
     */
    public function setOriginatorId($originator_id)
    {
        $this->originator_id = $originator_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGmId()
    {
        return $this->gm_id;
    }

    /**
     * @param mixed $gm_id
     * @return CMSForm
     */
    public function setGmId($gm_id)
    {
        $this->gm_id = $gm_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateRaised()
    {
        return $this->date_raised;
    }

    /**
     * @param mixed $date_raised
     * @return CMSForm
     */
    public function setDateRaised($date_raised)
    {
        $this->date_raised = $date_raised;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChangeType()
    {
        return $this->change_type;
    }

    /**
     * @param mixed $change_type
     * @return CMSForm
     */
    public function setChangeType($change_type)
    {
        $this->change_type = $change_type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChangeDescription()
    {
        return $this->change_description;
    }

    /**
     * @param mixed $change_description
     * @return CMSForm
     */
    public function setChangeDescription($change_description)
    {
        $this->change_description = $change_description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdvantages()
    {
        return $this->advantages;
    }

    /**
     * @param mixed $advantages
     * @return CMSForm
     */
    public function setAdvantages($advantages)
    {
        $this->advantages = $advantages;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlternatives()
    {
        return $this->alternatives;
    }

    /**
     * @param mixed $alternatives
     * @return CMSForm
     */
    public function setAlternatives($alternatives)
    {
        $this->alternatives = $alternatives;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAreaAffected()
    {
        return $this->area_affected;
    }

    /**
     * @param mixed $area_affected
     * @return CMSForm
     */
    public function setAreaAffected($area_affected)
    {
        $this->area_affected = $area_affected;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHodId()
    {
        return $this->hod_id;
    }

    /**
     * @param mixed $hod_id
     * @return CMSForm
     */
    public function setHodId($hod_id)
    {
        $this->hod_id = $hod_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHodApproval()
    {
        return $this->hod_approval;
    }

    /**
     * @param mixed $hod_approval
     * @return CMSForm
     */
    public function setHodApproval($hod_approval)
    {
        $this->hod_approval = $hod_approval;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHodRefNum()
    {
        return $this->hod_ref_num;
    }

    /**
     * @param mixed $hod_ref_num
     * @return CMSForm
     */
    public function setHodRefNum($hod_ref_num)
    {
        $this->hod_ref_num = $hod_ref_num;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHodReasons()
    {
        return $this->hod_reasons;
    }

    /**
     * @param mixed $hod_reasons
     * @return CMSForm
     */
    public function setHodReasons($hod_reasons)
    {
        $this->hod_reasons = $hod_reasons;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGmApproval()
    {
        return $this->gm_approval;
    }

    /**
     * @param mixed $gm_approval
     * @return CMSForm
     */
    public function setGmApproval($gm_approval)
    {
        $this->gm_approval = $gm_approval;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGmReasons()
    {
        return $this->gm_reasons;
    }

    /**
     * @param mixed $gm_reasons
     * @return CMSForm
     */
    public function setGmReasons($gm_reasons)
    {
        $this->gm_reasons = $gm_reasons;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHodCloseChange()
    {
        return $this->hod_close_change;
    }

    /**
     * @param mixed $hod_close_change
     * @return CMSForm
     */
    public function setHodCloseChange($hod_close_change)
    {
        $this->hod_close_change = $hod_close_change;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOriginatorCloseChange()
    {
        return $this->originator_close_change;
    }

    /**
     * @param mixed $originator_close_change
     * @return CMSForm
     */
    public function setOriginatorCloseChange($originator_close_change)
    {
        $this->originator_close_change = $originator_close_change;
        return $this;
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
     * @return CMSForm
     */
    public function setDepartmentId($department_id)
    {
        $this->department_id = $department_id;
        return $this;
    }

    /**
     * @return CMSFormModel
     */
    public function getCmsFormModel(): CMSFormModel
    {
        return $this->cms_form_model;
    }

    /**
     * @param CMSFormModel $cms_form_model
     * @return CMSForm
     */
    public function setCmsFormModel(CMSFormModel $cms_form_model): CMSForm
    {
        $this->cms_form_model = $cms_form_model;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCmsForm()
    {
        return $this->cms_form;
    }

    /**
     * @param mixed $cms_form
     * @return CMSForm
     */
    public function setCmsForm($cms_form)
    {
        $this->cms_form = $cms_form;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOtherType()
    {
        return $this->other_type;
    }

    /**
     * @param mixed $other_type
     * @return CMSForm
     */
    public function setOtherType($other_type)
    {
        $this->other_type = $other_type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCertifyDetails()
    {
        return $this->certify_details;
    }

    /**
     * @param mixed $certify_details
     * @return CMSForm
     */
    public function setCertifyDetails($certify_details)
    {
        $this->certify_details = $certify_details;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNextAction()
    {
        return $this->next_action;
    }

    /**
     * @param mixed $next_action
     * @return CMSForm
     */
    public function setNextAction($next_action)
    {
        $this->next_action = $next_action;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBudgetLevel()
    {
        return $this->budget_level;
    }

    /**
     * @param mixed $budget_level
     * @return CMSForm
     */
    public function setBudgetLevel($budget_level)
    {
        $this->budget_level = $budget_level;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRiskLevel()
    {
        return $this->risk_level;
    }

    /**
     * @param mixed $risk_level
     * @return CMSForm
     */
    public function setRiskLevel($risk_level)
    {
        $this->risk_level = $risk_level;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdditionalInfo()
    {
        return $this->additional_info;
    }

    /**
     * @param mixed $additional_info
     * @return CMSForm
     */
    public function setAdditionalInfo($additional_info)
    {
        $this->additional_info = $additional_info;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAffectedDept()
    {
        return $this->affected_dept;
    }

    /**
     * @param mixed $affected_dept
     * @return CMSForm
     */
    public function setAffectedDept($affected_dept)
    {
        $this->affected_dept = $affected_dept;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHodApprovalDate()
    {
        return $this->hod_approval_date;
    }

    /**
     * @param mixed $hod_approval_date
     * @return CMSForm
     */
    public function setHodApprovalDate($hod_approval_date)
    {
        $this->hod_approval_date = $hod_approval_date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSectionCompleted()
    {
        return $this->section_completed;
    }

    /**
     * @param mixed $section_completed
     * @return CMSForm
     */
    public function setSectionCompleted($section_completed)
    {
        $this->section_completed = $section_completed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailSubject()
    {
        return $this->email_subject;
    }

    /**
     * @param mixed $email_subject
     * @return CMSForm
     */
    public function setEmailSubject($email_subject)
    {
        $this->email_subject = $email_subject;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRiskAttachment()
    {
        return $this->risk_attachment;
    }

    /**
     * @param mixed $risk_attachment
     * @return CMSForm
     */
    public function setRiskAttachment($risk_attachment)
    {
        $this->risk_attachment = $risk_attachment;
        return $this;
    }

    public function jsonSerialize()
    {
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
            'gm_approval_reasons' => $this->gm_reasons,
            'hod_authorization' => $this->hod_authorization,
            'hod_authorization_comment' => $this->getHodAuthorizationComment(),
            'project_leader_id' => $this->project_leader_id,
            'project_leader_acceptance' => $this->project_leader_acceptance,
            'hod_close_change' => $this->hod_close_change,
            'originator_close_change' => $this->originator_close_change,
            'project_leader_close_change' => $this->project_leader_close_change,
            'next_action' => $this->next_action,
            'budget_level' => $this->budget_level,
            'risk_level' => $this->risk_level,
            'additional_info' => $this->additional_info,
            'hod_reasons' => $this->hod_reasons,
            'affected_dept' => $this->affected_dept,
            'hod_approval_date' => $this->hod_approval_date,
            'section_completed' => $this->section_completed,
            'email_subject' => $this->email_subject,
            'risk_attachment' => $this->risk_attachment,
            'gm_id' => $this->gm_id,
            'state' => $this->getState()
        ];
    }

    /**
     * @return mixed
     */
    public function getHodAuthorizationComment()
    {
        return $this->hod_authorization_comment;
    }

    /**
     * @param mixed $hod_authorization_comment
     * @return CMSForm
     */
    public function setHodAuthorizationComment($hod_authorization_comment)
    {
        $this->hod_authorization_comment = $hod_authorization_comment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     * @return CMSForm
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }
}
