<?php /** @var  array $payload */
if (!sectionCompleted($payload['form']->cms_form_id, SECTION_RISK_ASSESSMENT)) {
    if (isDepartmentManager(getUserSession()->user_id, getOriginatorDepartmentID($payload['form']->cms_form_id)) && sectionCompleted($payload['form']->cms_form_id, SECTION_HOD_ASSESSMENT)) {
        ?>
        <div class="row p-2">
            <form class="w-100"
                  action="<?php echo URL_ROOT . '/cms-forms/risk-assessment/' . $payload['form']->cms_form_id ?>"
                  method="post" data-toggle="validator" role="form" enctype="multipart/form-data">
                <fieldset class="w-100">
                    <div class="row w-100 border ml-0 p-1">
                        <h6 class="text-bold font-italic col m-1">
                            <a href="#section_3" data-toggle="collapse">
                                <i class="fa <?php echo ICON_FA_MINUS ?>"></i> Section 3 - Risk Assessment
                                <br/>
                                <span class="text-muted">
                                        <small>
                                            Consider geographical location, processes,
                                            materials, equipment, machinery, costs, tasks, people, etc. Risk assessment
                                            to be conducted in terms of <a href="#"
                                                                           title="Click here to read the Risk Assessment Procedure."> <u
                                                        class="text-danger ">HSMP 2.01 PR - Health and Safety Identification
                                            and Risk Assessment Procedure</u>.</a> <br><b>PS: Attach risk assessment document to this form. </b>
                                        </small>
                                    </span>
                            </a>
                        </h6>
                        <span class="text-right float-right invisible">
                                <?php if (isOriginator($payload['form']->cms_form_id, getUserSession()->user_id)) {
                                    ?>
                                    <a href="#" title="Edit this section">
                                    <i class="fa fa-edit"></i>
                                </a>
                                    <?php
                                } ?>
                            </span>
                    </div>
                    <div id="section_3" class="collapse show section p-3 border">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-row">
                                    <label for="" class="col-sm-12">
                                        Risk Assessment Document
                                        <small class="d-sm-inline d-block">(Attach Risk Assessment Document)</small>
                                    </label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="file" name="risk_attachment"
                                               aria-describedby="helpId"
                                               accept="<?php echo DOC_FILE_TYPES; ?>" required/>
                                        <small class="form-text with-errors help-block"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-row">
                                    <label for="s1" class="col-sm-12">Affected Departments</label>
                                    <div class="col-sm-8">
                                        <select class="replace-multiple-select form-control" id="s1">
                                            <option></option>
                                        </select>
                                        <select class="form-control bs-select multiple-hidden d-none"
                                                id="s1"
                                                name="affected_dept[]"
                                                aria-describedby="helpId"
                                                data-none-selected-text="Select Affected Departments"
                                                data-actions-box="true"
                                                data-size="7"
                                                multiple="multiple" required>
                                            <?php

                                            foreach ($payload['departments'] as $dept) {
                                                echo "<option value='$dept->department_id'> $dept->department </option>";
                                            }
                                            ?>
                                        </select>
                                        <small class="with-errors help-block"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 text-right mt-2">
                                <label></label>
                                <button type="submit" class="btn bg-success w3-btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <?php
    } else {
        alert('Risk Assessment Pending...', 'alert text-primary text-bold');
    }
} else {
    if (!empty($payload['form']->affected_dept)) { ?>
        <div class="row p-2">
            <div class="w-100">
                <div class="row w-100 border ml-0 p-1">
                    <h6 class="text-bold font-italic col m-1">
                        <a href="#section_3" data-toggle="collapse">
                            <i class="fa <?php echo ICON_FA_PLUS ?>"></i> Section 3 - Risk Assessment
                            <?php echo isAllImpactAssessmentComplete($payload['form']->cms_form_id) ? echoCompleted() : echoInComplete(); ?>
                        </a>
                        <?php if (isAllImpactAssessmentComplete($payload['form']->cms_form_id) && !empty($payload['form']->risk_attachment)) {
                            ?>
                            <span class="mx-2"></span>
                            <a
                                    href="<?php echo URL_ROOT . '/cms-forms/download-risk-attachment/' . $payload['form']->cms_form_id; ?>"
                                    target="_blank"
                                    title="Download Attached Risk Assessment"
                                    class="">
                                <span class="text-sm badge badge-success"> <i class="fa fa-file-download"></i> Download</span>
                            </a>
                            <?php
                        } ?>
                    </h6>
                    <span class="text-right float-right d-none">
                            <?php if (!empty($payload['form']->risk_attachment)) {
                                ?>
                                <a href="<?php echo URL_ROOT . '/cms-forms/download-risk-attachment/' . $payload['form']->cms_form_id; ?>"
                                   target="_blank"
                                   title="Download Attached Risk Assessment"
                                   class=""><i class="fa fa-file-download"></i>
                                </a>
                                <?php
                            } ?>
                        </span>
                    <span class="text-right float-right invisible">
                            <?php if (isOriginator($payload['form']->cms_form_id, getUserSession()->user_id)) {
                                ?>
                                <a href="#" title="Edit this section">
                                <i class="fa fa-edit"></i>
                            </a>
                                <?php
                            } ?>
                        </span>
                </div>
                <div id="section_3" class="w-100 collapse section">
                    <div class="d-sm-none d-block">
                        <table class="table table-bordered table-user-information font-raleway mb-0 table-active table-striped">
                            <thead class="thead-default d-none">
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="" colspan="2">
                                        <span class="col-sm-4 text-sm-right">
                                            <b>Affected Departments: </b>
                                        </span>
                                    <span class="col-sm-8">
                                            <?php
                                            $dep = [];
                                            foreach (getAffectedDepartments($payload['form']->cms_form_id) as $value) {
                                                $dep[] = $value->department;
                                            }
                                            if (count($dep) > 0) {
                                                echo concatWith(', ', '& ', $dep);
                                            } ?>
                                        </span>
                                </td>
                            </tr>
                            <?php
                            if (!empty($payload['form']->risk_attachment)) { ?>
                                <tr class="d-none">
                                    <td scope="row">
                                        <span class="row">
                                            <span class="col-sm-2 text-sm-right">
                                                <b>Risk Assessment: </b>
                                            </span>
                                        <span class="col-sm-8">
                                                <a href="<?php echo URL_ROOT . '/cms-forms/download-risk-attachment/' . $payload['form']->cms_form_id; ?>"
                                                   target="_blank"
                                                   title="Download Attached Risk Assessment"
                                                   class="btn btn-primary btn-sm">Download</a>
                                            <small class="text-muted"><i>(Download the risk assessment document attached to this form)</i></small>
                                            </span>
                                        </span>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-sm-block d-none">
                        <table class="table table-bordered table-user-information font-raleway mb-0 table-striped table-active">
                            <thead class="thead-default d-none">
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-right" scope="row" style="width:17%">
                                    <b>Affected Departments: </b>
                                </td>
                                <td style="width:83%">
                                    <?php
                                    $dep = [];
                                    foreach (getAffectedDepartments($payload['form']->cms_form_id) as $value) {
                                        $dep[] = $value->department;
                                    }
                                    if (count($dep) > 0) {
                                        echo concatWith(', ', '& ', $dep);
                                    } ?>
                                </td>
                            </tr>
                            <?php
                            if (!empty($payload['form']->risk_attachment)) { ?>
                                <tr class="d-none">
                                    <td scope="row">
                                        <span class="row">
                                            <span class="col-sm-2 text-sm-right">
                                                <b>Risk Assessment: </b>
                                            </span>
                                        <span class="col-sm-8">
                                                <a href="<?php echo URL_ROOT . '/cms-forms/download-risk-attachment/' . $payload['form']->cms_form_id; ?>"
                                                   target="_blank"
                                                   title="Download Attached Risk Assessment"
                                                   class="btn btn-primary btn-sm">Download</a>
                                            <small class="text-muted"><i>(Download the risk assessment document attached to this form)</i></small>
                                            </span>
                                        </span>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php require_once APP_ROOT . "/views/cms_forms/sections/section_possible_impact.php"; ?>
                </div>
            </div>
        </div>
    <?php }
}
?>
