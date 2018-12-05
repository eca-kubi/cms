<?php require_once APP_ROOT .'\views\includes\header.php';?>
<?php require_once APP_ROOT .'\views\includes\navbar.php';?>
<?php require_once APP_ROOT .'\views\includes\sidebar.php';?>
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
                        <fieldset class="w-100">
                            <h6 class="text-bold font-italic">
                                <a href="#section_2" data-toggle="collapse">
                                    <i class="fa fa-minus" data-id></i> Section 2 - Further Assesment by HOD
                                    <span class="text-muted">
                                        (To be Completed by - HoD), (Reference Number to be generated
                                        by HOD who informs OHS Department for monitoring)
                                    </span>
                                </a>
                            </h6>
                            <div id="section_2" class="collapse show section">
                                <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="hod_approval" id="approved" value="approved" />
                                            <label class="form-check-label" for="approved">Approved</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="hod_approval" id="rejected" value="rejected" />
                                            <label class="form-check-label" for="rejected">Rejected</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="hod_approval" id="delayed" value="delayed" />
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
                                    <div class="col-sm-12">
                                        <div class="form-group form-row d-none" id="hod_ref_num">
                                            <label for="" class="col-sm-12">Reference Number <small>(Required only if approved)</small></label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                    class="form-control" name="" aria-describedby="helpId" placeholder="" />
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