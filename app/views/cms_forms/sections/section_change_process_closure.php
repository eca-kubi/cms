<?php /** @var  array $payload */
if (sectionCompleted($payload['form']->cms_form_id, SECTION_HOD_AUTHORISATION) && sectionCompleted($payload['form']->cms_form_id, SECTION_PL_ACCEPTANCE)) { ?>
    <div class="row p-2">
        <div class="w-100 row border ml-0 p-1">
            <h6 class="text-bold font-italic col m-1">
                <a href="#section_7" data-toggle="collapse">
                    <i class="fa <?php if (empty($payload['form']->hod_close_change)) {
                        echo ICON_FA_MINUS;
                    } else {
                        echo ICON_FA_PLUS;
                    } ?>" data-id></i> Section 7 - Change Process Closure
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
             class="section border w-100 <?php if (!empty($payload['form']->hod_close_change)) {
                 echo 'collapse';
             } ?>">
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
                        if ($payload['form']->project_leader_id == getUserSession()->user_id
                            && sectionCompleted($payload['form']->cms_form_id, SECTION_PL_ACCEPTANCE)) { ?>
                            <tr>
                                <td class="text-right" scope="row" style="width:30%">
                                    <b>Project Leader to Close Process: </b>
                                </td>
                                <td style="width:70%">
                                    <div class="row px-2">
                                        <form class="w-100" method="post"
                                              action="<?php echo site_url("cms-forms/project-leader-closure/" . $payload['form']->cms_form_id) ?>"
                                              role="form" data-toggle="validator">
                                            <div class="col-sm-12 form-group mb-1 p-0">
                                                <div class="form-check form-check-inline p-0">
                                                    <input class="form-check-input" type="checkbox"
                                                           name="project_leader_close_change"
                                                           id="project_leader_close_change"
                                                           value="<?php echo STATUS_CLOSED ?>" required/>
                                                    <label class="form-check-label"
                                                           for="project_leader_close_change">I <?php echo concatNameWithUserId(getUserSession()->user_id) ?>
                                                        -the Project Leader
                                                        for this Project- certify that all issues raised have been
                                                        addressed and the project has been implemented
                                                        successfully.
                                                    </label>
                                                </div>
                                                <small class="help-block with-errors"></small>
                                            </div>
                                            <div class="form-group mb-1">
                                            <textarea name="pl_closure_comment" cols="30" rows="7"
                                                      class="form-control" placeholder="Comments" required></textarea>
                                                <small class="help-block with-errors"></small>
                                            </div>
                                            <span>
                                            <a class="btn small badge badge-success"
                                               onclick="$(this).siblings('#close').click();"
                                               href="javascript:">Close</a>
                                        <b class="small"> <== Click this button to close this change process </b>
                                        <input type="submit" class="d-none" value="Close" id="close">
                                        </span>
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
                            <td class="text-justify" colspan="2">
                                <div class="col-sm-12 p-0">
                                    <b class="text-bold">Closed
                                        by: </b><?php echo concatNameWithUserId($payload['action_log'][ACTION_PL_CLOSURE]->performed_by) ?>
                                    (Project Leader)
                                    on <?php echo returnDate($payload['form']->project_leader_close_change, true); ?>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <b class="text-bold">Project Leader
                                        Comment: </b> <?php echo $payload['form']->pl_closure_comment ?>
                                </div>
                            </td>
                        </tr>
                    <?php }
                    ?>
                    <?php
                    if (empty($payload['form']->originator_close_change)) {
                        if ($payload['form']->originator_id === getUserSession()->user_id && !empty($payload['form']->project_leader_close_change)
                        ) { ?>
                            <tr>
                                <td class="text-right" scope="row" style="width:30%">
                                    <b>Originator to Close Process: </b>
                                </td>
                                <td style="width:70%">
                                    <div class="row px-2">
                                        <form class="w-100"
                                              action="<?php echo site_url("cms-forms/originator-closure/" . $payload['form']->cms_form_id) ?>"
                                              role="form"
                                              data-toggle="validator" method="post">
                                            <div class="col-sm-12 form-group mb-0 p-0">
                                                <div class="form-check form-check-inline p-0">
                                                    <input class="form-check-input" type="checkbox"
                                                           name="originator_close_change" id="originator_close_change"
                                                           value="<?php echo STATUS_CLOSED ?>" required>
                                                    <label class="form-check-label"
                                                           for="originator_close_change">I <?php echo concatNameWithUserId(getUserSession()->user_id) ?>
                                                        -the Originator
                                                        of this Project- certify that the project implementation is
                                                        successful.
                                                    </label>
                                                </div>
                                                <small class="help-block with-errors"></small>
                                            </div>
                                            <div class="form-group mb-1">
                                            <textarea name="pl_closure_comment" cols="30" rows="7"
                                                      class="form-control" placeholder="Comments" required></textarea>
                                                <small class="help-block with-errors"></small>
                                            </div>
                                            <span class="">
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
                            <td class="text-justify" colspan="2">
                                <div class="col-sm-12 p-0">
                                    <b class="text-bold">Closed
                                        by: </b><?php echo concatNameWithUserId($payload['action_log'][ACTION_ORIGINATOR_CLOSURE]->performed_by) ?>
                                    (Originator)
                                    on <?php echo returnDate($payload['form']->originator_close_change, true); ?>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <b class="text-bold">Originator
                                        Comment: </b> <?php echo $payload['form']->originator_closure_comment ?>
                                </div>
                            </td>
                        </tr>
                    <?php }
                    ?>
                    <?php
                    if (empty($payload['form']->hod_close_change)) {
                        if (isCurrentManager($payload['form']->department_id, getUserSession()->user_id) && !empty($payload['form']->originator_close_change)) { ?>
                            <td class="text-right" scope="row" style="width:17%">
                                <b>HoD to Close Process: </b>
                            </td>
                            <td style="width:83%">
                                <div class="row px-2">
                                    <form class="w-100"
                                          action="<?php echo URL_ROOT ?>/cms-forms/hod-closure/<?php echo $payload['form']->cms_form_id; ?>"
                                          role="form" data-toggle="validator" method="post">
                                        <div class="col-sm-12 form-group mb-0 p-0">
                                            <div class="form-check form-check-inline p-0">
                                                <input class="form-check-input" type="checkbox" name="hod_close_change"
                                                       id="hod_close_change" value="<?php echo STATUS_CLOSED ?>"
                                                       required/>
                                                <label class="form-check-label"
                                                       for="hod_close_change">I <?php echo concatNameWithUserId(getUserSession()->user_id) ?>
                                                    -the Owner
                                                    of this Project- certify the project has been implemented
                                                    successfully.
                                                </label>
                                            </div>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                        <div class="form-group mb-1">
                                            <textarea name="pl_closure_comment" cols="30" rows="7"
                                                      class="form-control" placeholder="Comments" required></textarea>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                        <span>
                                            <a class="btn small badge badge-success"
                                               onclick="$(this).siblings('#close').click();"
                                               href="javascript:">Close</a>
                                            <b class="small"> <== Click this button to close this change process </b>
                                            <input type="submit" class="d-none" value="Close" id="close">
                                        </span>
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
                            <td class="text-justify" colspan="2" style="width:100%">
                                <div class="col-sm-12 p-0">
                                    <span class="text-bold">Closed by: </span> <?php echo concatNameWithUserId($payload['action_log'][ACTION_HOD_CLOSURE]->performed_by) ?>
                                    (HoD)
                                    on <?php echo returnDate($payload['form']->hod_close_change, true); ?>.
                                </div>
                                <div class="col-sm-12 p-0">
                                    <b class="text-bold">HoD
                                        Comment: </b> <?php echo $payload['form']->hod_closure_comment ?>
                                </div>
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
                                                  action="<?php echo site_url("cms-forms/project-leader-closure/" . $payload['form']->cms_form_id) ?>"
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
                                                            of this Project- certify that all issues raised have been
                                                            addressed and the project has been implemented
                                                            successfully.</label>
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
                                    <b class="text-bold">Closed
                                        by: </b><?php echo concatNameWithUserId($payload['action_log'][ACTION_PL_CLOSURE]->performed_by) ?>
                                    (Project Leader)
                                    on <?php echo returnDate($payload['form']->project_leader_close_change, true); ?>
                                </div>
                                <div class="col-sm-12">
                                    <b class="text-bold">Project Leader
                                        Comment: </b> <?php echo $payload['form']->pl_closure_comment ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php
                    if (empty($payload['form']->originator_close_change)) {
                        if (isOriginator($payload['form']->cms_form_id, getUserSession()->user_id) && !empty($payload['form']->project_leader_close_change)) { ?>
                            <tr>
                                <td colspan="2" class="text-sm-right">
                                    <div class="col-sm-4 text-sm-right">
                                        <b>Close Change Process: </b>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row px-2">
                                            <form class="w-100"
                                                  action="<?php echo site_url("cms-forms/originator-closure/" . $payload['form']->cms_form_id); ?>"
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
                                                            of this Project- certify that the project implementation is
                                                            successful.</label>
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
                                    <b class="text-bold">Closed
                                        by: </b><?php echo concatNameWithUserId($payload['action_log'][ACTION_ORIGINATOR_CLOSURE]->performed_by) ?>
                                    (Originator)
                                    on <?php echo returnDate($payload['form']->originator_close_change, true); ?>
                                </div>
                                <div class="col-sm-12">
                                    <b class="text-bold">Originator
                                        Comment: </b> <?php echo $payload['form']->originator_closure_comment ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php
                    if (empty($payload['form']->hod_close_change)) {
                        if (isCurrentManager($payload['form']->department_id, getUserSession()->user_id) && !empty($payload['form']->originator_close_change)) { ?>
                            <tr>
                                <td colspan="2" class="text-sm-right">
                                    <div class="col-sm-4 text-sm-right">
                                        <b>Close Change Process: </b>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row px-2">
                                            <form class="w-100"
                                                  action="<?php echo site_url("cms-forms/hod-closure/" . $payload['form']->cms_form_id) ?>"
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
                                                            of this Project- certify the project has been implemented
                                                            successfully.</label>
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
                                    <span class="text-bold">Closed by: </span> <?php echo concatNameWithUserId($payload['action_log'][ACTION_HOD_CLOSURE]->performed_by) ?>
                                    (HoD)
                                    on <?php echo returnDate($payload['form']->hod_close_change, true); ?>.
                                </div>
                                <div class="col-sm-12">
                                    <b class="text-bold">HoD
                                        Comment: </b> <?php echo $payload['form']->hod_closure_comment ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if (sectionCompleted($payload['form']->cms_form_id, SECTION_PROCESS_CLOSURE)) {
            $print_url = site_url('cms-forms/print/' . $payload['form']->cms_form_id);
            echo <<<heredoc
<div class="alert text-success container-fluid text-bold text-center">
<p class="text-center tada">Process Complete!</p>
<p><small><a class="text-bold flash animated print-it" href="$print_url" style="color: #007bff; animation-iteration-count: infinite;">Click here to print the completed form.</a></small></p>
</div>
heredoc;

        } ?>
    </div>
<?php } else {
    alert('Change Process Closure Pending...', 'alert text-primary text-bold');
}
?>
