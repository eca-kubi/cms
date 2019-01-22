<?php /** @var  array $payload */
if (!sectionCompleted($payload['form']->cms_form_id, SECTION_HOD_AUTHORISATION)) {
    if (isHOD($payload['form']->cms_form_id, getUserSession()->user_id)) { ?>
        <div class="row p-2">
            <form class="w-100"
                  action="<?php echo URL_ROOT . '/cms-forms/hod-authorisation/' . $payload['form']->cms_form_id ?>"
                  method="post" data-toggle="validator" role="form"
                  enctype="multipart/form-data">
                <fieldset class="w-100">
                    <div class="w-100 row border ml-0 p-1">
                        <h6 class="text-bold font-italic col m-1">
                            <a href="#section_5" data-toggle="collapse">
                                <i class="fa fa-minus" data-id></i> Section 5 - Authorization to Implement Change &
                                Project Leader Acceptance
                                <span class="text-muted d-sm-inline d-block">
                            (To be Completed by - HoD)
                        </span>
                            </a>
                        </h6>
                        <span class="text-right float-right invisible"><?php if (isHOD($payload['form']->cms_form_id, getUserSession()->user_id)) { ?>
                                <a href="#" title="Edit this section">
                        <i class="fa fa-edit"></i>
                    </a><?php } ?>
                </span>
                    </div>
                    <div id="section_5" class="collapse show section border p-3">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="hod_authorization"
                                           id="hod_authorization"
                                           value="<?php echo STATUS_AUTHORIZED ?>" required/>
                                    <label class="form-check-label" for="hod_authorization">Authorize</label>
                                </div>
                                <small class="help-block with-errors"></small>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-row">
                                    <label for="hod_authorization_comment" class="col-sm-12">Comments</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="hod_authorization_comment"
                                                  id="hod_authorization_comment"
                                                  aria-describedby="helpId"
                                                  required></textarea>
                                        <small class="form-text with-errors help-block"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-row">
                                    <label for="project_leader_id" class="col-sm-12">Project Leader</label>
                                    <div class="col-sm-8">
                                        <select class="form-control  bs-select" name="project_leader_id"
                                                id="project_leader_id"
                                                data-none-selected-text="Select a Project Leader"
                                                data-actions-box="true"
                                                data-size="7"
                                                aria-describedby="helpId"
                                                required>
                                            <option class="d-none"></option>
                                            <?php
                                            foreach ($payload['department_members'] as $department_member) { ?>
                                                <option value="<?php echo $department_member->user_id; ?>">
                                                    <?php echo concatNameWithUserId($department_member->user_id) .
                                                        " ($department_member->job_title)";
                                                    ?>
                                                </option>
                                            <?php }
                                            ?>
                                        </select>
                                        <small class="form-text with-errors help-block"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 text-right">
                                <button type="submit" class="btn bg-success w3-btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    <?php } else {
        alert('Authorization for Change Implementation Pending...', 'text-primary text-bold alert');
    }
} else {
    ?>
    <div class="row p-2">
        <div class="w-100 row border ml-0 p-1">
            <h6 class="text-bold font-italic col m-1">
                <a href="#section_5" data-toggle="collapse">
                    <i class="fa fa-plus" data-id></i> Section 5 - Implementation Authorization & Project Leader
                    Acceptance
                    <span class="small d-sm-inline d-block"><?php echoCompleted($payload['action_log'][ACTION_HOD_AUTHORISATION_COMPLETED]->date, $payload['action_log'][ACTION_HOD_AUTHORISATION_COMPLETED]->performed_by); ?> </span>
                    <span class="mx-2 text-bold text-danger small">
                    <?php echo empty($payload['form']->project_leader_acceptance) ? '<b><i> --Acceptance pending</i></b>' : ''; ?>
                </span>
                </a>
            </h6>
        </div>
        <div class="w-100 section collapse" id="section_5">
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
                        <?php
                        $authorized_by = new User($payload['action_log'][ACTION_HOD_AUTHORISATION_COMPLETED]->performed_by);
                        $project_leader = new User($payload['form']->project_leader_id);
                        ?>
                        <td class="text-right" style="width:17%"><b>Implementation Authorized by: </b></td>
                        <td scope="row" style="width:83%">
                            <?php echo concatNameWithUserId($authorized_by->user_id) . " ($authorized_by->job_title)"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right"><b>HoD's Comment: </b></td>
                        <td scope="row" class="">
                            <?php echo $payload['form']->hod_authorization_comment; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right"><b>Project Leader: </b></td>
                        <td scope="row" class="">
                            <?php echo concatNameWithUserId($payload['form']->project_leader_id) . " ($project_leader->job_title) "; ?>
                        </td>
                    </tr>
                    <?php
                    if (isProjectLeader(getUserSession()->user_id, $payload['form']->cms_form_id) && empty($payload['form']->project_leader_acceptance)) { ?>
                        <tr>
                            <td class="text-right">
                                <b>Project Leader Acceptance: </b>
                            </td>
                            <td>
                                <form class="w-100"
                                      action="<?php echo URL_ROOT ?>/cms-forms/project-leader-acceptance/<?php echo $payload['form']->cms_form_id; ?>"
                                      role="form" data-toggle="validator">
                                    <div class="form-row form-group mb-0">
                                        <label class="col-sm-12" for="comment">Comment:</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="comment" required></textarea>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                    </div>
                                    <a class="btn small badge badge-success" onclick="$('#accept').click();"
                                       href="javascript:">Accept</a>
                                    <b class="small"> <== Click this button to accept role as Project Leader </b>
                                    <input type="submit" class="d-none" value="Accept" id="accept">
                                </form>
                            </td>
                        </tr>
                        <?php
                    } else {
                        if (empty($payload['form']->project_leader_acceptance) && !isProjectLeader(getUserSession()->user_id, $payload['form']->cms_form_id)) { ?>
                            <tr>
                                <td class="text-right"><b>Project Leader Acceptance: </b></td>
                                <td scope="row">
                                    <?php echo '<b><i class="text-danger">Pending</i></b>'; ?>
                                </td>
                            </tr>
                            <?php
                        } else { ?>
                            <tr>
                                <td class="text-right"><b>Project Leader Acceptance: </b></td>
                                <td scope="row" class="">
                                    <?php echo '<b><i class="text-danger">' . ucwords($payload['form']->project_leader_acceptance) . '</i></b>'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right"><b>Project Leader's Comment: </b></td>
                                <td scope="row" class="">
                                    <?php echo '<b><i class="text-danger">' . ucwords($payload['form']->project_leader_acceptance_comment) . '</i></b>'; ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    <?php }
                    ?>
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
                                    <b>Implementation Authorized by: </b>
                                </span>
                                <span class="col-sm-8">
                                    <?php echo concatNameWithUserId($authorized_by->user_id) . " ($authorized_by->job_title)"; ?>
                                </span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">
                        <span class="row">
                            <span class="col-sm-2 text-sm-right">
                                <b>HoD' Comment: </b>
                            </span>
                        <span class="col-sm-8">
                            <?php echo $payload['form']->hod_authorization_comment; ?>
                        </span>
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">
                        <span class="row">
                            <span class="col-sm-2 text-sm-right">
                                <b>Project Leader: </b>
                            </span>
                        <span class="col-sm-8">
                            <?php
                            echo concatNameWithUserId($payload['form']->project_leader_id) . " ($project_leader->job_title) "; ?>
                        </span>
                        </span>
                        </td>
                    </tr>
                    <?php
                    if (isProjectLeader(getUserSession()->user_id, $payload['form']->cms_form_id) && empty($payload['form']->project_leader_acceptance)) { ?>
                        <tr>
                            <td>
                                <div class="row px-2">
                                    <form class="w-100"
                                          action="<?php echo URL_ROOT ?>/cms-forms/project-leader-acceptance/<?php echo $payload['form']->cms_form_id; ?>"
                                          role="form" data-toggle="validator">
                                        <div class="form-row">
                                            <label class="col-sm-12" for="comment">Comment:</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" id="comment" required></textarea>
                                                <small class="help-block with-errors"></small>
                                            </div>
                                        </div>
                                        <a class="btn small badge badge-success" onclick="$('#accept').click();"
                                           href="javascript:">Accept</a>
                                        <b class="small"> <== Click this button to accept role as Project Leader </b>
                                        <input type="submit" class="d-none" value="Accept" id="accept">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } else {
                        ?>
                        <tr>
                            <td scope="row">
                                <span class="row">
                                    <span class="col-sm-2 text-sm-right">
                                        <b>Project Leader Acceptance: </b>
                                    </span>
                                    <span class="col-sm-8">
                                        <?php echo empty($payload['form']->project_leader_acceptance) ? '<b><i>Pending</i></b>' : ucwords($payload['form']->project_leader_acceptance); ?>
                                    </span>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
<?php } ?>
