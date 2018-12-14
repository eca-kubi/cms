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
                                    <i class="fa fa-minus" data-id></i> Section 4 - by General Manager
                                    <span class="text-muted">
                                        (General Manager's approval required if out of budget and risk is high)
                                    </span>
                                </a>
                            </h6>
                            <div id="section_4" class="collapse show section">
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gm_approval" id="approved" value="approved" />
                                                <label class="form-check-label" for="approved">Approved</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gm_approval" id="rejected" value="rejected" />
                                                <label class="form-check-label" for="rejected">Rejected</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gm_approval" id="delayed" value="delayed" />
                                                <label class="form-check-label" for="delayed">Delayed</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-row">
                                                <label for="" class="col-sm-12">Reasons</label>
                                                <div class="col-sm-8">
                                                    <textarea
                                                        class="form-control" name="" aria-describedby="helpId" placeholder=""></textarea>
                                                    <small id="helpId" class="form-text with-errors"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 text-right">
                                            <button type="submit" class="btn bg-success w3-btn">Submit</button>
                                        </div>
                                    </div>
                                </div>
                        </fieldset>                                                                    
                        <div class="col-sm-12 text-right d-none">
                            <button type="submit" class="btn bg-success w3-btn">Submit</button>
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