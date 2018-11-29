<?php 
$leave_entitlements = (array)$data['leave_entitlements'];
$post = (object)($data['post']);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $data['title']; ?>
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo URL_ROOT; ?>/public/favicon.ico" type="image/x-icon" />
  <?php require_once APP_ROOT . '\includes\styles.php';?>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
<style>
  .nav-link.active {
  color: blue!important;
}
</style>
  <div class="wrapper">
    <?php include APP_ROOT . '\views\inc\navbar.php';?>

    <?php include APP_ROOT . '\views\inc\aside.php';?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-top: '<?php echo NAVBAR_MT; ?>'">
      <!-- Content Header (Page header) -->
      <?php include APP_ROOT . '\views\inc\content-header.php';?>

      <!-- Main content -->
      <section class="content invisible">
        <div class="">
          <div class="box">
            <div class="box-header with-border">
              <h6>
                <?php flash('flash');?>
              </h6>
              <?php ?>
              <h5 class="box-title text-bold">Leave Transaction
              </h5>
              <table class="w3-table w3-tiny holidays animated fadeInDownBig w-auto d-none">
                <thead>
                  <tr>
                    <th class="text-center text-success" colspan="2">Holidays:</th>
                  </tr>
                </thead>
                <tbody class="callout callout-success" id="tbl_holidays">

                  <tr>
                    <td scope="row">Independence Day</td>
                    <td>6th March 2018</td>
                  </tr>
                  <tr>
                    <td scope="row">Founders' Day</td>
                    <td>21st September 2018</td>
                  </tr>
                </tbody>
              </table>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="max-height: 482.375px; overflow-y: scroll">
              <div class="text-center">
                <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#information" data-toggle="tab" data-target="#information2">Information</a>
                    </li>
                    <li class="nav-item d-none">
                      <a class="nav-link" href="#attachment" data-target="#attachment2" data-toggle="tab">Attachment</a>
                    </li>
                    <li class="nav-item d-none">
                      <a class="nav-link" href="#management" data-target="#management2" data-toggle="tab">Management</a>
                    </li>
                    <li class="nav-item d-none">
                      <a class="nav-link" href="#approvalworkflow" data-target="#approvalworkflow2" data-toggle="tab">Approval
                        Workflow
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="tab-content px-2">
                  <div class="tab-pane fade show active" id="information2" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col">
                      <form action="<?php echo URL_ROOT; ?>/leaves/apply/?current_session=<?php echo getCurrentSession();?>" method="POST" role="form" id="leave_application_form" enctype="multipart/form-data"
                        data-toggle="validator">
                        <fieldset class="py-0 text-left fa font-weight-normal col-sm-12 p-2" <?php echo empty($leave_entitlements)? 'disabled': ''; ?>>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group form-row">
                                <label for="" class="col-sm-4">Type</label>
                                <div class="col-sm-7 px-0">
                                  <select name="leave_entitlement_id" id="leave_entitlement_id" class="form-control bs-select" data-none-selected-text="Select Leave Entitlement" onfocus="blur();">
                              <option class="default" disabled="disabled" selected>Select Leave Entitlement</option>

                                    <?php
                                    if ($data['user']->short_leave_enabled)
                                    {
                                    	
                                    }
                                    
        foreach ($leave_entitlements as $value) {
            ?>
                                    <option value="<?php echo $value->leave_entitlement_id; ?>" data-subtext='<ul class="list-inline">
                                      <li class="list-inline-item">Days Accrued: <?php echo $value->accrued; ?>
                                      </li>
                                      <li class="list-inline-item">Taken:
                                        <?php echo $value->days_taken; ?>
                                      </li>
                                      <li class="list-inline-item">Remaining: <?php echo $value->days_remaining; ?></li>
                                      </ul>'
                                      data-days-taken="<?php echo $value->days_taken; ?>"
                                      data-days-remaining="<?php echo $value->days_remaining; ?>"
                                      data-days-accrued="<?php echo $value->accrued; ?>" >
                                      <?php echo $value->leave_type_name; ?>
                                    </option>
                                    <?php }?>
                                  </select>
