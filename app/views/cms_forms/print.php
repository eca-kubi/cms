<?php /** @var array $payload */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Proposal, Assessment & Implementation</title>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/w3.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/adminlte.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/adminlte-miscellaneous.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/box-widget.css"/>
    <link rel="stylesheet" media="all" href="<?php echo URL_ROOT; ?>/public/assets/css/font-awesome.css"/>
    <link rel="stylesheet" media="all" href="<?php echo URL_ROOT; ?>/public/assets/css/all.css"/>
    <link rel="stylesheet" media="all" href="<?php echo URL_ROOT; ?>/public/assets/css/v4-shims.min.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT ?>/public/assets/css/shards.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/fonts.css"/>
    <link rel="stylesheet"
          href="<?php echo URL_ROOT; ?>/public/custom-assets/css/custom.css?<?php echo microtime(); ?>"/>
    <link rel="stylesheet" media="print"
          href="<?php echo URL_ROOT; ?>/public/custom-assets/css/print.css?<?php echo microtime(); ?>"/>
</head>
<body>
<section class="content pt-5">
    <header class="row container-fluid pt-3 border-bottom mb-5">
        <div class="col-11">
            <h5 class="font-raleway font-weight-bold mb-0">Change Proposal, Assessment & Implementation
            </h5>
            <small class="text-bold"> [TITLE - REF]</small>
        </div>
        <div class="col-1">
            <img class="img-size-64" src="<?php echo site_url("public/assets/images/adamus.jpg") ?>" alt="">
        </div>
    </header>
    <div id="main" class="">
        <table class="table table-bordered table-user-information font-raleway table-striped table-active">
            <thead class="thead-default">
            <tr>
                <th colspan="2">
                    <h6 class="font-italic mb-0">
                        <a href="<?php echo site_url("cms-forms/download-additional-info/" . $payload['form']->cms_form_id); ?>"
                           target="_blank" title="Download Attached Documents">Section 1 - Proposed Change <span
                                    class="mx-3"></span>
                            <small></small>
                        </a>
                    </h6>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-right" style="width:17%"><b>Originator: </b></td>
                <td scope="row" style="width:83%">
                    <?php echo getNameJobTitleAndDepartment($payload['form']->originator_id) ?>
                </td>
            </tr>
            <tr>
                <td class="text-right" style="width:17%"><b>Description: </b></td>
                <td scope="row" style="width:83%">
                    <?php echoIfEmpty($payload['form']->change_description, 'N/A'); ?>
                </td>
            </tr>
            <tr>
                <td class="text-right"><b>Advantages: </b></td>
                <td scope="row" class="">
                    <?php echoIfEmpty($payload['form']->advantages, 'N/A'); ?>
                </td>
            </tr>
            <tr>
                <td class="text-right"><b>Alternatives: </b></td>
                <td scope="row">
                    <?php echoIfEmpty($payload['form']->alternatives, 'N/A'); ?>
                </td>
            </tr>
            <tr>
                <td class="text-right"><b>Change Type:</b></td>
                <td scope="row">
                    <?php echo $payload['form']->change_type; ?>
                </td>
            </tr>
            <tr>
                <td class="text-right"><b>Areas Affected: </b></td>
                <td scope="row">
                    <?php echo $payload['form']->area_affected; ?>
                </td>
            </tr>
            <tr>
                <td class="text-right" style="width:17%"><b>Completed: </b></td>
                <td scope="row" style="width:83%">
                    <?php echo returnDate($payload['action_log'][ACTION_START_CHANGE_PROCESS_COMPLETED]->date, true); ?>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-user-information font-raleway table-striped table-active">
            <thead class="thead-default">
            <tr>
                <th colspan="2">
                    <h6 class="font-italic mb-0">
                        <a href="#" class="no-link">Section 2 - HoD's Approval</a>
                    </h6>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-right" style="width:17%"><b>HoD:</b></td>
                <td scope="row" style="width:83%">
                    <?php echo getNameJobTitleAndDepartment($payload['action_log'][ACTION_HOD_ASSESSMENT_COMPLETED]->performed_by); ?>
                </td>
            </tr>
            <tr>
                <td class="text-right" style="width:17%"><b>Status:</b></td>
                <td scope="row" style="width:83%"
                    class="<?php echo ($payload['form']->hod_approval == STATUS_REJECTED || $payload['form']->hod_approval == STATUS_DELAYED) ? 'text-danger' : 'text-success'; ?>">
                    <?php echo ucwords($payload['form']->hod_approval); ?>
                </td>
            </tr>
            <tr>
                <td class="text-right"><b>Reasons: </b></td>
                <td scope="row" class="">
                    <?php echo $payload['form']->hod_reasons; ?>
                </td>
            </tr>
            <tr>
                <td class="text-right"><b>Completed:</b></td>
                <td scope="row" class="">
                    <?php echo returnDate($payload['action_log'][ACTION_HOD_ASSESSMENT_COMPLETED]->date, true); ?>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-user-information font-raleway table-striped table-active">
            <thead class="thead-default">
            <tr>
                <th colspan="3">
                    <h6 class="font-italic mb-0">
                        <a href="#" class="no-link">Section 3 - Risk & Impact Assessment</a>
                    </h6>
                </th>
            </tr>
            <?php
            $department_count = count($payload['affected_departments']);
            foreach ($payload['affected_departments'] as $department) {
            $can_assess_impact_for_dept = canAssessImpactForDept($department->department_id);
            $questions = getImpactQuestions($department->department_id);
            $impact_ass_status = new ImpactAssStatusModel(['department_id' => $department->department_id, 'cms_form_id' => $payload['form']->cms_form_id]);
            if (!empty($questions)) { ?>
            <tr>
                <th colspan="3" class="text-bold">Impact Assessment for <?php echo $department->department ?></th>
            </tr>
            <tr>
                <th>Will this change:</th>
                <th class="text-center">Yes</th>
                <th class="text-center">No</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($questions as $question) {
                $response = getResponseForQuestion($question->cms_impact_question_id, $payload['form']->cms_form_id)->response; ?>
                <tr>
                    <td><?php echo $question->question; ?></td>
                    <td class="text-center"><?php echo $response == 'Yes' ? '<i class="fa fa-check"></i>' : ''; ?></td>
                    <td class="text-center"><?php echo $response == 'No' ? '<i class="fa fa-check"></i>' : ''; ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-2 border-right text-right">Completed By:</div>
                        <div class="col-10"><?php echo getNameJobTitleAndDepartment($impact_ass_status->completed_by) ?></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-2 border-right text-right">Comment:</div>
                        <div class="col-10"> <?php echo $impact_ass_status->hod_comment; ?></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-2 border-right text-right">Date:</div>
                        <div class="col-10"><?php echo returnDate($impact_ass_status->completed_date, true); ?></div>
                    </div>
                </td>
            </tr>
            <?php }
            }
            ?>
            </tbody>
        </table>
        <table class="table table-bordered table-user-information font-raleway table-striped table-active">
            <thead class="thead-default">
            <tr>
                <th colspan="2">
                    <h6 class="font-italic mb-0">
                        <a href="#" class="no-link">Section 4 - GM's Approval</a>
                    </h6>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-right" style="width:17%"><b>GM:</b></td>
                <td scope="row" style="width:83%">
                    <?php echo getNameJobTitleAndDepartment($payload['action_log'][ACTION_GM_ASSESSMENT_COMPLETED]->performed_by); ?>
                </td>
            </tr>
            <tr>
                <td class="text-right" style="width:17%"><b>Status:</b></td>
                <td scope="row" style="width:83%"
                    class="<?php echo ($payload['form']->gm_approval == STATUS_REJECTED) ? 'text-danger' : 'text-success'; ?>">
                    <?php echo ucwords($payload['form']->gm_approval); ?>
                </td>
            </tr>
            <tr>
                <td class="text-right"><b>Reasons: </b></td>
                <td scope="row" class="">
                    <?php echo $payload['form']->gm_approval_reasons; ?>
                </td>
            </tr>
            <tr>
                <td class="text-right"><b>Completed:</b></td>
                <td scope="row" class="">
                    <?php echo returnDate($payload['action_log'][ACTION_GM_ASSESSMENT_COMPLETED]->date, true); ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</section>
</body>
</html>