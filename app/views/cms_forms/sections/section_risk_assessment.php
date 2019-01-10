<?php /** @var  array $payload */
if (sectionCompleted($payload['form']->cms_form_id, SECTION_HOD_ASSESSMENT)) {
    if (!sectionCompleted($payload['form']->cms_form_id, SECTION_RISK_ASSESSMENT)) {
        if (isOriginator($payload['form']->cms_form_id, getUserSession()->user_id)) { ?>
            <div class="row p-2">
                <form action="<?php echo URL_ROOT . '/cms-forms/risk-assessment/' . $payload['form']->cms_form_id ?>"
                      method="post" data-toggle="validator" role="form" enctype="multipart/form-data">
                    <fieldset class="w-100">
            <span class="row w-100 border ml-0 p-1">
                <h6 class="text-bold font-italic col m-1">
                    <a href="#section_3" data-toggle="collapse">
                        <i class="fa fa-minus" data-id></i> Section 3 - Risk Assessment
                        <br/>
                        <span class="text-muted">
                            <small>
                                (Consider geographical location, processess,
                                materials, equipment, machinery, costs, tasks, people, etc. Risk assessment
                                to be conducted in terms of HSMP 2.01 PR - Health and Safety Identification
                                and Risk Assessment Procedure. Attach risk assessment to this form)
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
            </span>
                        <div id="section_3" class="collapse show section p-3">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group form-row">
                                        <label for="" class="col-sm-12">
                                            Risk Assessment Document
                                            <small class="d-sm-inline d-block">(Upload Risk Assessment Document)</small>
                                        </label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="file" name="risk_attachment"
                                                   aria-describedby="helpId"
                                                   accept="<?php echo DOC_FILE_TYPES; ?>"/>
                                            <small id="helpId" class="form-text with-errors"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-row">
                                        <label for="" class="col-sm-12">Affected Departments</label>
                                        <div class="col-sm-8">
                                            <select class="replace-multiple-select form-control">
                                                <option></option>
                                            </select>
                                            <select class="form-control bs-select multiple-hidden d-none"
                                                    name="affected_dept[]"
                                                    aria-describedby="helpId"
                                                    data-none-selected-text="Select Affected Departments"
                                                    multiple="multiple">
                                                <option class="d-none"></option>
                                                <?php

                                                foreach ($payload['departments'] as $dept) {
                                                    echo "<option value='$dept->department_id'> $dept->department </option>";
                                                }
                                                ?>
                                            </select>

                                            <small id="helpId" class="form-text with-errors"></small>
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
        <?php } else {
            alert('Risk Assessment Pending...', 'alert text-primary text-bold');
        }
    } else {
        if (!empty($payload['form']->affected_dept)) { ?>
            <div class="row p-2">
                <div class="w-100">
        <span class="row w-100 border ml-0 p-1">
            <h6 class="text-bold font-italic col m-1">
                <a href="#section_3" data-toggle="collapse">
                    <i class="fa fa-minus" data-id></i> Section 3 - Risk Assessment
                    <br/>
                    <span class="text-muted">
                        <small>
                            (Consider geographical location, processess,
                            materials, equipment, machinery, costs, tasks, people, etc. Risk assessment
                            to be conducted in terms of HSMP 2.01 PR - Health and Safety Identification
                            and Risk Assessment Procedure. Attach risk assessment to this form)
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
        </span>
                    <div id="section_3" class="w-100 collapse show section p-2">
                        <table class="table table-bordered table-user-information font-raleway">
                            <thead class="thead-default d-none">
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($payload['form']->risk_attachment)) { ?>
                                <tr>
                                    <td scope="row" colspan="2">
                            <span class="row">
                                <span class="col-sm-4 text-sm-right">
                                    <b>Risk Assessment</b>
                                </span>
                            <span class="col-sm-8 mb-2">
                                    <a href="<?php echo URL_ROOT . '/cms-forms/download-risk-attachment/' . $payload['form']->cms_form_id; ?>"
                                       class="btn btn-primary">Download Attachment</a>
                                </span>
                            </span>
                                    </td>
                                </tr>

                            <?php }
                            ?>
                            <tr>
                                <td scope="row" colspan="2">
                            <span class="row">
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
                            </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php }
    }
}

?>
