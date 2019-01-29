<?php /** @var  array $payload */
if (!sectionCompleted($payload['form']->cms_form_id, SECTION_HOD_ASSESSMENT)) {
    if (isHOD($payload['form']->cms_form_id, getUserSession()->user_id) && sectionCompleted($payload['form']->cms_form_id, SECTION_START_CHANGE_PROCESS)) { ?>
        <div class="row p-2">
            <form class="w-100"
                  action="<?php echo URL_ROOT . '/cms-forms/hod-assessment/' . $payload['form']->cms_form_id ?>"
                  method="post" data-toggle="validator" role="form"
                  enctype="multipart/form-data" id="hod_assessment_form">
                <fieldset class="w-100">
                    <div class="w-100 row border ml-0 p-1">
                        <h6 class="text-bold font-italic col m-1">
                            <a href="#section_2" data-toggle="collapse">
                                <i class="fa <?php echo ICON_FA_MINUS ?>"></i> Section 2 - HoD's Approval
                                <span class="small animated incomplete text-dark font-italic">
                                    [To be Completed by HoD]
                                </span>
                            </a>
                        </h6>
                        <span class="text-right float-right invisible"><?php if (isHod($payload['form']->cms_form_id, getUserSession()->user_id)) { ?>
                                <a href="#" title="Edit this section">
                        <i class="fa fa-edit"></i>
                    </a><?php } ?>
                </span>
                    </div>
                    <div id="section_2" class="collapse show section border p-3 table-active">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hod_approval" id="approved"
                                           value="<?php echo STATUS_APPROVED ?>" required/>
                                    <label class="form-check-label" for="approved">Approve</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hod_approval" id="rejected"
                                           value="<?php echo STATUS_REJECTED ?>" required/>
                                    <label class="form-check-label" for="rejected">Reject</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hod_approval" id="delayed"
                                           value="<?php echo STATUS_DELAYED ?>" required/>
                                    <label class="form-check-label" for="delayed">Delay</label>
                                </div>
                                <small class="help-block with-errors"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-row">
                                    <label for="" class="col-sm-12">Reasons</label>
                                    <div class="col-sm-8">
                                <textarea class="form-control" name="hod_reasons" aria-describedby="helpId"
                                          placeholder="" required></textarea>
                                        <small id="helpId" class="form-text with-errors help-block"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-row d-none" id="hod_ref_num">
                                    <label for="" class="col-sm-12">
                                        Reference Number
                                        <small>(Required only if approved)</small>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="hod_ref_num"
                                               aria-describedby="helpId"
                                               placeholder="" required/>
                                        <small id="helpId" class="form-text with-errors help-block"></small>
                                    </div>
                                </div>
                            </div>
                            <?php /*  <div class="col-sm-12 d-none">
                                <div class="form-group form-row gm">
                                    <label for="gm_id" class="col-sm-12">
                                        Select GM
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="replace-multiple-select form-control" id="gm_id">
                                            <option></option>
                                        </select>
                                        <select class="form-control bs-select multiple-hidden d-none"
                                                data-none-selected-text="Select GM to Approve" name="gm_id"
                                                data-size="5"
                                                id="gm_id" aria-describedby="helpId" required>
                                            <option class="d-none"></option>
                                            <?php
                                            foreach ((array)$payload['gms'] as $value) {
                                                $gm = new User($value->user_id); ?>
                                                <option
                                                value="<?php echo $gm->user_id; ?>"><?php echo ucwords($gm->first_name . ' ' . $gm->last_name, '-. ') . ' (' . $gm->job_title . ')'; ?></option><?php } ?>
                                        </select>
                                        <small id="helpId" class="form-text text-muted help-block d-none">Hint:
                                            Select
                                            GM to
                                            Approve
                                        </small>
                                        <small id="helpId" class="form-text with-errors help-block"></small>
                                    </div>
                                </div>
                            </div>*/ ?>

                            <div class="col-sm-8 text-right">
                                <button type="submit" class="btn bg-success w3-btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    <?php } else {
        alert('HOD Approval Pending...', 'text-primary text-bold alert');
    }
} else { ?>
    <div class="row p-2">
        <div class="w-100 row border ml-0 p-1">
            <h6 class="text-bold font-italic col m-1">
                <a href="#section_2" data-toggle="collapse">
                    <i class="fa <?php echo ICON_FA_PLUS ?>"></i> Section 2 - HOD Approval
                    <?php echo echoCompleted(); ?>
                </a>
                <?php if ($payload['form']->hod_approval == STATUS_REJECTED) {
                    echo "<i class='text-danger text-bold mx-2'>--Change application rejected</i> ";
                } elseif ($payload['form']->hod_approval == STATUS_DELAYED) {
                    echo "<i class='text-danger text-bold mx-2'>--Change application delayed</i> ";
                } ?>
            </h6>
            <span class="text-right float-right invisible"><?php if (isHod($payload['form']->cms_form_id, getUserSession()->user_id)) { ?>
                    <a href="#" title="Edit this section">
                    <i class="fa fa-edit"></i>
                </a><?php } ?>
            </span>
        </div>
        <div class="w-100 section collapse" id="section_2">
            <div class="d-sm-block d-none">
                <table class="table table-bordered table-user-information font-raleway table-striped table-active">
                    <thead class="thead-default d-none">
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-right" style="width:17%"><b>By: </b></td>
                        <td scope="row" style="width:83%">
                            <?php echo getNameJobTitleAndDepartment($payload['action_log'][ACTION_HOD_ASSESSMENT_COMPLETED]->performed_by); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right" style="width:17%"><b>HOD Approval: </b></td>
                        <td scope="row" style="width:83%"
                            class="<?php echo ($payload['form']->hod_approval == STATUS_REJECTED || $payload['form']->hod_approval == STATUS_DELAYED) ? 'text-danger' : 'text-success'; ?>">
                            <?php echo ucwords($payload['form']->hod_approval); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right"><b>Reasons: </b></td>
                        <td scope="row" class="">
                            <?php echo $payload['form']->hod_reasons; ?>
                        </td>
                    </tr>
                    <?php if (!empty($payload['form']->hod_ref_num)) { ?>
                        <tr>
                            <td class="text-sm-right"><b>Reference: </b></td>
                            <td scope="row">
                                <?php echoIfEmpty($payload['form']->hod_ref_num, 'N/A'); ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="text-right"><b>Date: </b></td>
                        <td scope="row" class="">
                            <?php echo returnDate($payload['action_log'][ACTION_HOD_ASSESSMENT_COMPLETED]->date); ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-sm-none d-block">
                <table class="table table-bordered table-user-information font-raleway table-striped table-active">
                    <thead class="thead-default d-none">
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td scope="row">
                            <span class="row">
                                <span class="col-sm-2 text-sm-right">
                                    <b>By: </b>
                                </span>
                                <span class="col-sm-8">
                                   <?php echo getNameJobTitleAndDepartment($payload['action_log'][ACTION_HOD_ASSESSMENT_COMPLETED]->performed_by); ?>
                                </span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">
                        <span class="row">
                            <span class="col-sm-2 text-sm-right">
                                <b>HOD Approval: </b>
                            </span>
                        <span class="col-sm-8 <?php echo $payload['form']->hod_approval == STATUS_REJECTED || $payload['form']->hod_approval == STATUS_DELAYED ? 'text-danger' : 'text-success'; ?>"><?php echo ucwords($payload['form']->hod_approval); ?>
                            </span>
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">
                        <span class="row">
                            <span class="col-sm-2 text-sm-right">
                                <b>Reference: </b>
                            </span>
                        <span class="col-sm-8"><?php echoIfEmpty($payload['form']->hod_ref_num, 'N/A'); ?>
                            </span>
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">
                        <span class="row">
                            <span class="col-sm-2 text-sm-right">
                                <b>Reasons: </b>
                            </span>
                        <span class="col-sm-8"><?php echo $payload['form']->hod_reasons; ?>
                            </span>
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">
                            <span class="row">
                                <span class="col-sm-2 text-sm-right">
                                    <b>Date: </b>
                                </span>
                                <span class="col-sm-8">
                                     <?php echo returnDate($payload['action_log'][ACTION_HOD_ASSESSMENT_COMPLETED]->date); ?>
                                </span>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<?php } ?>
