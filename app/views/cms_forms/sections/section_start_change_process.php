<div class="row p-2">
    <span class="row w-100 border ml-0 p-1">
        <h6 class="text-bold font-italic col m-1">
            <a href="#section_1" data-toggle="collapse">
                <i class="fa fa-plus" data-target="#section_1"></i> Section 1 - Proposed Change
                <span class="text-muted d-sm-inline d-block">(Completed by  <?php echo concatName([$payload['originator']->first_name, $payload['originator']->last_name]); ?>
                    - <i><?php echo $payload['originator']->job_title; ?>)</i></span>
            </a>
        </h6>
        <span class="text-right float-right d-none">
            <?php /** @var array $payload */
            if (isOriginator($payload['form']->cms_form_id, getUserSession()->user_id) && empty($payload['form']->hod_approval)) { ?>
                <a href="#" title="Edit this section">
                <i class="fa fa-edit"></i>
            </a>
            <?php } ?>
        </span>
    </span>
    <div class="w-100 section collapse" id="section_1">
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
                            <span class="col-sm-4 text-sm-right">
                                <b>Name: </b>
                            </span>
                            <span class="col-sm-8">
                                <?php echo ucwords($payload['originator']->first_name . ' ' . $payload['originator']->last_name); ?>
                            </span>
                        </span>
                </td>
                <td scope="row">
                        <span class="row">
                            <span class="col-sm-4 text-sm-right">
                                <b>Position: </b>
                            </span>
                            <span class="col-sm-8">
                                <?php echo $payload['originator']->job_title; ?>
                            </span>
                        </span>
                </td>
            </tr>
            <tr>
                <td scope="row">
                        <span class="row">
                            <span class="col-sm-4 text-sm-right">
                                <b>Department:  </b>
                            </span>
                            <span class="col-sm-8">
                                <?php echo $payload['originator']->department->department; ?>
                            </span>
                        </span>
                </td>
                <td scope="row">
                        <span class="row">
                            <span class="col-sm-4 text-sm-right">
                                <b>Date:</b>
                            </span>
                            <span class="col-sm-8">
                                <?php echo formatDate($payload['form']->date_raised, DFB, DFF); ?>
                            </span>
                        </span>
                </td>
            </tr>
            <tr>
                <td scope="row">
                        <span class="row">
                            <span class="col-sm-4 text-sm-right">
                                <b>Description: </b>
                            </span>
                            <span class="col-sm-8">
                                <?php echoIfEmpty($payload['form']->change_description, 'N/A'); ?>
                            </span>
                        </span>
                </td>
                <td scope="row">
                        <span class="row">
                            <span class="col-sm-4 text-sm-right">
                                <b>Advantage: </b>
                            </span>
                            <span class="col-sm-8">
                                <?php echoIfEmpty($payload['form']->advantages, 'N/A'); ?>
                            </span>
                        </span>
                </td>
            </tr>
            <tr>
                <td scope="row">
                        <span class="row">
                            <span class="col-sm-4 text-sm-right">
                                <b>Alternatives: </b>
                            </span>
                            <span class="col-sm-8">
                                <?php echoIfEmpty($payload['form']->alternatives, 'N/A'); ?>
                            </span>
                        </span>
                </td>
                <td scope="row">
                        <span class="row">
                            <span class="col-sm-4 text-sm-right">
                                <b>Area Affected: </b>
                            </span>
                            <span class="col-sm-8">
                                <?php echo $payload['form']->area_affected; ?>
                            </span>
                        </span>
                </td>
            </tr>
            <tr>
                <td scope="row">
                        <span class="row">
                            <span class="col-sm-4 text-sm-right">
                                <b>Change Type:</b>
                            </span>
                            <span class="col-sm-8">
                                <?php echo $payload['form']->change_type; ?>
                            </span>
                        </span>
                </td>
                <td scope="row">
                        <span class="row">
                            <span class="col-sm-4 text-sm-right">
                                <b>Additional Info: </b>
                            </span>
                            <span class="col-sm-8">
                                <?php if (!empty($payload['form']->additional_info)) { ?>
                                <a href="<?php echo URL_ROOT . '/cms-forms/download-additional-info/' . $payload['form']->cms_form_id; ?>"
                                   target="_blank"
                                   class="btn btn-primary" title="Download Additional Information">
                                        <span class="text-sm">Download</span>
                                    </a><?php } else {
                                    echoIfEmpty($payload['form']->additional_info, 'N/A');
                                } ?>
                            </span>
                        </span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>