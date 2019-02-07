<?php /** @var  array $payload */
if (sectionCompleted($payload['form']->cms_form_id, SECTION_ACTION_LIST)) { ?>
    <div class="row p-2">
        <div class="w-100 row border ml-0 p-1">
            <h6 class="text-bold font-italic col m-1">
                <a href="#section_7" data-toggle="collapse">
                    <i class="fa <?php echo ICON_FA_PLUS ?>" data-id></i> Section 7 - Change Process Closure
                    <?php if (sectionCompleted($payload['form']->cms_form_id, SECTION_PROCESS_CLOSURE)) {
                        echo echoCompleted();
                    } else {
                        echo <<<heredoc
<span class="small animated text-bold text-dark font-italic">
                                                         [To be Completed by Project Leader, Originator, & HoD]
                    </span>
heredoc;
                    } ?>
                </a>
            </h6>
        </div>
        <div id="section_7"
             class="collapse section border w-100 <?php echo $_GET['target'] === SECTION_PROCESS_CLOSURE ? 'show' : '' ?>">
            <div class="d-sm-block d-none">
                <table class="table table-bordered table-user-information font-raleway mb-0 table-striped table-active">
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
                            <tr>
                                <td class="text-right" scope="row" style="width:30%">
                                    <b>Project Leader to Close Process: </b>
                                </td>
                                <td style="width:70%">
                                    <div class="row px-2">
                                        <form class="w-100"
                                              action=<?php echo URL_ROOT ?>/cms-forms/project-leader-closure/<?php echo $payload['form']->cms_form_id; ?>"
                                              role="form" data-toggle="validator">
                                            <div class="col-sm-12 form-group mb-0">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox"
                                                           name="project_leader_close_change"
                                                           id="project_leader_close_change"
                                                           value="<?php echo STATUS_CLOSED ?>" required/>
                                                    <label class="form-check-label"
                                                           for="project_leader_close_change">I <?php echo concatNameWithUserId(getUserSession()->user_id) ?>
                                                        -the Project Leader
                                                        of this Project- certify that the information provided by me is
                                                        accurate and true.</label>
                                                </div>
                                                <small class="help-block with-errors"></small>
                                            </div>
                                            <span class="pl-2"></span>
                                            <a class="btn small badge badge-success"
                                               onclick="$(this).siblings('#close').click();"
                                               href="javascript:">Close</a>
                                            <b class="small"> <== Click this button to close this change process </b>
                                            <input type="submit" class="d-none" value="Close" id="close">
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <?php
                        } else {
                            echo <<<heredoc
                        <tr>
                            <td class="" colspan="2" scope="row" style="width:100%">
                                <b>Closure by Project Leader: <i class="text-danger">Pending</i></b>
                            </td>
                        </tr>
heredoc;
                        }
                    } else { ?>
                        <tr>
                            <td class="" colspan="2" scope="row" style="width:100%">
                                <b>Closed by Project Leader
                                    on <?php echo returnDate($payload['form']->project_leader_close_change, true); ?> </b>
                            </td>
                        </tr>
                    <?php }
                    ?>
                    <?php
                    if (empty($payload['form']->originator_close_change)) {
                        if ($payload['form']->originator_id === getUserSession()->user_id
                        ) { ?>
                            <tr>
                                <td class="text-right" scope="row" style="width:30%">
                                    <b>Originator to Close Process: </b>
                                </td>
                                <td style="width:70%">
                                    <div class="row px-2">
                                        <form class="w-100"
                                              action="<?php echo URL_ROOT ?>/cms-forms/originator-closure/<?php echo $payload['form']->cms_form_id; ?>"
                                              role="form"
                                              data-toggle="validator">
                                            <div class="col-sm-12 form-group mb-0">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox"
                                                           name="originator_close_change" id="originator_close_change"
                                                           value="<?php echo STATUS_CLOSED ?>" required>
                                                    <label class="form-check-label"
                                                           for="originator_close_change">I <?php echo concatNameWithUserId(getUserSession()->user_id) ?>
                                                        -the Originator
                                                        of this Project- certify that the information provided by me is
                                                        accurate and true.</label>
                                                </div>
                                                <small class="help-block with-errors"></small>
                                            </div>
                                            <span class="pl-2">
                                                <input type="submit" class="d-none" value="Close" id="close">
                                                <a class="btn small badge badge-success"
                                                   onclick="$(this).siblings('#close').click();"
                                                   href="javascript:">Close</a>
                                                <b class="small"> <== Click this button to close this change process </b>
                                            </span>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } else {
                            echo <<<heredoc
                        <tr>
                            <td class="" colspan="2" scope="row" style="width:100%">
                                <b>Closure by Originator: <i class="text-danger">Pending</i></b>
                            </td>
                        </tr>
heredoc;
                        }
                    } else { ?>
                        <tr>
                            <td class="" scope="row" colspan="2" style="width:100%">
                                <b>Closed by Originator
                                    on <?php echo returnDate($payload['form']->originator_close_change, true); ?> </b>
                            </td>
                        </tr>
                    <?php }
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
                                    <form class="w-100"
                                          action="<?php echo URL_ROOT ?>/cms-forms/hod-closure/<?php echo $payload['form']->cms_form_id; ?>"
                                          role="form" data-toggle="validator">
                                        <div class="col-sm-12 form-group mb-0">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="hod_close_change"
                                                       id="hod_close_change" value="<?php echo STATUS_CLOSED ?>"
                                                       required/>
                                                <label class="form-check-label"
                                                       for="hod_close_change">I <?php echo concatNameWithUserId(getUserSession()->user_id) ?>
                                                    -the Owner
                                                    of this Project- certify that the information provided by me is
                                                    accurate and
                                                    true.
                                                </label>
                                            </div>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                        <span class="pl-2"></span><a class="btn small badge badge-success"
                                                                     onclick="$(this).siblings('#close').click();"
                                                                     href="javascript:">Close</a>
                                        <b class="small"> <== Click this button to close this change process </b>
                                        <input type="submit" class="d-none" value="Close" id="close">
                                    </form>
                                </div>
                            </td>
                        <?php } else {
                            echo <<<heredoc
                        <tr>
                            <td class="" colspan="2" scope="row" style="width:100%">
                                <b>Closure by Project Owner (HoD): <i class="text-danger">Pending</i></b>
                            </td>
                        </tr>
heredoc;
                        }
                    } else { ?>
                        <tr>
                            <td class="" scope="row" colspan="2" style="width:100%">
                                <b>Process Closed by the HoD
                                    on <?php echo returnDate($payload['form']->hod_close_change, true); ?> </b>
                            </td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="d-sm-none d-block">
                <table class="table table-bordered table-user-information font-raleway mb-0 table-striped table-active">
                    <thead class="thead-default d-none">
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (empty($payload['form']->project_leader_close_change)) {
                        if (isProjectLeader(getUserSession()->user_id, $payload['form']->cms_form_id)) { ?>
                            <tr>
                                <td colspan="2" class="text-sm-right">
                                    <div class="col-sm-4 text-sm-right">
                                        <b>Close Change Process: </b>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row px-2">
                                            <form class="w-100"
                                                  action="<?php echo URL_ROOT ?>/cms-forms/project-leader-closure/<?php echo $payload['form']->cms_form_id; ?>"
                                                  role="form"
                                                  data-toggle="validator">
                                                <div class="col-sm-12 form-group pl-0 mb-0">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="project_leader_close_change"
                                                               id="project_leader_close_change2"
                                                               value="<?php echo STATUS_CLOSED ?>" required/>
                                                        <label class="form-check-label text-justify"
                                                               for="project_leader_close_change2">I <?php echo concatNameWithUserId(getUserSession()->user_id) ?>
                                                            - the Project Leader
                                                            of this Project- certify that the information provided by me
                                                            is accurate and true.</label>
                                                    </div>
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                                <a class="btn small badge badge-success"
                                                   onclick="$(this).siblings('#close').click();"
                                                   href="javascript:">Close</a>
                                                <b class="small"> <== Click this button to close this change
                                                    process </b>
                                                <input type="submit" class="d-none" value="Close" id="close">
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td class="text-justify" colspan="2">
                                <div class="col-sm-12">
                                    <b>Closed by the Project Leader
                                        (<?php echo getNameJobTitleAndDepartment($payload['form']->project_leader_id) ?>
                                        )
                                        on <?php echo returnDate($payload['form']->project_leader_close_change, true); ?> </b>
                                </div>
                                <div class="col-sm-8 d-none">
                                    <?php echo empty($payload['form']->project_leader_close_change) ? ' No ' : ' Yes' ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php
                    if (empty($payload['form']->originator_close_change)) {
                        if (isOriginator($payload['form']->cms_form_id, getUserSession()->user_id)) { ?>
                            <tr>
                                <td colspan="2" class="text-sm-right">
                                    <div class="col-sm-4 text-sm-right">
                                        <b>Close Change Process: </b>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row px-2">
                                            <form class="w-100"
                                                  action="<?php echo URL_ROOT ?>/cms-forms/originator-closure/<?php echo $payload['form']->cms_form_id; ?>"
                                                  role="form"
                                                  data-toggle="validator">
                                                <div class="col-sm-12 form-group pl-0 mb-0">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="originator_close_change"
                                                               id="originator_close_change2"
                                                               value="<?php echo STATUS_CLOSED ?>" required/>
                                                        <label class="form-check-label text-justify"
                                                               for="originator_close_change2">I <?php echo concatNameWithUserId(getUserSession()->user_id) ?>
                                                            -the Originator
                                                            of this Project- certify that the information provided by me
                                                            is accurate and true.</label>
                                                    </div>
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                                <a class="btn small badge badge-success"
                                                   onclick="$(this).siblings('#close').click();"
                                                   href="javascript:">Close</a>
                                                <b class="small"> <== Click this button to close this change
                                                    process </b>
                                                <input type="submit" class="d-none" value="Close" id="close">
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td class="text-justify" colspan="2">
                                <div class="col-sm-12">
                                    <b>Closed by the Originator
                                        (<?php echo getNameJobTitleAndDepartment($payload['form']->originator_id) ?> )
                                        on <?php echo returnDate($payload['form']->originator_close_change, true); ?>
                                        . </b>
                                </div>
                                <div class="col-sm-8 d-none">
                                    <?php echo empty($payload['form']->originator_close_change) ? ' No ' : ' Yes' ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php
                    if (empty($payload['form']->hod_close_change)) {
                        if (isHOD($payload['form']->cms_form_id, getUserSession()->user_id)) { ?>
                            <tr>
                                <td colspan="2" class="text-sm-right">
                                    <div class="col-sm-4 text-sm-right">
                                        <b>Close Change Process: </b>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row px-2">
                                            <form class="w-100"
                                                  action="<?php echo URL_ROOT ?>/cms-forms/hod-closure/<?php echo $payload['form']->cms_form_id; ?>"
                                                  role="form" data-toggle="validator">
                                                <div class="col-sm-12 form-group pl-0 mb-0">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="hod_close_change"
                                                               id="hod_close_change2"
                                                               value="<?php echo STATUS_CLOSED ?>" required/>
                                                        <label class="form-check-label text-justify"
                                                               for="hod_close_change2">I <?php echo concatNameWithUserId(getUserSession()->user_id) ?>
                                                            -the Owner
                                                            of this Project- certify that the information provided by me
                                                            is accurate and true.</label>
                                                    </div>
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                                <a class="btn small badge badge-success"
                                                   onclick="$(this).siblings('#close').click();"
                                                   href="javascript:">Close</a>
                                                <b class="small"> <== Click this button to close the Change Process.</b>
                                                <input type="submit" class="d-none" value="Close" id="close">
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td class="text-justify" colspan="2">
                                <div class="col-sm-12">
                                    <b>Process Closed by the Project Owner
                                        (<?php echo getNameJobTitleAndDepartment($payload['form']->hod_id) ?> )
                                        on <?php echo returnDate($payload['form']->hod_close_change, true); ?>. </b>
                                </div>
                                <div class="col-sm-8 d-none">
                                    <?php echo empty($payload['form']->hod_close_change) ? ' No ' : ' Yes' ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if (sectionCompleted($payload['form']->cms_form_id, SECTION_PROCESS_CLOSURE)) {
            echo <<<heredoc
<div class="alert text-success container-fluid text-bold text-center">
<p class="text-center tada">Process Complete!</p>
<p><small><a class="text-bold flash animated" href="#" style="color: #007bff; animation-iteration-count: infinite;">Click here to download the complete form.</a></small></p>
</div>
heredoc;

        } ?>
    </div>
<?php } else {
    alert('Change Process Closure Pending...', 'alert text-primary text-bold');
}
?>
