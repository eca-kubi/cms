<?php /** @var  array $payload */
if (!sectionCompleted($payload['form']->cms_form_id, SECTION_GM_ASSESSMENT)) {
    if (isGM(getUserSession()->user_id)) { ?>
        <div class="row p-2">
            <form class="w-100"
                  action="<?php echo URL_ROOT . '/cms-forms/gm-assessment/' . $payload['form']->cms_form_id ?>"
                  method="post" data-toggle="validator" role="form"
                  enctype="multipart/form-data">
                <fieldset class="w-100">
                    <div class="w-100 row border ml-0 p-1">
                        <h6 class="text-bold font-italic col m-1">
                            <a href="#section_4" data-toggle="collapse">
                                <i class="fa fa-minus" data-id></i> Section 4 - GM's Approval
                                <span class="text-muted d-sm-inline d-block">
                            (To be Completed by - GM)
                        </span>
                            </a>
                        </h6>
                        <span class="text-right float-right invisible"><?php if (isGM(getUserSession()->user_id)) { ?>
                                <a href="#" title="Edit this section">
                        <i class="fa fa-edit"></i>
                    </a><?php } ?>
                </span>
                    </div>
                    <div id="section_4" class="collapse show section border p-3">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gm_approval" id="approved"
                                           value="<?php echo STATUS_APPROVED ?>" required/>
                                    <label class="form-check-label" for="approved">Approve</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gm_approval" id="rejected"
                                           value="<?php echo STATUS_REJECTED ?>" required/>
                                    <label class="form-check-label" for="rejected">Reject</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gm_approval" id="delayed"
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
                                <textarea class="form-control" name="gm_approval_reasons" aria-describedby="helpId"
                                          placeholder="" required></textarea>
                                        <small id="helpId" class="form-text with-errors help-block"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 text-right">
                                <button type="submit" class="btn bg-success w3-btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    <?php } else {
        alert('GM Approval Pending...', 'text-primary text-bold alert');
    }
} else { ?>
    <div class="row p-2">
        <div class="w-100 row border ml-0 p-1">
            <h6 class="text-bold font-italic col m-1">
                <a href="#section_4" data-toggle="collapse">
                    <i class="fa fa-plus" data-id></i> Section 4 - GM Approval
                    <span class="small d-sm-inline d-block"><?php echoCompleted($payload['action_log'][ACTION_GM_ASSESSMENT_COMPLETED]->date, $payload['action_log'][ACTION_GM_ASSESSMENT_COMPLETED]->performed_by); ?> </span>
                </a>
                <?php if ($payload['form']->gm_approval == STATUS_REJECTED) {
                    echo "<i class='text-danger text-bold mx-2'>--Change proposal rejected</i> ";
                } elseif ($payload['form']->gm_approval == STATUS_DELAYED) {
                    echo "<i class='text-danger text-bold mx-2'>--Change proposal delayed</i> ";
                } ?>
            </h6>
            <span class="text-right float-right invisible"><?php if (isGM(getUserSession()->user_id)) { ?>
                    <a href="#" title="Edit this section">
                    <i class="fa fa-edit"></i>
                </a><?php } ?>
            </span>
        </div>
        <div class="w-100 section collapse" id="section_4">
            <div class="d-sm-block d-none">
                <table class="table table-bordered table-user-information font-raleway">
                    <thead class="thead-default d-none">
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-right" style="width:17%"><b>GM Approval: </b></td>
                        <td scope="row" style="width:83%"
                            class="<?php echo ($payload['form']->gm_approval == STATUS_REJECTED || $payload['form']->gm_approval == STATUS_DELAYED) ? 'text-danger' : 'text-success'; ?>">
                            <?php echo ucwords($payload['form']->gm_approval); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right"><b>Reasons: </b></td>
                        <td scope="row" class="">
                            <?php echo $payload['form']->gm_approval_reasons; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-sm-none d-block">
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
                            <span class="col-sm-2 text-sm-right">
                                <b>GM Approval: </b>
                            </span>
                        <span class="col-sm-8 <?php echo $payload['form']->gm_approval == STATUS_REJECTED || $payload['form']->gm_approval == STATUS_DELAYED ? 'text-danger' : 'text-success'; ?>"><?php echo ucwords($payload['form']->gm_approval); ?>
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
                        <span class="col-sm-8"><?php echo $payload['form']->gm_approval_reasons; ?>
                            </span>
                        </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<?php } ?>
