<div class="col-sm-12 border">
    <div class="pl-3 pt-1">
        <h6 class="text-bold font-italic" title="Click on your department's name below and respond by selecting 'Yes' or 'No'.
HoDs should add their comments under their respective departments.">
            <a href="#poss_imp" data-toggle="collapse">
                <i class="fa <?php echo ICON_FA_MINUS; ?>"></i> Impact Assessment
            </a>
        </h6>
        <div class="w-100  section collapse show p-2 mb-3 table-active" id="poss_imp">
            <?php /** @var array $payload */
            $department_count = count($payload['affected_departments']);
            foreach ($payload['affected_departments'] as $department) {
                $can_assess_impact_for_dept = canAssessImpactForDept($department->department_id);
                $questions = getImpactQuestions($department->department_id);
                $impact_ass_status = new ImpactAssStatusModel(['department_id' => $department->department_id, 'cms_form_id' => $payload['form']->cms_form_id]);
                $user = getUserSession();
                if (!empty($questions)) { ?>
                    <div>
                        <h6 class="text-bold font-italic">
                            <a href="#<?php echo strtolower($department->department); ?>" data-toggle="collapse">
                                <i class="fa <?php echo ICON_FA_PLUS ?>"></i> &nbsp;
                                <span style='<?php if ($user->department_id == $department->department_id) { ?>
                                        color: green!important;
                                <?php } ?>'><?php echo $department->department; ?></span>
                                <?php
                                if ($impact_ass_status->status === STATUS_IMPACT_ASSESSMENT_RESPONSE_PENDING) {
                                    echo echoInComplete();
                                } elseif ($impact_ass_status->status === STATUS_IMPACT_ASSESSMENT_COMPLETED) {
                                    echo '<span class="">';
                                    echo echoCompleted();
                                    echo '</span>';
                                }
                                ?>
                            </a>
                        </h6>
                        <div class="w-100 section collapse" id="<?php echo strtolower($department->department); ?>"
                             data-parent="#poss_imp">
                            <form action="<?php echo site_url("cms-forms/impact-response/") . $payload['form']->cms_form_id . '/' . $department->department_id; ?>"
                                  method="post" role="form">
                                <fieldset>
                                    <table class="table table-bordered table-user-information font-raleway table-striped mb-0">
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
                                                    if ($impact_ass_status->getStatus() === STATUS_IMPACT_ASSESSMENT_RESPONSE_PENDING && $can_assess_impact_for_dept) { ?>
                                                        <label class="w-100">
                                                            <input type="radio" class="form-check m-auto cursor-pointer"
                                                                   name="question_<?php echo $resp->cms_impact_response_id ?>" <?php echo $resp->response === 'Yes' ? 'checked' : ''; ?>
                                                                   value="Yes" required/>
                                                        </label>
                                                    <?php } else {
                                                        echo $resp->response === 'Yes' ? '<i class="fa fa-check"></i>' : '';
                                                    } ?>
                                                    <small class="help-block-with-errors"></small>
                                                </td>
                                                <td scope="row"
                                                    class="text-center <?php echo (!$can_assess_impact_for_dept && empty($resp->response)) ? 'not-allowed' : '' ?>">
                                                    <?php
                                                    if ($impact_ass_status->getStatus() === STATUS_IMPACT_ASSESSMENT_RESPONSE_PENDING && $can_assess_impact_for_dept) { ?>
                                                        <label class="w-100">
                                                            <input type="radio" class="form-check m-auto cursor-pointer"
                                                                   name="question_<?php echo $resp->cms_impact_response_id ?>"
                                                                   value="No" <?php echo $resp->response === 'No' ? 'checked' : ''; ?>
                                                                   required/>
                                                        </label>
                                                    <?php } else {
                                                        echo $resp->response === 'No' ? '<span class=""><i class="fa fa-check"></i></span> ' : '';
                                                    } ?>
                                                    <small class="help-block-with-errors"></small>
                                                </td>
                                            </tr>
                                        <?php }
                                        ?>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </form>
                            <?php
                            if ($impact_ass_status->status === STATUS_IMPACT_ASSESSMENT_COMPLETED) { ?>
                                <div class="d-sm-block d-none">
                                    <table class="w-100 table-active table-bordered table font-raleway">
                                        <thead class="thead-default">
                                        </thead>
                                        <tbody>
                                        <tr class="">
                                            <td class="text-sm-right" style="width:17%"><b>Completed by:</b></td>
                                            <td style="width: 83%;"><?php echo getNameJobTitleAndDepartment($impact_ass_status->completed_by) ?></td>
                                        </tr>
                                        <tr class="">
                                            <td class="text-sm-right" style="width:17%"><b>Date:</b></td>
                                            <td style="width: 83%;"><?php echo returnDate($impact_ass_status->completed_date); ?></td>
                                        </tr>
                                        <tr class="">
                                            <td class="text-sm-right" style="width:17%"><b>Comment:</b></td>
                                            <td style="width: 83%;"><?php echo $impact_ass_status->hod_comment; ?></td>
                                        </tr>
                                        <!--<tr class="">
                                            <td class="text-sm-right" style="width:17%"><b>HoD:</b></td>
                                            <td style="width: 83%;"><?php /*echo concatNameWithUserId($impact_ass_status->getApprovedBy()) .
                                                    " - " . getJobTitle($impact_ass_status->getApprovedBy()) . " @ " .
                                                    getDepartment($impact_ass_status->getApprovedBy()); */ ?></td>
                                        </tr>-->
                                        <!--  <tr class="">
                                            <td class="text-sm-right" style="width:17%"><b>Commented on:</b></td>
                                            <td style="width: 83%;"><?php /*echo returnDate($impact_ass_status->getHodCommentDate()); */ ?></td>
                                        </tr>-->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-sm-none d-block">
                                    <table class="w-100 table-active table-bordered font-raleway table">
                                        <thead class="thead-default">
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="">
                                                <div class="col-sm-4 text-sm-right"><b>Completed by:</b></div>
                                                <div class="col-sm-8">
                                                    <?php echo getNameJobTitleAndDepartment($impact_ass_status->completed_by); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="">
                                                <div class="col-sm-4 text-sm-right"><b>Date:</b></div>
                                                <div class="col-sm-8">
                                                    <?php echo returnDate($impact_ass_status->completed_date); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="">
                                                <div class="col-sm-4 text-sm-right"><b>Comment:</b></div>
                                                <div class="col-sm-8"><?php echo $impact_ass_status->hod_comment; ?></div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="d-sm-block d-none">
                                    <table class="w-100 table-active table-bordered table font-raleway mb-0">
                                        <thead class="thead-default">
                                        </thead>
                                        <tbody>
                                        <tr class="">
                                            <td class="text-sm-right" style="width:17%"><b>Completed by:</b></td>
                                            <td
                                                    style="width: 83%;"><?php /*echo concatNameWithUserId($impact_ass_status->getCompletedBy()) .
                                                    " - " . getJobTitle($impact_ass_status->getCompletedBy()) . " @ " .
                                                    getDepartment($impact_ass_status->getCompletedBy());
                                                */ ?></td>
                                        </tr>
                                        <tr class="">
                                            <td class="text-sm-right" style="width:17%"><b>Completed on:</b></td>
                                            <td style="width: 83%;"><?php /*echo returnDate($impact_ass_status->getCompletedDate()); */ ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-sm-none d-block">
                                    <table class="w-100 table-active table-bordered font-raleway table mb-0">
                                        <thead class="thead-default">
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="">
                                                <div class="col-sm-4 text-sm-right"><b>Completed by:</b></div>
                                                <div class="col-sm-8">
                                                    <?php /*echo concatNameWithUserId($impact_ass_status->getCompletedBy()) .
                                                        " - " . getJobTitle($impact_ass_status->getCompletedBy()) . " @ " .
                                                        getDepartment($impact_ass_status->getCompletedBy());
                                                    */ ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="">
                                                <div class="col-sm-4 text-sm-right"><b>Completed on:</b></div>
                                                <div class="col-sm-8">
                                                    <?php /*echo returnDate($impact_ass_status->getCompletedDate()); */ ?>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>-->
                            <?php } ?>
                            <?php
                            if (($impact_ass_status->status === STATUS_IMPACT_ASSESSMENT_RESPONSE_PENDING) && $can_assess_impact_for_dept) { ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-row mb-2">
                                            <label class="col-sm-2 text-sm-right" for="hod_comment">
                                                HoD Comment
                                            </label>
                                            <div class="col-sm-10">
                                                    <textarea class="form-control" name="hod_comment"
                                                              id="hod_comment" placeholder="Write your comment here."
                                                              form="impact_assessment"
                                                              required></textarea>
                                                <small id="helpId" class="with-errors help-block"></small>
                                            </div>
                                        </div>
                                        <div class="form-group form-row mb-0">
                                            <label class="invisible col-sm-2"></label>
                                            <div class="col-sm-10">
                                                <div class="form-group form-row mb-0">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="certify_details"
                                                                   form="impact_assessment" required>
                                                            <small class="text-bold">I hereby certify that the
                                                                information
                                                                provided above is true, complete and accurate.
                                                            </small>
                                                        </label>
                                                        <small id="helpId" class="with-errors help-block"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <label class="invisible col-sm-2"></label>
                                            <div class="col-sm-10 text-sm-right">
                                                <a href="javascript: window.history.back();"
                                                   class="btn bg-danger w3-btn d-none">Cancel</a>
                                                <button type="submit" form="impact_assessment"
                                                        class="btn bg-success w3-btn">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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

