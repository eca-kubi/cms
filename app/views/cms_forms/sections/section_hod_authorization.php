<?php /** @var  array $payload */
if (sectionCompleted($payload['form']->cms_form_id, SECTION_GM_ASSESSMENT)) {
    if (!sectionCompleted($payload['form']->cms_form_id, SECTION_HOD_AUTHORISATION)) {
        if (isCurrentManager($payload['form']->department_id, getUserSession()->user_id)) { ?>
            <div class="row p-2">
                <form class="w-100"
                      action="<?php echo site_url('cms-forms/hod-authorisation/' . $payload['form']->cms_form_id) ?>"
                      method="post" data-toggle="validator" role="form"
                      enctype="multipart/form-data">
                    <fieldset class="w-100">
                        <div class="w-100 row border ml-0 p-1">
                            <h6 class="text-bold font-italic col m-1">
                                <a href="#section_5" data-toggle="collapse">
                                    <i class="fa <?php echo ICON_FA_MINUS ?>" data-id></i> Section 5 - Authorization to
                                    Implement Change &
                                    Project Leader Acceptance
                                    <span class="small animated incomplete text-dark font-italic">
                                        [To be Completed by - HoD]
                                    </span>
                                </a>
                            </h6>
                            <span class="text-right float-right invisible">
                                <?php if (isHOD($payload['form']->cms_form_id, getUserSession()->user_id)) { ?>
                                    <a href="#" title="Edit this section">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                <?php } ?>
                            </span>
                        </div>
                        <div id="section_5" class="collapse show section border p-3 table-active">
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
                                                      id="hod_authorization_comment" required></textarea>
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
                        <i class="fa <?php echo ICON_FA_PLUS ?>" data-id></i> Section 5 - Implementation Authorization &
                        Project Leader
                        Acceptance
                        <span><?php echo echoCompleted(); ?> </span>
                        <span class="mx-2 animated incomplete text-dark small">
                    <?php echo !sectionCompleted($payload['form']->cms_form_id, SECTION_PL_ACCEPTANCE) ? '<i>[Project Leader Acceptance pending]</i>' : ''; ?>
                </span>
                    </a>
                </h6>
            </div>
            <div class="w-100 section <?php if (sectionCompleted($payload['form']->cms_form_id, SECTION_PL_ACCEPTANCE) && isProjectLeader(getUserSession()->user_id, $payload['form']->cms_form_id)) echo 'collapse'; ?>"
                 id="section_5">
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
                            <?php
                            $authorized_by = new User($payload['action_log'][ACTION_HOD_AUTHORISATION_COMPLETED]->performed_by);
                            ?>
                            <td class="text-right" style="width:17%"><b> Authorized by: </b></td>
                            <td scope="row" style="width:83%">
                                <?php echo getNameJobTitleAndDepartment($authorized_by->user_id); ?>
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
                                <?php echo getNameJobTitleAndDepartment($payload['form']->project_leader_id); ?>
                            </td>
                        </tr>
                        <?php
                        if (isProjectLeader(getUserSession()->user_id, $payload['form']->cms_form_id) && !sectionCompleted($payload['form']->cms_form_id, SECTION_PL_ACCEPTANCE)) { ?>
                            <tr>
                                <td class="text-right">
                                    <b>Project Leader Acceptance: </b>
                                </td>
                                <td>
                                    <form class="w-100" method="post"
                                          action="<?php echo URL_ROOT ?>/cms-forms/project-leader-acceptance/<?php echo $payload['form']->cms_form_id; ?>"
                                          role="form" data-toggle="validator" enctype="multipart/form-data">
                                        <div class="form-row form-group mb-1">
                                            <label class="col-sm-12"
                                                   for="project_leader_acceptance_comment">Comment:</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" id="project_leader_acceptance_comment"
                                                          name="project_leader_acceptance_comment" required></textarea>
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
                            if (!sectionCompleted($payload['form']->cms_form_id, SECTION_PL_ACCEPTANCE) && !isProjectLeader(getUserSession()->user_id, $payload['form']->cms_form_id)) { ?>
                                <tr>
                                    <td class="text-right"><b>Project Leader Acceptance: </b></td>
                                    <td scope="row">
                                        <?php echo '<b><i class="text-danger">Pending</i></b>'; ?>
                                    </td>
                                </tr>
                                <?php
                            } else { ?>
                                <tr>
                                    <td class="text-right"><b>Leader's Acceptance: </b></td>
                                    <td scope="row" class="">
                                        <?php echo "<span class='text-success'>Accepted</span>" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right"><b>Leader's Comment: </b></td>
                                    <td scope="row" class="">
                                        <?php echo $payload['form']->project_leader_acceptance_comment; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right"><b>Date: </b></td>
                                    <td scope="row">
                                        <?php echo returnDate($payload['form']->project_leader_acceptance_date); ?>
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
                                <div class="row">
                                    <div class="col-sm-2 text-sm-right">
                                        <b> Authorized by: </b>
                                    </div>
                                    <div class="col-sm-8">
                                        <?php echo getNameJobTitleAndDepartment($authorized_by->user_id); ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">
                                <div class="row">
                                    <div class="col-sm-2 text-sm-right">
                                        <b>HoD' Comment: </b>
                                    </div>
                                    <div class="col-sm-8">
                                        <?php echo $payload['form']->hod_authorization_comment; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">
                                <div class="row">
                                    <div class="col-sm-2 text-sm-right">
                                        <b>Project Leader: </b>
                                    </div>
                                    <div class="col-sm-8">
                                        <?php
                                        echo getNameJobTitleAndDepartment($payload['form']->project_leader_id); ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                        if (isProjectLeader(getUserSession()->user_id, $payload['form']->cms_form_id) && !sectionCompleted($payload['form']->cms_form_id, SECTION_PL_ACCEPTANCE)) { ?>
                            <tr>
                                <td>
                                    <div class="row px-2">
                                        <form class="w-100"
                                              action="<?php echo site_url("cms-forms/project-leader-acceptance/" . $payload['form']->cms_form_id) ?>"
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
                                            <b class="small"> <== Click this button to accept role as Project
                                                Leader </b>
                                            <input type="submit" class="d-none" value="Accept" id="accept">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } else {
                            ?>
                            <tr>
                                <td scope="row">
                                    <div class="row">
                                        <div class="col-sm-2 text-sm-right">
                                            <b>Leader's Acceptance: </b>
                                        </div>
                                        <div class="col-sm-8">
                                            <?php echo !sectionCompleted($payload['form']->cms_form_id, SECTION_PL_ACCEPTANCE) ? '<span class="text-danger">Pending</span>' :
                                                '<span class="text-success">' . ucwords($payload['form']->project_leader_acceptance) . '</span>'; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">
                                    <div class="row">
                                        <div class="col-sm-2 text-sm-right">
                                            <b>Leader's Comment: </b>
                                        </div>
                                        <div class="col-sm-8">
                                            <?php echo $payload['form']->project_leader_acceptance_comment; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">
                                    <div class="row">
                                        <div class="col-sm-2 text-sm-right">
                                            <b>Date: </b>
                                        </div>
                                        <div class="col-sm-8">
                                            <?php echo returnDate($payload['form']->project_leader_acceptance_date); ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    <?php }
} else {
    alert('Authorization for Change Implementation Pending...', 'text-primary text-bold alert');
}
?>