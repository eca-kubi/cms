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
    <!--    <link rel="stylesheet" href="<?php /*echo URL_ROOT; */ ?>/public/assets/css/datatables.min.css" />
-->
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/all.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/v4-shims.min.css"/>
    <!-- <link rel="stylesheet" href="<?php /*echo URL_ROOT; */ ?>/public/assets/css/kendo/kendo.common-bootstrap.min.css"/>-->
    <!--<link rel="stylesheet" href="<?php /*echo URL_ROOT; */ ?>/public/assets/css/kendo/kendo.bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php /*echo URL_ROOT; */ ?>/public/assets/css/kendo/kendo.mobile.all.min.css"/>
    <link rel="stylesheet" href="<?php /*echo URL_ROOT; */ ?>/public/assets/css/kendo/kendo.default.min.css"/>-->
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
                        <a href="http:<?php echo site_url("cms-forms/download-additional-info/" . $payload['form']->cms_form_id); ?>"
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
                <td class="text-sm-right" style="width:17%"><b>Title: </b></td>
                <td scope="row" style="width:83%">
                    <?php /** @var array $payload */
                    echo $payload['form']->title; ?>
                </td>
            </tr>
            <tr>
                <td class="text-sm-right" style="width:17%"><b>Originator: </b></td>
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
                    <?php echo returnDate($payload['action_log'][ACTION_START_CHANGE_PROCESS_COMPLETED]->date, true); ?>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</section>
<!--<a class="print-it no-print" href="javascript:window.print()"> </a>
-->
</body>
</html>
<!--<script src="<?php /*echo URL_ROOT; */ ?>/public/assets/js/jquery.min.js"></script>
<script src="<?php /*echo URL_ROOT; */ ?>/public/assets/js/jQuery-printPage/jquery.printPage.js"></script>
<script>
    $(function () {
        setTimeout(function () {
        $('.print-it').printPage();
        }, 200)
    })
</script>-->