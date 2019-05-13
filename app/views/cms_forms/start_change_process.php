<?php require_once APP_ROOT . '\views\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\includes\navbar.php'; ?>
<?php require_once APP_ROOT . '\views\includes\sidebar.php'; ?>
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
                        <?php flash('flash_start_change_process'); ?>
                    </h5>
                    <h3 class="box-title text-bold d-none">
                        <?php /** @var array $payload */
                        echo $payload['title']; ?>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body pt-0">
                    <form action="" method="POST" data-toggle="validator" id="add_cms_form"
                          onsubmit=" checkHODAssignment()"
                          enctype="multipart/form-data">
                        <div class="row p-2 border">
                            <fieldset class="w-100">
                                <h6 class="text-bold font-italic">
                                    <a href="#section_1" data-toggle="collapse">
                                        <i class="fa fa-minus"></i> Section 1 - Proposed Change
                                        <span class="text-muted">(To be Completed by - Originator)</span>
                                    </a>
                                </h6>
                                <div id="section_1" class="collapse show section">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label for="title" class="col-sm-4 text-sm-right">
                                                    Title
                                                </label>
                                                <div class="col-sm-8">
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend cursor-pointer"
                                                             title="Click to add more files.">
                                                            <div class="input-group-text"><?php echo $payload['reference']; ?>
                                                                -
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" id="title" name="title"
                                                               placeholder="Enter a title for your Change" required>
                                                    </div>
                                                    <small class="form-text  text-danger text-bold">
                                                        Hint: <i>Mandatory</i>
                                                    </small>
                                                    <small class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label for="" class="col-sm-4 text-sm-right">Department</label>
                                                <div class="col-sm-8">
                                                    <input type="text"
                                                           class="form-control"
                                                           value="<?php echo getDepartment($user->user_id); ?>"
                                                           aria-describedby="helpId" placeholder="" readonly/>
                                                    <small id="helpId" class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>

                                        <!--<div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label for="" class="col-sm-4 text-sm-right">Position</label>
                                                <div class="col-sm-8">
                                                    <input type="text"
                                                           class="form-control text-capitalize"
                                                           value="<?php /*echo $user->job_title; */ ?>"
                                                           aria-describedby="helpId" placeholder="" readonly/>
                                                    <small id="helpId" class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>-->
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label for="" class="col-sm-4 text-sm-right">Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text"
                                                           class="form-control"
                                                           value="<?php echo ucwords($user->first_name . ' ' . $user->last_name, '-. ') . " ($user->job_title)"; ?>"
                                                           aria-describedby="helpId" placeholder="" readonly/>
                                                    <small id="helpId" class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label for="" class="col-sm-4 text-sm-right">Date</label>
                                                <div class="col-sm-8">
                                                    <input type="text"
                                                           class="form-control"
                                                           value="<?php try {
                                                               echo (new DateTime())->format(DFF);
                                                           } catch (Exception $e) {
                                                           } ?>"
                                                           aria-describedby="helpId" placeholder="" readonly/>
                                                    <small id="helpId" class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label for="change_description" class="col-sm-4 text-sm-right">
                                                    Description of Change
                                                </label>
                                                <div class="col-sm-8">
                                          <textarea type="text"
                                                    class="form-control" name="change_description"
                                                    id="change_description"
                                                    aria-describedby="helpId" placeholder="" required></textarea>
                                                    <small id="helpId" class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label for="advantages" class="col-sm-4 text-sm-right">
                                                    Advantages
                                                </label>
                                                <div class="col-sm-8">
                                                <textarea type="text"
                                                          class="form-control" name="advantages" id="advantages"
                                                          aria-describedby="helpId" placeholder="" required></textarea>
                                                    <small id="helpId" class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label for="alternatives" class="col-sm-4 text-sm-right">
                                                    Alternatives
                                                </label>
                                                <div class="col-sm-8">
                                                <textarea type="text"
                                                          class="form-control" name="alternatives" id="alternatives"
                                                          aria-describedby="helpId" placeholder=""></textarea>
                                                    <small id="helpId" class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label for="area_affected" class="col-sm-4 text-sm-right">
                                                    Area Affected
                                                </label>
                                                <div class="col-sm-8">
                                                <textarea type="text"
                                                          class="form-control" name="area_affected" id="area_affected"
                                                          aria-describedby="helpId" placeholder="" required></textarea>
                                                    <small id="helpId" class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label for="change_type" class="col-sm-4 text-sm-right">
                                                    Change Type
                                                </label>
                                                <div class="col-sm-8">
                                                    <label class="d-none" for="change_type2">
                                                    </label>
                                                    <select class="replace-multiple-select form-control"
                                                            id="change_type2">
                                                        <option class="d-none"></option>
                                                    </select>
                                                    <select class="form-control bs-select multiple-hidden d-none"
                                                            data-none-selected-text="Select Change Type"
                                                            name="change_type[]" id="change_type"
                                                            aria-describedby="helpId" multiple="multiple"
                                                            data-size="6"
                                                            required>
                                                        <option data-value="Staff/Labour" value="Staff/Labour">
                                                            Staff/Labour
                                                        </option>
                                                        <option data-value="" value="Procedural">Procedural</option>
                                                        <option value="Equipment/Machinery">Equipment/Machinery</option>
                                                        <option value="Plant/Infrastructure">Plant/Infrastructure
                                                        </option>
                                                        <option value="Materials/Chemicals">Materials/Chemicals</option>
                                                        <option value="Supply/Distribution">Supply/Distribution</option>
                                                        <option value="Operational">Operational</option>
                                                        <option value="Cyanide">Cyanide</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                    <small class="form-text text-muted">Hint:
                                                        Multiple Selection Possible
                                                    </small>
                                                    <small class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-row multiple-form-group" data-max="3">
                                                <label for="" class="col-sm-4 text-sm-right">
                                                    Additional Information <br>
                                                    <small>(Maximum of three)</small>
                                                </label>
                                                <div class="col-sm-8 form-group">
                                                    <div class="input-group">
                                                        <input accept="<?php echo DOC_FILE_TYPES; ?>"
                                                               class="form-control" name="additional_info[]"
                                                               required type="file"/>
                                                        <div class="input-group-append cursor-pointer"
                                                             title="Click to add more files.">
                                                            <div class="input-group-text add-input"><i
                                                                        class="fas fa-plus-square text-success"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <small class="help-block text-muted">Hint: Attach any additional
                                                        documents
                                                    </small>
                                                    <small id="helpId" class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 d-none" id="other_type">
                                            <div class="form-group form-row">
                                                <label for="other_change_type" class="col-sm-4 text-sm-right">
                                                    Other Change Type <br/>
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="text"
                                                           class="form-control" name="other_type" id="other_change_type"
                                                           aria-describedby="helpId"
                                                           placeholder="Specify Other Change Type Here"
                                                           title="Specify Other Change Type Here"/>
                                                    <small id="helpId" class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="col-sm-6 d-none">
                                            <div class="form-group form-row">
                                                <label class="col-sm-4 text-sm-right">Risk Measure</label>
                                                <div class="col-sm-8 radio">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                               id="inlineCheckbox1" name="risk_level"
                                                               value="<?php /*echo STATUS_LOW_RISK_LEVEL */ ?>"
                                                        >
                                                        <label class="form-check-label"
                                                               for="inlineCheckbox1">Low</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                               id="inlineCheckbox2" name="risk_level"
                                                               value="<?php /*echo STATUS_MEDIUM_RISK_LEVEL */ ?>"
                                                        >
                                                        <label class="form-check-label"
                                                               for="inlineCheckbox2">Medium</label>
                                                    </div>
                                                    <div class="form-check form-check-inline radio">
                                                        <input class="form-check-input" type="radio"
                                                               id="inlineCheckbox3" name="risk_level"
                                                               value="<?php /*echo STATUS_HIGH_RISK_LEVEL */ ?>"
                                                        >
                                                        <label class="form-check-label" for="inlineCheckbox3">
                                                            High</label>
                                                    </div>
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                            </div>
                                        </div>-->
                                        <!-- <div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label for="hod_id" class="col-sm-4 text-sm-right">
                                                    Select HOD
                                                </label>
                                                <div class="col-sm-8">
                                                    <select class="replace-multiple-select form-control" id="hod_id">
                                                        <option></option>
                                                    </select>
                                                    <select class="form-control bs-select multiple-hidden d-none"
                                                            data-none-selected-text="Select HOD to Approve"
                                                            data-size="7"
                                                            name="hod_id" id="hod_id" aria-describedby="helpId"
                                                            required>
                                                        <option class="d-none"></option><?php
                                        /*                                                        foreach ((array)$payload['hod'] as $value) {
                                                                                                    $hod = new User($value->user_id);
                                                                                                    */ ?>
                                                            <option
                                                            value="<?php /*echo $hod->user_id; */ ?>"><?php /*echo ucwords($hod->first_name . ' ' . $hod->last_name, '-. ') . ' (' . $hod->job_title . ')'; */ ?></option><?php /*}
                                                        */ ?>
                                                    </select>
                                                    <small class="form-text text-muted d-none">
                                                        Hint: Select HOD to Approve
                                                    </small>
                                                    <small class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>-->
                                        <?php
                                        $hod = getCurrentManager($user->department_id);
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label for="hod" class="col-sm-4 text-sm-right">
                                                    Current HoD
                                                </label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="hod" name="hod" readonly type="text"
                                                           value="<?php echo concatNameWithUserId($hod) ?>"
                                                           data-validate="true" required>
                                                    <input type="hidden" id="hod_id" name="hod_id"
                                                           value="<?php echo $hod ?>">
                                                    <small class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="col-sm-6">
                                            <div class="form-group form-row">
                                                <label for="title" class="col-sm-4 text-sm-right">
                                                    Title
                                                </label>
                                                <div class="col-sm-8">
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend cursor-pointer"
                                                             title="Click to add more files.">
                                                            <div class="input-group-text"><?php /*echo $payload['reference']; */ ?>
                                                                -
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" id="title" name="title"
                                                               placeholder="Enter a title for your Change">
                                                    </div>
                                                    <small class="form-text text-muted d-none">
                                                        Hint: Enter a title for your Change
                                                    </small>
                                                    <small class="form-text with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>-->
                                        <!--<div class="col-sm-6 d-none">
                                            <div class="form-group form-row">
                                                <label class="col-sm-4 text-sm-right">Budget Measure</label>
                                                <div class="col-sm-8 radio">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                               id="inlineCheckbox11" name="budget_level"
                                                               value="<?php /*echo STATUS_LOW_BUDGET_LEVEL */ ?>"
                                                        >
                                                        <label class="form-check-label"
                                                               for="inlineCheckbox11">Low</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                               id="inlineCheckbox22" name="budget_level"
                                                               value="<?php /*echo STATUS_MEDIUM_BUDGET_LEVEL */ ?>"
                                                        >
                                                        <label class="form-check-label"
                                                               for="inlineCheckbox22">Medium</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                               id="inlineCheckbox33" name="budget_level"
                                                               value="<?php /*echo STATUS_HIGH_BUDGET_LEVEL */ ?>"
                                                        >
                                                        <label class="form-check-label"
                                                               for="inlineCheckbox33">High</label>
                                                    </div>
                                                    <small class="help-block with-errors"></small>
                                                </div>
                                            </div>
                                        </div>
-->
                                        <div class="col-sm-6 pl-sm-5">
                                            <div class="form-group form-row">
                                                <div class="checkbox ml-md-2 pl-1 pl-md-4">
                                                    <label>
                                                        <input type="checkbox" name="certify_details" required>
                                                        <small class="text-bold">I hereby certify that the information I
                                                            have provided above is true, complete and accurate.
                                                        </small>
                                                    </label>
                                                    <small id="helpId" class="with-errors help-block"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" id="button_container">
                                            <div class="float-right pr-sm-2">
                                                <a href="javascript: window.history.back();"
                                                   class="btn bg-danger w3-btn">Cancel</a>

                                                <button type="submit" class="btn bg-success w3-btn" form="add_cms_form">
                                                    Submit
                                                </button>
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

<?php require_once APP_ROOT . '\views\includes\footer.php'; ?>