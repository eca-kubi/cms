<?php require_once APP_ROOT .'\views\includes\header.php';?>
<?php require_once APP_ROOT .'\views\includes\navbar.php';?>
<?php require_once APP_ROOT .'\views\includes\sidebar.php';?>
<style>
    .dtr-data > input {
        display: inline!important;
    }
    #impact_tbl tr:not(.child) {
        counter-increment: rowNumber;
    }

        #impact_tbl tr:not(.child) td:first-child .row-n::before {
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
                    <?php echo $data['title']; ?>
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
                                    <span class="text-muted">
                                        <small>
                                            (Consider geographical location, processess,
                                        materials, equipment, machinery, costs, tasks, people, etc. Risk assessment
                                        to be conducted in terms of HSMP 2.01 PR - Health and Safety Identification
                                        and Risk Assessment Procedure. Attach risk assessment to this form)
                                        </small>
                                    </span>
                                </a>
                            </h6>
                            <div id="section_3" class="collapse show section">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-12">
                                                Risk Assessment Document
                                                <small>(Upload Risk Assessment Document)</small>
                                            </label>
                                            <div class="col-sm-8">
                                                <input
                                                    class="form-control" type="file" name="" aria-describedby="helpId" placeholder="" />
                                                <small id="helpId" class="form-text with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-12">Affected Departments</label>
                                            <div class="col-sm-8">
                                                <select
                                                    class="form-control bs-select" name="" aria-describedby="helpId" placeholder="" data-none-selected-text="Select Affected Departments"></select>
                                                <small id="helpId" class="form-text with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="col-sm-12">
                            <div class="pl-2">
                                <h6 class="text-bold font-italic">
                                    <a href="#ohs" data-toggle="collapse">
                                        <i class="fa fa-minus"></i> Possible Impact - OHS
                                    </a>
                                </h6>
                                <div class="w-100 section collapse show" id="ohs">
                                    <table class="table table-user-information font-raleway " id="impact_tbl">
                                        <thead class="thead-default">
                                            <tr>
                                                <th>Will this change:</th>
                                                <th class="text-center">Yes</th>
                                                <th class="text-center">No</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row"><span class="row-n"></span>Require development of inspection routine?</td>
                                                <td scope="row text-center">
                                                    <input type="checkbox" class="form-check mx-sm-auto" name="name" value="Yes" />
                                                </td>
                                                <td scope="row">
                                                    <input type="checkbox" class="form-check mx-sm-auto" name="name" value="No" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row"><span class="row-n"></span>Require development of inspection routine?</td>
                                                <td scope="row text-center">
                                                    <input type="checkbox" class="form-check mx-sm-auto" name="name" value="Yes" />
                                                </td>
                                                <td scope="row">
                                                    <input type="checkbox" class="form-check mx-sm-auto" name="name" value="No" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-right">
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