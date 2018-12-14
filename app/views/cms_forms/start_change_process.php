<?php require_once APP_ROOT .'\views\includes\header.php';?>
<?php require_once APP_ROOT .'\views\includes\navbar.php';?>
<?php require_once APP_ROOT .'\views\includes\sidebar.php';?>
<?php
$user = getUserSession();
?>
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
                <h3 class="box-title text-bold d-none">
                    <?php echo $payload['title']; ?>
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body pt-0">
                <form action="" method="post" data-toggle="validator" id="add_cms_form">
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
                                                       class="form-control" value="<?php echo ucwords($user->first_name . ' '. $user->last_name, '-. '); ?>" aria-describedby="helpId" placeholder="" readonly />
                                                <small id="helpId" class="form-text with-errors help-block"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-4 text-sm-right">Position</label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                       class="form-control text-capitalize" value="<?php echo $user->job_title; ?>" aria-describedby="helpId" placeholder="" readonly />
                                                <small id="helpId" class="form-text with-errors help-block"></small>
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
                                                       class="form-control" value="<?php echo $user->department->department; ?>" aria-describedby="helpId" placeholder="" readonly />
                                                <small id="helpId" class="form-text with-errors help-block"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-4 text-sm-right">Date</label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                       class="form-control" value="<?php echo (new DateTime())->format(DFF); ?>" aria-describedby="helpId" placeholder="" readonly />
                                                <small id="helpId" class="form-text with-errors help-block"></small>
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
                                                          class="form-control" name="change_description" aria-describedby="helpId" placeholder="" required></textarea>
                                                <small id="helpId" class="form-text with-errors help-block"></small>
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
                                                          class="form-control" name="advantages" aria-describedby="helpId" placeholder="" required></textarea>
                                                <small id="helpId" class="form-text with-errors help-block"></small>
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
                                                          class="form-control" name="alternatives" aria-describedby="helpId" placeholder=""></textarea>
                                                <small id="helpId" class="form-text with-errors help-block"></small>
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
                                                          class="form-control" name="area_affected" aria-describedby="helpId" placeholder="" required></textarea>
                                                <small id="helpId" class="form-text with-errors help-block"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-row">
                                            <label for="" class="col-sm-4 text-sm-right">
                                                Change Type
                                            </label>
                                            <div class="col-sm-8">
                                                <select class=" replace-multiple-select form-control">
                                                    <option class="d-none"></option>
                                                </select>
                                                <select class="form-control bs-select multiple-hidden d-none" data-none-selected-text="Select Change Type" name="change_type[]" id="change_type" aria-describedby="helpId" placeholder="" multiple="multiple" required>
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
                                                <small id="helpId" class="form-text text-muted help-block">Hint: Multiple Selection Possible</small>
                                                <small id="helpId" class="form-text with-errors help-block"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-row">
                                            <label for="" class="col-sm-4 text-sm-right">
                                                Additional Information
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="file"
                                                       class="form-control" name="additional_info" aria-describedby="helpId" placeholder="" accept="<?php echo DOC_FILE_TYPES; ?>" />
                                                <small class="help-block text-muted">Hint: Attach any additional information</small>
                                                <small id="helpId" class="form-text with-errors help-block"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-none">
                                    <div class="col-sm-6">
                                        <div class="form-group form-row" id="other_type">
                                            <label for="" class="col-sm-4 text-sm-right">
                                                Other Change Type <br /><small>(Insert other change type here)</small>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                       class="form-control" name="other_type" aria-describedby="helpId" placeholder="" />
                                                <small id="helpId" class="form-text with-errors help-block"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label class="col-sm-4 text-sm-right">Risk Measure</label>
                                            <div class="col-sm-8 radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="inlineCheckbox1" name="risk_level" value="Low" required>
                                                    <label class="form-check-label" for="inlineCheckbox1">Low</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="inlineCheckbox2" name="risk_level" value="Medium" required>
                                                    <label class="form-check-label" for="inlineCheckbox2">Medium</label>
                                                </div>
                                                <div class="form-check form-check-inline radio">
                                                    <input class="form-check-input" type="radio" id="inlineCheckbox3" name="risk_level" value="High" required>
                                                    <label class="form-check-label" for="inlineCheckbox3">  High</label>
                                                </div>
                                                <small class="help-block with-errors"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label class="col-sm-4 text-sm-right">Budget Measure</label>
                                            <div class="col-sm-8 radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="inlineCheckbox11" name="budget_level" value="Low" required>
                                                    <label class="form-check-label" for="inlineCheckbox11">Low</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="inlineCheckbox22" name="budget_level" value="Medium" required>
                                                    <label class="form-check-label" for="inlineCheckbox22">Medium</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="inlineCheckbox33" name="budget_level" value="High" required>
                                                    <label class="form-check-label" for="inlineCheckbox33">High</label>
                                                </div>
                                                <small class="help-block with-errors"></small>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-row">
                                            <label for="" class="col-sm-4 text-sm-right">
                                                Select HOD
                                            </label>
                                            <div class="col-sm-8">
                                                <select class="replace-multiple-select form-control">
                                                    <option></option>
                                                </select>
                                                <select class="form-control bs-select multiple-hidden d-none" data-none-selected-text="Select HOD to Approve" name="hod_id" id="hod_id" aria-describedby="helpId" placeholder="" required>
                                                    <option class="d-none"></option><?php
                                                   foreach ((array)$payload['hod'] as $value){
                                                       $hod = new User($value->user_id);
                                                   ?>
                                                    <option value="<?php echo $hod->user_id; ?>"><?php echo ucwords($hod->first_name. ' ' . $hod->last_name, '-. '). ' ('. $hod->job_title . ')'; ?></option><?php  }
                                                 ?>
                                                </select>
                                                <small id="helpId" class="form-text text-muted help-block d-none">Hint: Select HOD to Approve</small>
                                                <small id="helpId" class="form-text with-errors help-block"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 pl-lg-5 pl-md-5">
                                        <div class="form-group form-row">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="certify_details" required> <small class="text-bold">I hereby certify that the information I have provided above is true, complete and accurate.</small>
                                                </label>
                                                <small id="helpId" class="with-errors help-block"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-right">
                                        <div>
                                            <a href="javascript: window.history.back();" class="btn bg-danger w3-btn">Cancel</a>

                                            <button type="submit" class="btn bg-success w3-btn" form="add_cms_form">Submit</button>
                                        </div>
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