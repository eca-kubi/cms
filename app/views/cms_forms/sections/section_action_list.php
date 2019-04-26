<?php /** @var  array $payload */
//sectionCompleted($payload['form']->cms_form_id, SECTION_HOD_AUTHORISATION) && !empty($payload['form']->project_leader_acceptance
if (sectionCompleted($payload['form']->cms_form_id, SECTION_HOD_AUTHORISATION) && sectionCompleted($payload['form']->cms_form_id, SECTION_PL_ACCEPTANCE)) { ?>
    <div class="row p-2">
        <div class="w-100 row border ml-0 p-1">
            <h6 class="text-bold font-italic col m-1">
                <a href="#section_6" data-toggle="collapse">
                    <i class="fa <?php echo ICON_FA_MINUS ?>"></i> Section 6 - Action List
                    <?php if (sectionCompleted($payload['form']->cms_form_id, SECTION_ACTION_LIST)) {
                        echo echoCompleted();
                    } else {
                        echo <<<heredoc
<span class="small animated text-bold text-dark font-italic">
                                [To be Completed by Project Leader]
                    </span>
heredoc;
                    } ?>
                </a>
                <?php
                if (!empty($payload['form']->pl_documents)) {
                    ?>
                    <span class="mx-2"></span>
                    <a
                            href="<?php echo URL_ROOT . '/cms-forms/download-pl-documents/' . $payload['form']->cms_form_id; ?>"
                            target="_blank"
                            title="Download Attached Documents"
                            class="">
                        <span class="text-sm badge badge-success"> <i class="fa fa-file-download"></i> Download Attached Documents</span>
                    </a>
                    <?php
                } ?>
                <span class="mx-2"></span>
                <?php
                if ($payload['form']->project_leader_id === getUserSession()->user_id) { ?>
                    <!--suppress HtmlUnknownAnchorTarget -->
                    <a
                            data-toggle="modal"
                            href="#uploadPlDoc"
                            target="_blank"
                            title="Upload More Documents"
                            class="">
                        <span class="text-sm badge badge-info"> <i
                                    class="fa fa-file-upload"></i> Upload Documents</span>
                    </a>
                <?php }
                ?>

            </h6>
            <span class="text-right float-right invisible">
                        <a href="#" title="Edit this section">
                        <i class="fa fa-edit"></i>
                    </a>
                </span>
        </div>
        <input type="hidden" id="cms_form_id" value="<?php echo $payload['form']->cms_form_id; ?>">
        <div id="section_6"
             class="section border table-active <?php if (!empty($payload['form']->project_leader_close_change)) {
                 echo 'collapse';
             } ?>"
             style="position:relative; /*min-height: 520px*/;min-width: 100%">
            <?php
            if (isProjectLeader(getUserSession()->user_id, $payload['form']->cms_form_id) && sectionCompleted($payload['form']->cms_form_id, SECTION_PL_ACCEPTANCE) && !sectionCompleted($payload['form']->cms_form_id, SECTION_ACTION_LIST)) { ?>
                <div id="action_list"></div>
            <?php } else {
                ?>
                <!--                <div id="action-list-read-only"></div>
                -->
                <div>
                    <table class="table-striped table-active table table-bordered table-user-information font-raleway mb-0">
                        <thead class="thead-default">
                        <tr>
                            <th colspan="4">
                                <h6 class="font-italic mb-0">
                                    <a href="#" class="no-link">Section 6 - Action List</a>
                                </h6>
                            </th>
                        </tr>
                        <tr>
                            <th>Action</th>
                            <th>Person Responsible</th>
                            <th>Completed</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $action_list = getActionList();
                        foreach ($action_list as $al) { ?>
                            <tr>
                                <td><?php echo $al->action ?></td>
                                <td><?php echo $al->person_responsible ?></td>
                                <td><?php echo $al->completed ? 'Yes' : 'No' ?></td>
                                <td><?php echo returnDate($al->date, true) ?></td>
                            </tr>
                        <?php }
                        ?>
                        <?php
                        if (empty($action_list)) { ?>
                            <tr class="text-center">
                                <td colspan="4"><span class="badge border callout callout-success">No data!</span></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <?php if (!empty($payload['form']->project_leader_close_change) && !empty($action_list)) { ?>
                            <tr>
                                <td colspan="4">
                                    Completed
                                    by <?php echo getNameJobTitleAndDepartment($payload['form']->project_leader_id); ?>
                                    on <?php echo returnDate($payload['form']->project_leader_close_change, true) ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php }
            ?>
        </div>
    </div>
<?php } else {
    alert('Action List Pending...', 'alert text-primary text-bold');
}
?>