<?php if (!empty($leave_entitlements)) { ?>
   <small class="w3-text-deep-purple text-bold sub-text d-none">
                                    Days Accrued: <span id="accrued">
                                      <?php echo $leave_entitlements[0]->accrued; ?></span> | Days Taken: <span
                                      id="days_taken">
                                      <?php echo $leave_entitlements[0]->days_taken; ?></span>
                                    | Remaining: <span id="days_remaining">
                                      <?php echo $leave_entitlements[0]->days_remaining; ?></span>
                                  </small>
<?php } ?>
                                    <small class="with-errors help-block" id="leave_entitlement_error"></small>
                                </div>
                              </div>
                              <div class="form-group form-row">
                                <label for="" class="col-sm-4">Start <small>(First day)</small></label>
                                <div class="col-sm-7 px-0">
                                  <input class="form-control singledate-picker " id="start_date" type="text" name="start_date"
                                    onfocus="blur();" aria-describedby="helpId" value="<?php echo $post->start_date; ?>">
                                </div>
                              </div>
                              <div class="form-group form-row">
                                <label for="" class="col-sm-4">End <small>(Last day)</small></label>
                                <div class="col-sm-7 px-0">
                                  <input class="form-control singledate-picker " id="end_date" name="end_date"
                                    aria-describedby="helpId" value="<?php echo $post->end_date; ?>" onfocus="blur();">
                                  <small class="w3-text-deep-purple help-block text-bold sub-text d-none">
                                    Days Applied: <span id="days_applied_for">...</span> | Holidays: <span class="holiday_count">...</span>
                                  </small>
                                  <small class="text-danger d-none help-block my-1" id="days_applied_error"></small>
                                </div>
                              </div>
                              <div class="form-group form-row">
                                <label for="" class="col-sm-4">Resume <small>(Work day)</small></label>
                                <div class="col-sm-7 px-0">
                                  <input class="form-control" id="resume_date" name="resume_date"
                                    type="text" aria-describedby="helpId" value="<?php echo $post->resume_date; ?>" readonly="readonly"
                                    onfocus="blur();">
                                </div>
                              </div>
                              <div class="form-group form-row">
                                <label for="" class="col-sm-4">Relationship</label>
                                <div class="col-sm-7 px-0">
                                  <input class="form-control" name="relationship" placeholder="N/A" readonly>
                                  <small class="with-errors help-block my-1"></small>
                                </div>
                              </div>
                              <div class="form-group form-row">
                                <label for="" class="col-sm-4">Reason</label>
                                <div class="col-sm-7 px-0">
                                  <input class="form-control" name="leave_reason" required placeholder="Specify reason for leave.">
                                  <small class="with-errors help-block my-1"></small>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group form-row">
                                <label for="" class="col-sm-4">Vacation Address</label>
                                <div class="col-sm-7 px-0">
                                  <input type="text" class="form-control " aria-describedby="helpId" name="vac_address">
                                </div>
                              </div>
                              <div class="form-group form-row ">
                                <label for="" class="col-sm-4">Vacation Phone</label>
                                <div class="col-sm-7 px-0">
                                  <input type="tel" class="form-control" aria-describedby="helpId" name="vac_phone_no">
                                </div>
                              </div>
                              <div class="form-group form-row">
                                <label for="" class="col-sm-4">Company Email</label>
                                <div class="col-sm-7 px-0">
                                  <input type="email" class="form-control" aria-describedby="helpId" name="company_email"
                                    value="<?php echo $post->company_email; ?>" required data-required-error="Please specify a company email here or personal email below.">
                                  <small class="with-errors help-block my-1"></small>
                                </div>
                              </div>
                              <div class="form-group form-row ">
                                <label for="" class="col-sm-4">Personal Email</label>
                                <div class="col-sm-7 px-0">
                                  <input type="email" class="form-control" aria-describedby="helpId" name="personal_email">
                                </div>
                              </div>
                              <div class="form-group form-row ">
                                <label for="" class="col-sm-4">Attachment (Optional)</label>
                                <div class="col-sm-7 px-0">
                                  <input type="file" class="form-control" multiple="multiple" form="leaveapplication"
                                    name="attachment[]" accept=".docx,.doc,.pdf,.txt,.xlsx">
                                </div>
                              </div>
                              <div class="form-group form-row">
                                <label for="" class="col-sm-4">Remarks (Optional)</label>
                                <div class="col-sm-7 px-0">
                                  <input class="form-control" id="remarks" name="remarks" rows="3" placeholder="You can leave blank.">
                                  <small class="with-errors help-block my-1"></small>
                                </div>
                              </div>

                              <input type="hidden" name="days_applied_for" value=''>
                                <input type="hidden" value="<?php echo $post->user_id; ?>" name="user_id" />
                            </div>
                            <div class="col pr-sm-3 ">
                              <button type="submit" name='submit' class="btn btn-default w3-btn w3-gray float-right">Submit</button>
                            </div>
                          </div>
                        </fieldset>
                      </form>
                    </div>
                  </div>
                  <div class="tab-pane fade d-none" id="attachment2" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="pt-2 files fa col-sm-8 font-weight-normal px-1">
                      <label>Upload Your File </label>
                      <div class="col-sm-12 px-1">
                        <!-- <input type="file" class="form-control" multiple="multiple" form="leaveapplication" name="attachment[]"
                          accept=".docx, .doc, .pdf. .txt, .xlsx"> -->

                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="management2" role="tabpanel" aria-labelledby="messages-tab">
                    <fieldset class="fa col-sm-9 my-3 py-sm-3">
                      <legend class="d-none">For Management Purposes</legend>
                      <div class="form-group form-row text-left">
                        <label for="" class="col-sm-4">Manager's Remark</label>
                        <textarea class="form-control col-sm-7 mx-1 font-weight-normal" rows="3"></textarea>
                      </div>
                      <div class="form-group form-row text-left">
                        <label for="" class="col-sm-4">Status</label>
                        <select class="form-control col-sm-7 mx-1 font-weight-normal">
                          <option value="Approved">Approved</option>
                          <option value="Cancelled">Cancelled</option>
                          <option value="Pending Approval" selected>Pending Approval</option>
                          <option value="Rejected">Rejected</option>
                        </select>
                      </div>
                    </fieldset>
                  </div>
                  <div class="tab-pane fade" id="approvalworkflow2" role="tabpanel" aria-labelledby="settings-tab">
                    <div class="table-responsive fa font-weight-normal col-sm-8 mx-sm-auto my-3">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Status</th>
                            <th>By</th>
                            <th>Remark</th>
                            <th>Time</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td scope="row">Pending</td>
                            <td>HR</td>
                            <td class="text-left"></td>
                            <td class="text-left">
                              <?php echo (new \DateTime)->format(DATE_FORMATS['front_end']); ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
            <?php ?>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include APP_ROOT . '\views\inc\footer.php';?>
  </div>
  <!-- ./wrapper -->
  <?php include APP_ROOT . '\includes\scripts.php';?>
</body>

</html>