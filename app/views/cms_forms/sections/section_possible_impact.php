<div class="col-sm-12">
    <div class="pl-2">
        <h6 class="text-bold font-italic">
            <a href="#poss_imp" data-toggle="collapse">
                <i class="fa fa-minus"></i> Possible Impacts
            </a>
        </h6>
        <div class="w-100 accordion section collapse show p-2" id="poss_imp">
            <?php /** @var array $payload */
            foreach ($payload['affected_departments'] as $department) {
                $can_assess_impact_for_dept = canAssessImpactForDept($department->department_id);
                $questions = getImpactQuestions($department->department_id);
                // $responses = getImpactResponsesForDepartment($payload['form']->cms_form_id, $department->department_id);
                if (!empty($questions)) { ?>
                    <div>
                <h6 class="text-bold font-italic">
                    <a href="#<?php echo strtolower($department->department); ?>" data-toggle="collapse">
                        <i class="fa fa-plus"></i> &nbsp; <?php echo $department->department; ?>
                    </a>
                </h6>
                        <div class="w-100 section collapse" id="<?php echo strtolower($department->department); ?>"
                             data-parent="#poss_imp">
                            <form action="<?php echo URL_ROOT . '/cms-forms/Impact-Response/' . $payload['form']->cms_form_id; ?>"
                                  method="post" role="form">
                                <fieldset <?php echo !$can_assess_impact_for_dept ? 'disabled="disabled"' : ''; ?>>
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
                                                <td scope="row text-center">
                                                    <label class="w-100">
                                                        <input type="radio" class="form-check m-auto cursor-pointer"
                                                               name="question_<?php echo $resp->cms_impact_response_id ?>" <?php echo $resp->response === 'Yes' ? 'checked' : ''; ?>
                                                               value="Yes" required/>
                                                    </label>
                                                    <small class="help-block-with-errors"></small>
                                                </td>
                                                <td scope="row text-center">
                                                    <label class="w-100">
                                                        <input type="radio" class="form-check m-auto cursor-pointer"
                                                               name="question_<?php echo $resp->cms_impact_response_id ?>"
                                                               value="No" <?php echo $resp->response === 'No' ? 'checked' : ''; ?>
                                                               required/>
                                                    </label>
                                                    <small class="help-block-with-errors"></small>
                                                </td>
                                            </tr>

                                        <?php }
                                        if ($can_assess_impact_for_dept) { ?>
                                            <tr>
                                                <td colspan="3">
                                                    <button type="submit" class="btn btn-success float-right">Submit
                                                    </button>
                                                </td>
                                            </tr><?php } ?>

                                        </tbody>
                                    </table>
                                </fieldset>
                            </form>
                        </div>
                        <div class="dropdown-divider"></div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</div>

