<?php /** @var  array $payload */
if (sectionCompleted($payload['form']->cms_form_id, SECTION_HOD_AUTHORISATION) && !empty($payload['form']->project_leader_acceptance)) { ?>
    <div class="row p-2">
        <form class="w-100"
              action="<?php echo URL_ROOT . '/cms-forms/action-list/' . $payload['form']->cms_form_id ?>"
              method="post" data-toggle="validator" role="form"
              enctype="multipart/form-data">
            <fieldset class="w-100">
                <div class="w-100 row border ml-0 p-1">
                    <h6 class="text-bold font-italic col m-1">
                        <a href="#section_6" data-toggle="collapse">
                            <i class="fa <?php echo ICON_FA_PLUS ?>"></i> Section 6 - Action List
                            <span class="small animated incomplete text-dark font-italic">
                                [To be Completed by Project Leader]
                            </span>
                        </a>
                    </h6>
                    <span class="text-right float-right invisible">
                        <a href="#" title="Edit this section">
                        <i class="fa fa-edit"></i>
                    </a>
                </span>
                </div>
                <input type="hidden" id="cms_form_id" value="<?php echo $payload['form']->cms_form_id; ?>">
                <div id="section_6" class="collapse section border p-3">
                    <div class="row hide-on-init invisible">
                        <?php
                        if (isProjectLeader(getUserSession()->user_id, $payload['form']->cms_form_id)) { ?>
                            <table id="action_list">
                                <thead class="thead-default">
                                <tr>
                                    <th>No.</th>
                                    <th>Action to be Taken</th>
                                    <th>Responsible</th>
                                    <th>Completed?</th>
                                    <th>Date</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                            </table>
                        <?php }
                        ?>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
<?php } else {
    alert('Action List Pending...', 'alert text-primary text-bold');
}
?>

