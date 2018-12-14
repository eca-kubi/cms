<?php require_once APP_ROOT .'\views\includes\header.php';?>
<?php require_once APP_ROOT .'\views\includes\navbar.php';?>
<?php require_once APP_ROOT .'\views\includes\sidebar.php';?>
<style>
    .dtr-data > input {
        display: inline !important;
    }

    .impact_tbl tr:not(.child) {
        counter-increment: rowNumber;
    }

    .impact_tbl tr:not(.child) td:first-child .row-n::before {
        content: counter(rowNumber) ". ";
        min-width: 1em;
        margin-right: 0.5em;
        margin-left: 0.5em;
    }

    #action_list tr:not(.child) {
        counter-increment: rowNumber;
    }

    #action_list tr:not(.child) td:first-child::before {
        content: counter(rowNumber);
        min-width: 1em;
        margin-right: 0.5em;
        margin-left: 0.5em;
    }
</style>
<!-- .content-wrapper -->
<div class="content-wrapper animated fadeInRight" style="margin-top: <?php echo NAVBAR_MT; ?>">
    <!-- .content-header-->
    <section class="content-header d-none">
        <!-- .container-fluid -->
        <div class="container-fluid">
            <!-- .row -->
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <a href="javascript: window.history.back();" class="btn w3-btn bg-gray">
                                <i class="fa fa-backward"></i> Go Back
                            </a>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <h1>
                        <?php echo APP_NAME; ?>
                    </h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header-->
    <!-- content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h5>
                    <?php flash('flash'); ?>
                </h5>
                <h3 class="box-title text-bold">
                    <?php echo $payload['title']; ?>
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="" method="post">
                    <div class="row p-2">
                        <h6 class="text-bold font-italic">
                            <a href="#section_1" data-toggle="collapse">
                                <i class="fa fa-plus" data-target="#section_1"></i> Section 1 - Proposed Change
                                <span class="text-muted">(Completed by - Originator)</span>
                            </a>
                        </h6>
                        <div class="w-100 section collapse" id="section_1">
                            <table class="table table-user-information font-raleway">
                                <thead class="thead-default d-none">
                                    <tr>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">Name: </td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Position: </td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Department: </td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Date: </td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Description of Change: </td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Advantages: </td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row" class="">Alternatives: </td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row" class="">Area Affected: </td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row" class="">Change Type: </td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row" class="">Additional Information: </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row p-2">
                        <h6 class="text-bold font-italic">
                            <a href="#section_2" data-toggle="collapse">
                                <i class="fa fa-plus" data-id></i> Section 2 - Further Assesment by HOD
                                <span class="text-muted">
                                    (Completed by HoD)
                                </span>
                            </a>
                        </h6>
                        <div class="w-100 section collapse" id="section_2">
                            <table class="table table-user-information font-raleway">
                                <thead class="thead-default d-none">
                                    <tr>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">HOD Approval: </td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Reasons: </td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Reference Number: </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row p-2">
                        <fieldset class="w-100">
                            <h6 class="text-bold font-italic">
                                <a href="#section_3" data-toggle="collapse">
                                    <i class="fa fa-minus" data-id></i> Section 3 - Risk Assessment
                                </a>
                            </h6>
                            <div id="section_3" class="collapse section show hide-child">
                                <div class="w-100">
                                    <table class="table table-user-information font-raleway ">
                                        <tr>
                                            <td>
                                                <button class="btn w3-btn bg-primary">Download Risk Assessment Document</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-12">
                                    <div class="pl-2">
                                        <h6 class="text-bold font-italic">
                                            <a href="#ohs" data-toggle="collapse">
                                                <i class="fa fa-minus"></i> Possible Impact - OHS
                                            </a>
                                        </h6>
                                        <div class="w-100 section collapse show hide-child" id="ohs">
                                            <table class="table table-user-information font-raleway impact_tbl">
                                                <thead class="thead-default">
                                                    <tr>
                                                        <th>Will this change:</th>
                                                        <th class="text-center">Response</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td scope="row">
                                                            <span class="row-n"></span>Require development of inspection routine?
                                                        </td>
                                                        <td scope="row" class="text-center">
                                                            Yes
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">
                                                            <span class="row-n"></span>Affect Health and/ or Safety commitments?
                                                        </td>
                                                        <td scope="row" class="text-center">
                                                            No
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="row p-2">
                        <fieldset class="w-100">
                            <h6 class="text-bold font-italic">
                                <a href="#section_4" data-toggle="collapse">
                                    <i class="fa fa-plus" data-id></i> Section 4 - General Manager's Approval
                                </a>
                                <span class="text-muted">(Completed by General Manager)</span>
                            </h6>
                            <div id="section_4" class="collapse section">
                                <table class="table table-user-information font-raleway">
                                    <thead class="thead-default d-none">
                                        <tr>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row">GM Approval: </td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Reasons: </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                    </div>
                    <div class="row p-2">
                        <fieldset class="w-100">
                            <h6 class="text-bold font-italic">
                                <a href="#section_5" data-toggle="collapse">
                                    <i class="fa fa-plus" data-id></i> Section 5 - Authorisation by HOD to Implement Change
                                    and Project Leader Acceptance
                                </a>
                            </h6>
                            <div id="section_5" class="collapse section">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-user-information font-raleway">
                                            <thead class="thead-default d-none">
                                                <tr>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td scope="row">HOD's Comments: </td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">Status: </td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">Project Leader's Comments: </td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">Status: </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="row p-2">
                        <h6 class="text-bold font-italic">
                            <a href="#section_6" data-toggle="collapse">
                                <i class="fa fa-minus" data-id></i> Section 6 - Action List 
                            </a>
                            <span class="text-muted">(To be Completed by Project Leader)</span>
                        </h6>
                        <div class="col-sm-12 collapse section show" id="section_6">
                            <table class="" id="action_list">
                                <thead class="thead-default">
                                    <tr>
                                        <th>No.</th>
                                        <th>Action to be Taken</th>
                                        <th>Responsible Person</th>
                                        <th>Date</th>
                                        <th>Completed?</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-8 text-right d-none">
                            <button type="submit" class="btn bg-success w3-btn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer"></div>
            <!-- /.box-footer-->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once APP_ROOT.'\views\includes\footer.php';?>