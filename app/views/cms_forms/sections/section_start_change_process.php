<div class="row p-2">
    <div class="row w-100 border ml-0 p-1">
        <h6 class="text-bold font-italic col m-1">
            <a href="#section_1" data-toggle="collapse">
                <i class="fa <?php echo ICON_FA_PLUS ?>" data-target="#section_1"></i> Section 1 - Proposed Change
                <?php echo echoCompleted(); ?>
            </a>
            <span class="mx-2"></span>
            <a
                    href="<?php /** @var array $payload */
                    echo URL_ROOT . '/cms-forms/download-additional-info/' . $payload['form']->cms_form_id; ?>"
                    target="_blank"
                    title="Download Attached Documents"
                    class="">
                <span class="text-sm badge badge-success"> <i class="fa fa-file-download"></i> Download Attached Documents</span>
            </a>
            <span class="mx-2"></span>
            <a
                    data-toggle="modal"
                    href="#uploadAddDoc"
                    target="_blank"
                    title="Upload More Documents"
                    class="">
                <span class="text-sm badge badge-info"> <i class="fa fa-file-upload"></i> Upload More Documents</span>
            </a>
        </h6>
        <span class="text-right float-right d-none">
            <?php /** @var array $payload */ //todo: Consider sections as database tables in the future.
            if (isOriginator($payload['form']->cms_form_id, getUserSession()->user_id) && empty($payload['form']->hod_approval)) { ?>
                <a href="#" title="Edit this section">
                <i class="fa fa-edit"></i>
            </a>
            <?php } ?>
        </span>
    </div>
    <div class="w-100 section collapse" id="section_1">
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
                    <td class="text-sm-right" style="width:17%"><b>Title: </b></td>
                    <td scope="row" style="width:83%">
                        <?php echo $payload['form']->title; ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-sm-right" style="width:17%"><b>By: </b></td>
                    <td scope="row" style="width:83%">
                        <?php echo getNameJobTitleAndDepartment($payload['form']->originator_id) ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-sm-right" style="width:17%"><b>Description: </b></td>
                    <td scope="row" style="width:83%">
                        <?php echoIfEmpty($payload['form']->change_description, 'N/A'); ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-sm-right"><b>Advantages: </b></td>
                    <td scope="row" class="">
                        <?php echoIfEmpty($payload['form']->advantages, 'N/A'); ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-sm-right"><b>Alternatives: </b></td>
                    <td scope="row">
                        <?php echoIfEmpty($payload['form']->alternatives, 'N/A'); ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-sm-right"><b>Change Type:</b></td>
                    <td scope="row">
                        <?php echo $payload['form']->change_type; ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-sm-right"><b>Areas Affected: </b></td>
                    <td scope="row">
                        <?php echo $payload['form']->area_affected; ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-sm-right" style="width:17%"><b>Completed: </b></td>
                    <td scope="row" style="width:83%">
                        <?php echo returnDate($payload['action_log'][ACTION_START_CHANGE_PROCESS_COMPLETED]->date) ?>
                    </td>
                </tr>
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
                            <span class="col-sm-4 text-sm-right">
                                <b>Title: </b>
                            </span>
                            <span class="col-sm-8">
                                <?php echo $payload['form']->change_description; ?>
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">
                        <div class="row">
                        <span class="col-sm-4 text-sm-right">
                            <b>Description: </b>
                        </span>
                            <span class="col-sm-8">
                            <?php echoIfEmpty($payload['form']->change_description, 'N/A'); ?>
                        </span>
                        </div>
                    </td>
                </tr>
                <!--<tr>
                    <td scope="row">
                        <div class="row">
                        <span class="col-sm-4 text-sm-right">
                            <b>Additional Info: </b>
                        </span>
                            <span class="col-sm-8">
                            <?php /*if (!empty($payload['form']->additional_info)) { */ ?>
                            <a href="<?php /*echo URL_ROOT . '/cms-forms/download-additional-info/' . $payload['form']->cms_form_id; */ ?>"
                               target="_blank"
                               class="" title="Download Attached Information">
                                    <span class="text-sm badge badge-success"> <i class="fa fa-file-download"></i> Download Attached Documents</span>
                                </a><?php /*} else {
                                echoIfEmpty($payload['form']->additional_info, 'N/A');
                            } */ ?>
                        </span>
                        </div>
                    </td>
                </tr>-->
                <tr>
                    <td scope="row" class="">
                        <div class="row">
                        <span class="col-sm-4 text-sm-right">
                            <b>Advantages: </b>
                        </span>
                            <span class="col-sm-8">
                            <?php echoIfEmpty($payload['form']->advantages, 'N/A'); ?>
                        </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">
                        <div class="row">
                        <span class="col-sm-4 text-sm-right">
                            <b>Alternatives: </b>
                        </span>
                            <span class="col-sm-8">
                            <?php echoIfEmpty($payload['form']->alternatives, 'N/A'); ?>
                        </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">
                        <div class="row">
                        <span class="col-sm-4 text-sm-right">
                            <b>Change Type:</b>
                        </span>
                            <span class="col-sm-8">
                            <?php echo $payload['form']->change_type; ?>
                        </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">
                        <div class="row">
                        <span class="col-lg-2 text-sm-right">
                            <b>Areas Affected: </b>
                        </span>
                            <span class="col-sm-8">
                            <?php echo $payload['form']->area_affected; ?>
                        </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">
                        <div class="row">
                        <span class="col-lg-2 text-sm-right">
                            <b>Completed: </b>
                        </span>
                            <span class="col-sm-8">
                            <?php echo returnDate($payload['action_log'][ACTION_START_CHANGE_PROCESS_COMPLETED]->date); ?>
                        </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">
                        <div class="row">
                        <span class="col-lg-2 text-sm-right">
                            <b>By: </b>
                        </span>
                            <span class="col-sm-8">
                            <?php echo getNameJobTitleAndDepartment($payload['form']->originator_id); ?>
                        </span>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>