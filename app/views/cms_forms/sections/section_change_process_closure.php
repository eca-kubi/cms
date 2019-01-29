<?php /** @var  array $payload */
if (sectionCompleted($payload['form']->cms_form_id, SECTION_ACTION_LIST)) { ?>
    <div class="row p-2">
        <div class="w-100 row border ml-0 p-1">
            <h6 class="text-bold font-italic col m-1">
                <a href="#section_7" data-toggle="collapse">
                    <i class="fa fa-plus" data-id></i> Section 7 - Change Process Closure
                    <span class="text-muted d-sm-inline d-block">
                    (To be Completed by Project Leader, Originator, & HoD)
                </span>
                </a>
            </h6>
        </div>
        <div id="section_7"
             class="collapse section border p-3 w-100 <?php echo $_GET['target'] === SECTION_PROCESS_CLOSURE ? 'show' : '' ?>">
            <div class="d-sm-block d-none">
                <table class="table table-bordered table-user-information font-raleway mb-0">
                    <thead class="thead-default d-none">
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (empty($payload['form']->project_leader_close_change)) {
                        if ($payload['form']->project_leader_id === getUserSession()->user_id
                        ) { ?>
                            <td class="text-right" scope="row" style="width:17%">
                                <b>Project Leader to Close Process: </b>
                            </td>
                            <td style="width:83%">
                                <div class="row px-2">
                                    <form class="w-100" action="<?php echo '' ?>" role="form" data-toggle="validator">
                                        <div class="col-sm-12 form-group pl-0">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="hod_close_change"
                                                       id="close_change"
                                                       value="<?php echo STATUS_CLOSED ?>" required/>
                                                <label class="form-check-label" for="close_change">Close</label>
                                            </div>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                        <a class="btn small badge badge-success" onclick="$('#close').click();"
                                           href="javascript:">Close</a>
                                        <b class="small"> <== Click this button to close this change process </b>
                                        <input type="submit" class="d-none" value="Close" id="close">
                                    </form>
                                </div>
                            </td>
                        <?php } else { ?>
                            <tr>
                                <td class="text-right" scope="row" style="width:17%">
                                    <b>Process Closed by Project Leader: </b>
                                </td>
                                <td style="width:83%">
                                    <?php echo empty($payload['form']->project_leader_close_change) ? ' No ' : ' Yes' ?>
                                </td>
                            </tr>
                        <?php }
                    }
                    ?>
                    <?php
                    if (empty($payload['form']->originator_close_change)) {
                        if ($payload['form']->originator_id === getUserSession()->user_id
                        ) { ?>
                            <td class="text-right" scope="row" style="width:17%">
                                <b>Originator to Close Process: </b>
                            </td>
                            <td style="width:83%">
                                <div class="row px-2">
                                    <form class="w-100" action="<?php echo '' ?>" role="form" data-toggle="validator">
                                        <div class="col-sm-12 form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="hod_close_change"
                                                       id="close_change"
                                                       value="<?php echo STATUS_CLOSED ?>" required/>
                                                <label class="form-check-label" for="close_change">Close</label>
                                            </div>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                        <a class="btn small badge badge-success" onclick="$('#close').click();"
                                           href="javascript:">Close</a>
                                        <b class="small"> <== Click this button to close this change process </b>
                                        <input type="submit" class="d-none" value="Close" id="close">
                                    </form>
                                </div>
                            </td>
                        <?php } else { ?>
                            <tr>
                                <td class="text-right" scope="row" style="width:17%">
                                    <b>Process Closed by Originator: </b>
                                </td>
                                <td style="width:83%">
                                    <?php echo empty($payload['form']->originator_close_change) ? ' No ' : ' Yes' ?>
                                </td>
                            </tr>
                        <?php }
                    }
                    ?>
                    <?php
                    if (empty($payload['form']->hod_close_change)) {
                        if (isHOD($payload['form']->cms_form_id, getUserSession()->user_id
                        )) { ?>
                            <td class="text-right" scope="row" style="width:17%">
                                <b>HoD to Close Process: </b>
                            </td>
                            <td style="width:83%">
                                <div class="row px-2">
                                    <form class="w-100" action="<?php echo '' ?>" role="form" data-toggle="validator">
                                        <div class="col-sm-12 form-group pl-0">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="hod_close_change"
                                                       id="close_change"
                                                       value="<?php echo STATUS_CLOSED ?>" required/>
                                                <label class="form-check-label" for="close_change">Close</label>
                                            </div>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                        <a class="btn small badge badge-success" onclick="$('#close').click();"
                                           href="javascript:">Close</a>
                                        <b class="small"> <== Click this button to close this change process </b>
                                        <input type="submit" class="d-none" value="Close" id="close">
                                    </form>
                                </div>
                            </td>
                        <?php } else { ?>
                            <tr>
                                <td class="text-right" scope="row" style="width:17%">
                                    <b>Change Closed by HoD: </b>
                                </td>
                                <td style="width:83%">
                                    <?php echo empty($payload['form']->hod_close_change) ? ' No ' : ' Yes' ?>
                                </td>
                            </tr>
                        <?php }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="d-sm-none d-block">
                <table class="table table-bordered table-user-information font-raleway mb-0">
                    <thead class="thead-default d-none">
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="2">
                        <span class="col-sm-4 text-sm-right">
                            <b>Change Closed by HoD:  </b>
                        </span>
                            <span class="col-sm-8">
                            <?php echo empty($payload['form']->hod_close_change) ? ' No ' : ' Yes' ?>
                        </span>
                        </td>
                    </tr>
                    <?php
                    if (empty($payload['form']->project_leader_close_change)) {
                        if ($payload['form']->project_leader_id === getUserSession()->user_id
                        ) { ?>
                            <tr>
                                <td colspan="2" class="text-right">
                                    <div class="col-sm-4 text-sm-right">
                                        <b>Close Change Process: </b>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row px-2">
                                            <form class="w-100" action="<?php echo '' ?>" role="form"
                                                  data-toggle="validator">
                                                <div class="col-sm-12 form-group pl-0">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="hod_close_change"
                                                               id="close_change"
                                                               value="<?php echo STATUS_CLOSED ?>" required/>
                                                        <label class="form-check-label" for="close_change">Close</label>
                                                    </div>
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                                <a class="btn small badge badge-success" onclick="$('#close').click();"
                                                   href="javascript:">Close</a>
                                                <b class="small"> <== Click this button to close this change
                                                    process </b>
                                                <input type="submit" class="d-none" value="Close" id="close">
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td class="text-right" colspan="2">
                                    <div class="col-sm-4 text-sm-right">
                                        <b>Process Closed by Project Leader: </b>
                                    </div>
                                    <div class="col-sm-8">
                                        <?php echo empty($payload['form']->project_leader_close_change) ? ' No ' : ' Yes' ?>
                                    </div>
                                </td>
                            </tr>
                        <?php }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } else {
    alert('Change Process Closure Pending...', 'alert text-primary text-bold');
}
?>
