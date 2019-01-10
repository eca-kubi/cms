<?php /** @var  array $payload */
if (!sectionCompleted($payload['form']->cms_form_id, SECTION_HOD_ASSESSMENT)) {
    if (isHOD($payload['form']->cms_form_id, getUserSession()->user_id)) { ?>
        <div class="row p-2">
            <form class="w-100"
                  action="<?php echo URL_ROOT . '/cms-forms/hod-assessment/' . $payload['form']->cms_form_id ?>"
                  method="post" data-toggle="validator" role="form"
                  enctype="multipart/form-data">
                <fieldset class="w-100">
            <span class="w-100 row border ml-0 p-1">
                <h6 class="text-bold font-italic col m-1">
                    <a href="#section_2" data-toggle="collapse">
                        <i class="fa fa-minus" data-id></i> Section 2 - Further Assessment by HOD
                        <span class="text-muted d-sm-inline d-block">
                            (To be Completed by - HoD)
                        </span>
                    </a>
                </h6>
                <span class="text-right float-right invisible"><?php if (isHod($payload['form']->cms_form_id, getUserSession()->user_id)) { ?>
                        <a href="#" title="Edit this section">
                        <i class="fa fa-edit"></i>
                    </a><?php } ?>
                </span>
            </span>
                    <div id="section_2" class="collapse show section border p-3">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hod_approval" id="approved"
                                           value="approved" required/>
                                    <label class="form-check-label" for="approved">Approve</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hod_approval" id="rejected"
                                           value="rejected" required/>
                                    <label class="form-check-label" for="rejected">Reject</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hod_approval" id="delayed"
                                           value="delayed" required/>
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
                            </div><?php
                            if (isBudgetHigh($payload['form']->cms_form_id) || isRiskHigh($payload['form']->cms_form_id)) { ?>
                                <div class="col-sm-12">
                                <div class="form-group form-row">
                                    <label for="" class="col-sm-12">
                                        Select GM
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="replace-multiple-select form-control">
                                            <option></option>
                                        </select>
                                        <select class="form-control bs-select multiple-hidden d-none"
                                                data-none-selected-text="Select GM to Approve" name="gm_id"
                                                data-size="5"
                                                id="gm_id" aria-describedby="helpId" placeholder="" required>
                                            <option class="d-none"></option><?php
                                            foreach ((array)$payload['gms'] as $value) {
                                                $hod = new User($value->user_id); ?>
                                                <option
                                                value="<?php echo $hod->user_id; ?>"><?php echo ucwords($hod->first_name . ' ' . $hod->last_name, '-. ') . ' (' . $hod->job_title . ')'; ?></option><?php } ?>
                                        </select>
                                        <small id="helpId" class="form-text text-muted help-block d-none">Hint: Select
                                            GM to
                                            Approve
                                        </small>
                                        <small id="helpId" class="form-text with-errors help-block"></small>
                                    </div>
                                </div>
                                </div><?php } ?>
                            <div class="col-sm-8 text-right">
                                <button type="submit" class="btn bg-success w3-btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    <?php } else {
        alert('HOD Assessment Pending', 'text-primary text-bold alert');
    }
} else { ?>
    <div class="row p-2">
    <span class="w-100 row border ml-0 p-1">
        <h6 class="text-bold font-italic col m-1">
            <a href="#section_2b" data-toggle="collapse">
                <i class="fa fa-plus" data-id></i> Section 2 - Further Assesment by HOD
                <span class="text-muted d-sm-inline d-block">
                    (Completed by - HoD on <?php echo formatDate($payload['form']->hod_approval_date, DFB_DT, DFF_DT); ?> )
                </span>
            </a>
        </h6>
        <span class="text-right float-right invisible"><?php if (isHod($payload['form']->cms_form_id, getUserSession()->user_id)) { ?>
                <a href="#" title="Edit this section">
                <i class="fa fa-edit"></i>
            </a><?php } ?>
        </span>
    </span>
        <div class="w-100 section collapse" id="section_2b">
            <table class="table table-bordered table-user-information font-raleway">
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
                            <span class="col-sm-4 text-sm-right">
                                <b>HOD: </b>
                            </span>
                        <span class="col-sm-8"><?php echo ucwords($payload['hod']->first_name . ' ' . $payload['hod']->last_name); ?><?php echo " ({$payload['hod']->job_title})"; ?>
                            </span>
                        </span>
                    </td>
                    <td scope="row">
                        <span class="row">
                            <span class="col-sm-4 text-sm-right">
                                <b>HOD Approval: </b>
                            </span>
                        <span class="col-sm-8 <?php echo $payload['form']->hod_approval == 'rejected' || 'delayed' ? 'text-danger' : ''; ?>"><?php echo ucwords($payload['form']->hod_approval); ?>
                            </span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td scope="row">
                        <span class="row">
                            <span class="col-sm-4 text-sm-right">
                                <b>Reasons: </b>
                            </span>
                        <span class="col-sm-8"><?php echo $payload['form']->hod_reasons; ?>
                            </span>
                        </span>
                    </td>
                    <td scope="row" colspan="2">
                        <span class="row">
                            <span class="col-sm-4 text-sm-right">
                                <b>Reference: </b>
                            </span>
                        <span class="col-sm-8"><?php echoIfEmpty($payload['form']->hod_ref_num, 'N/A'); ?>
                            </span>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
<?php } ?>
