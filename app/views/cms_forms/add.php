2<?php require_once APP_ROOT .'\views\includes\header.php';?>
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
                        <fieldset class="w-100">
                            <h6 class="text-bold font-italic">
                                <a href="#section_1" data-toggle="collapse">
                                    <i class="fa fa-minus"></i>   Section 1 - Proposed Change
                                    <span class="text-muted">(To be Completed by - Originator)</span>
                                </a>
                            </h6>
                            <div id="section_1" class="collapse show section">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-4 text-sm-right">Name</label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                    class="form-control" name="" aria-describedby="helpId" placeholder="" />
                                                <small id="helpId" class="form-text with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-4 text-sm-right">Position</label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                    class="form-control" name="" aria-describedby="helpId" placeholder="" />
                                                <small id="helpId" class="form-text with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-4 text-sm-right">Department</label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                    class="form-control" name="" aria-describedby="helpId" placeholder="" />
                                                <small id="helpId" class="form-text with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-4 text-sm-right">Date</label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                    class="form-control" name="" aria-describedby="helpId" placeholder="" />
                                                <small id="helpId" class="form-text with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-4 text-sm-right">
                                                Description of Change
                                            </label>
                                            <div class="col-sm-8">
                                                <textarea type="text"
                                                    class="form-control" name="" aria-describedby="helpId" placeholder=""></textarea>
                                                <small id="helpId" class="form-text with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-4 text-sm-right">
                                                Advantages 
                                            </label>
                                            <div class="col-sm-8">
                                                <textarea type="text"
                                                    class="form-control" name="" aria-describedby="helpId" placeholder=""></textarea>
                                                <small id="helpId" class="form-text with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-4 text-sm-right">
                                                Alternatives
                                            </label>
                                            <div class="col-sm-8">
                                                <textarea type="text"
                                                    class="form-control" name="" aria-describedby="helpId" placeholder=""></textarea>
                                                <small id="helpId" class="form-text with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-4 text-sm-right">
                                                Area Affected
                                            </label>
                                            <div class="col-sm-8">
                                                <textarea type="text"
                                                    class="form-control" name="" aria-describedby="helpId" placeholder=""></textarea>
                                                <small id="helpId" class="form-text with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-4 text-sm-right">
                                                Change Type
                                            </label>
                                            <div class="col-sm-8">
                                                <select type="text"
                                                    class="form-control bs-select" data-none-selected-text="Select Change Type" name="" id="change_type" aria-describedby="helpId" placeholder="" multiple="multiple">
                                                    <option value="Staff/Labour">Staff/Labour</option>
                                                    <option value="Procedural">Procedural</option>
                                                    <option value="Equipment/Machinery">Equipment/Machinery</option>
                                                    <option value="Plant/Infrastructure">Plant/Infrastructure</option>
                                                    <option value="Materials/Chemicals">Materials/Chemicals</option>
                                                    <option value="Supply/Distribution">Supply/Distribution</option>
                                                    <option value="Operational">Operational</option>
                                                    <option value="Cyanide">Cyanide</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <small id="helpId" class="form-text with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-4 text-sm-right">
                                                Additional Information <small>(Attach any additional information)</small>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="file"
                                                    class="form-control" name="" aria-describedby="helpId" placeholder="" />
                                                <small id="helpId" class="form-text with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-sm-6">
                                        <div class="form-group form-row d-none" id="other_type">
                                            <label for="" class="col-sm-4 text-sm-right">
                                                Other Change Type <br/><small>(Insert other change type here)</small>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                    class="form-control" name="" aria-describedby="helpId" placeholder="" />
                                                <small id="helpId" class="form-text with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="col-sm-6 text-right">
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