<div class="col-sm-12 border">
    <div class="pl-3 pt-1">
        <h6 class="text-bold font-italic">
            <a href="#poss_imp" data-toggle="collapse">
                <i class="fa fa-minus"></i> Impact Assessment
                <i class="text-muted">
                    (Select your department and respond by selecting 'Yes' or 'No')
                </i>
            </a>
        </h6>
        <div class="w-100  section collapse show p-2" id="poss_imp">
            <?php /** @var array $payload */
            $department_count = count($payload['affected_departments']);
            foreach ($payload['affected_departments'] as $department) {

                $can_assess_impact_for_dept = canAssessImpactForDept($department->department_id);
                $questions = getImpactQuestions($department->department_id);
                $action_impact_assessment_completed = getActionLog($payload['form']->cms_form_id, ACTION_IMPACT_ASSESSMENT_COMPLETED, ['department_affected' => $department->department_id], true);
                $action_hod_commented = getActionLog($payload['form']->cms_form_id, ACTION_IMPACT_ASSESSMENT_HOD_COMMENTED, ['department_affected' => $department->department_id], true);
                $impact_ass_status = new ImpactAssStatusModel(['department_id' => $department->department_id, 'cms_form_id' => $payload['form']->cms_form_id]);
                $performed_by = null;
                $hod = '';
                if (!empty($action_impact_assessment_completed)) {
                    $performed_by = new User($action_impact_assessment_completed->performed_by);
                }
                if (!empty($action_hod_commented)) {
                    $hod = new User($action_hod_commented->performed_by);
                }
                // $responses = getImpactResponsesForDepartment($payload['form']->cms_form_id, $department->department_id);
                if (!empty($questions)) { ?>
                    <div>
                        <h6 class="text-bold font-italic">
                            <a href="#<?php echo strtolower($department->department); ?>" data-toggle="collapse">
                                <i class="fa fa-plus"></i> &nbsp; <?php echo $department->department; ?>

                                <?php
                                if ($impact_ass_status->getStatus() == STATUS_IMPACT_ASSESSMENT_RESPONSE_PENDING) { ?>
                                    <span class="text-muted"> <i>( Response pending... )</i></span>
                                    <?php
                                } elseif ($impact_ass_status->getStatus() == STATUS_IMPACT_ASSESSMENT_HOD_COMMENT_PENDING) {
                                    echo "<span class='ml-2 text-danger small text-bold'> HoD Comment Pending...</span>";
                                } elseif ($impact_ass_status->getStatus() == STATUS_IMPACT_ASSESSMENT_COMPLETED) {
                                    echoCompleted($action_impact_assessment_completed->date, $performed_by->user_id);
                                }
                                ?>
                            </a>
                        </h6>
                        <div class="w-100 section collapse" id="<?php echo strtolower($department->department); ?>"
                             data-parent="#poss_imp">
                            <form action="<?php echo URL_ROOT . '/cms-forms/Impact-Response/' . $payload['form']->cms_form_id . '/' . $department->department_id; ?>"
                                  method="post" role="form">
                                <fieldset <?php //echo !$can_assess_impact_for_dept ? 'disabled="disabled"' : ''; ?>>
                                    <table class="table table-bordered table-user-information font-raleway">
                                        <thead class="thead-default">
                                        <tr>
                                            <th>Will this change:</th>
                                            <th class="text-center">Yes</th>
                                            <th class="text-center">No</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($questions as $ques) {
                                            $resp = getResponseForQuestion($ques->cms_impact_question_id, $payload['form']->cms_form_id); ?>
                                            <tr>
                                                <td scope="row">
                                            <span>
                                                <?php echo $ques->question; ?>
                                            </span>
                                                </td>
                                                <td scope="row"
                                                    class="text-center <?php echo (!$can_assess_impact_for_dept) ? 'not-allowed' : '' ?>"
                                                    data-department="<?php echo $department->department ?>">
                                                    <?php
                                                    if ($impact_ass_status->getStatus() === STATUS_IMPACT_ASSESSMENT_COMPLETED || !$can_assess_impact_for_dept) {
                                                        echo $resp->response === 'Yes' ? '<i class="fa fa-check"></i>' : '';
                                                    } else {
                                                        ?>
                                                        <label class="w-100">
                                                            <input type="radio" class="form-check m-auto cursor-pointer"
                                                                   name="question_<?php echo $resp->cms_impact_response_id ?>" <?php echo $resp->response === 'Yes' ? 'checked' : ''; ?>
                                                                   value="Yes" required/>
                                                        </label>
                                                    <?php } ?>
                                                    <small class="help-block-with-errors"></small>
                                                </td>
                                                <td scope="row"
                                                    class="text-center <?php echo (!$can_assess_impact_for_dept && empty($resp->response)) ? 'not-allowed' : '' ?>">
                                                    <?php
                                                    if ($impact_ass_status->getStatus() === STATUS_IMPACT_ASSESSMENT_COMPLETED || !$can_assess_impact_for_dept) {
                                                        echo $resp->response === 'No' ? '<span class=""><i class="fa fa-check"></i></span> ' : '';
                                                    } else {
                                                        ?>
                                                        <label class="w-100">
                                                            <input type="radio" class="form-check m-auto cursor-pointer"
                                                                   name="question_<?php echo $resp->cms_impact_response_id ?>"
                                                                   value="No" <?php echo $resp->response === 'No' ? 'checked' : ''; ?>
                                                                   required/>
                                                        </label>
                                                    <?php } ?>
                                                    <small class="help-block-with-errors"></small>
                                                </td>
                                            </tr>
                                        <?php }
                                        ?>
                                        </tbody>
                                    </table>
                                    <?php
                                    if ($can_assess_impact_for_dept && $impact_ass_status->getStatus() === STATUS_IMPACT_ASSESSMENT_RESPONSE_PENDING) {
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group form-row">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="certify_details" required>
                                                            <small class="text-bold">I hereby certify that the
                                                                information I
                                                                have provided above is true, complete and accurate.
                                                            </small>
                                                        </label>
                                                        <small id="helpId" class="with-errors help-block"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 text-right">
                                                <div>
                                                    <a href="javascript: window.history.back();"
                                                       class="btn bg-danger w3-btn d-none">Cancel</a>
                                                    <button type="submit" class="btn bg-success w3-btn">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </fieldset>
                            </form>
                            <?php
                            if ($impact_ass_status->getStatus() == STATUS_IMPACT_ASSESSMENT_COMPLETED && empty($action_hod_commented)
                                && isDepartmentManager(getUserSession()->user_id, $department->department_id)) { ?>
                                <form method="post"
                                      action="<?php echo URL_ROOT . '/cms-forms/hod-comment/' . $payload['form']->cms_form_id . '/' . $department->department_id; ?>"
                                      role="form">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label class="col-sm-4" for="hod_comment">
                                                    HoD Comment
                                                </label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" name="hod_comment"
                                                              id="hod_comment"></textarea>
                                                </div>
                                                <small id="helpId" class="with-errors help-block"></small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="certify_details" required>
                                                        <small class="text-bold">I hereby certify that the
                                                            information
                                                            provided above is true, complete and accurate.
                                                        </small>
                                                    </label>
                                                    <small id="helpId" class="with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <div>
                                                <a href="javascript: window.history.back();"
                                                   class="btn bg-danger w3-btn d-none">Cancel</a>
                                                <button type="submit" class="btn bg-success w3-btn">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php } else {
                                if (!empty($action_hod_commented)) { ?>
                                    <div class="d-sm-block d-none">
                                        <table>
                                            <thead class="thead-default">
                                            </thead>
                                            <tbody>
                                            <tr class="row">
                                                <td style="width:17%"><b>HoD's comment:</b></td>
                                                <td style="width: 83%;"><?php $impact_ass_status->getHodComment(); ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-sm-none d-block">
                                        <table>
                                            <thead class="thead-default">
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm-4 text-right"><b>HoD's comment:</b></div>
                                                        <div class="col-sm-8"><?php $impact_ass_status->getHodComment(); ?></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php }
                            }
                            ?>
                        </div>
                        <?php
                        $department_count--;
                        if ($department_count > 0) {
                            echo '<div class="dropdown-divider"></div>';
                        }
                        ?>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</div>

