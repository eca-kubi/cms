<?php /** @var  array $payload */
if (sectionCompleted($payload['form']->cms_form_id, SECTION_HOD_AUTHORISATION) && !empty($payload['form']->project_leader_acceptance)) { ?>
    <div class="row p-2">
        <div class="w-100 row border ml-0 p-1">
            <h6 class="text-bold font-italic col m-1">
                <a href="#section_6" data-toggle="collapse">
                    <i class="fa <?php echo ICON_FA_PLUS ?>"></i> Section 6 - Action List
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
            </h6>
            <span class="text-right float-right invisible">
                        <a href="#" title="Edit this section">
                        <i class="fa fa-edit"></i>
                    </a>
                </span>
        </div>
        <input type="hidden" id="cms_form_id" value="<?php echo $payload['form']->cms_form_id; ?>">
        <div id="section_6" class="collapse section border table-active"
             style="position:relative; min-height: 520px;min-width: 100%">
            <?php
            if (isProjectLeader(getUserSession()->user_id, $payload['form']->cms_form_id) && !sectionCompleted($payload['form']->cms_form_id, SECTION_ACTION_LIST)) { ?>
                <div id="action_list"></div>
            <?php } else { ?>
                <div id="action-list-read-only"></div>
                <div>
                    <table class="table-striped table-active table table-bordered table-user-information font-raleway mb-0">
                        <tr>
                            <td>
                                Completed
                                by <?php echo getNameJobTitleAndDepartment($payload['form']->project_leader_id); ?>
                                on <?php echo returnDate($payload['form']->project_leader_close_change, true) ?>
                            </td>
                        </tr>
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

