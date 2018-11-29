<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Adamus SMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo URL_ROOT; ?>/public/favicon.ico" type="image/x-icon" />
  <?php include (APP_ROOT.'\includes\styles.php'); ?>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
  <div class="wrapper">
    <?php include (APP_ROOT.'\views\inc\navbar.php'); ?>

    <?php include (APP_ROOT.'\views\inc\aside.php'); ?>

    <!-- .content-wrapper -->
    <div class="content-wrapper">
      <!-- .content-header-->
      <section class="content-header d-none">
        <!-- .container-fluid -->
        <div class="container-fluid">
        <!-- .row -->
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo APP_NAME; ?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="/users/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                  <a href="#"><?php echo $data['title']; ?></a>
                </li>
              </ol>
            </div>
          </div>
        <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content-header-->

      <!-- .content -->
      <section class="content invisible">
          <div class="box">
            <div class="box-header with-border">
              <h5>
                <?php flash('flash'); ?>
              </h5>
              <h3 class="box-title text-bold">Edit Staff Record</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- left column -->
              <div class="col-md-3 callout">
                  <div class="">
                  <?php 
                  $full_name = $data['post']->first_name . ' ' .$data['post']->last_name;
                                if ($data['post']->profile_pic == DEFAULT_PROFILE_PIC) {
                                  $initials = $data['post']->first_name[0] . $data['post']->last_name[0];
                                  echo "<img  avatar=\"$full_name\" class=\"img-fluid img-thumbnail img-size-32\" alt=\"$initials\" >";
                                } else { ?>
                                  <img src="<?php echo PROFILE_PIC_DIR.$data['post']->profile_pic; ?>" class="img-fluid img-thumbnail img-size-32" alt="<?php echo $initials ?>" >
                                <?php } ?> 
                    <div class="text-bold w3-small">
                      <span class="d-block"><?php echo ucwords($data['post']->first_name. ' ' .$data['post']->last_name); ?></span>
                      <span class="d-block"><?php echo $data['post']->department; ?></span>
                      <span class="d-block"><?php echo $data['post']->job_title; ?></span>                      
                    </div>
                  </div>
                </div>
              <form action="/sms/users/edit/<?php echo $data['post']->user_id?>"  enctype="multipart/form-data" method="post" id="register_staff_form"
                role="form" data-toggle="validator">
                <fieldset class="fa font-weight-normal p-3 col">
                  <div id="register_staff_form_page_1" class="form-page-1">
                    <div class="row">
                      <div class="form-group form-row col-sm-6 ">
                        <label class="col-form-label col-md-4">First Name</label>
                        <div class="col-md-6">
                          <input type="text" name="first_name" class="form-control text-capitalize" aria-describedby="helpId"
                            placeholder="First Name" value="<?php echo $data['post']->first_name; ?>" pattern="[a-zA-Z -]+"
                            data-pattern-error="There may be invalid characters in this input!" title="First Name"
                            required>
                          <small class="help-block with-errors">
                            <?php echo $data['post']->first_name_err; ?>
                          </small>
                        </div>
                      </div>
                      <div class="form-group form-row col-sm-6">
                        <label for="" class="col-form-label col-md-4">Last Name</label>
                        <div class="col-md-6">

                          <input type="text" name="last_name" class="form-control text-capitalize" aria-describedby="helpId"
                            pattern="[a-zA-Z -]+" placeholder="Last Name" data-pattern-error="There may be invalid characters in this input!"
                            value="<?php echo $data['post']->last_name; ?>" title="Last Name" required>
                          <small class=" with-errors help-block">
                            <?php echo $data['post']->last_name_err; ?>
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="row d-none">
                      <div class="form-group form-row col-sm-6 ">
                        <label class="col-md-4">Password</label>
                        <div class="col-md-6">
                          <input type="password" name="password" class="form-control" aria-describedby="helpId" id="password"
                            title="Password" placeholder="Password" data-validate="false" required>
                          <small class="help-block with-errors">
                            <?php echo $data['post']->password_err; ?>
                          </small>
                        </div>
                      </div>
                      <div class="form-group form-row col-sm-6">
                        <label for="" class="col-md-4">Password <small>(Confirm)</small></label>
                        <div class="col-md-6">

                          <input type="password" name="confirm_password" class="form-control" data-match-error="The passwords must match"
                            data-match="#password" title="Confirm Password" placeholder="Confirm Password"
                            aria-describedby="helpId"  data-validate="false" required>
                          <small class=" with-errors help-block">
                            <?php echo $data['post']->confirm_password_err; ?>
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group form-row col-sm-6 <?php //echo empty($data['post']->staff_id_err)?'': 'has-error'; ?>">
                        <label for="" class="col-md-4">Staff Number <small>(ID)</small> </label>
                        <div class="col-md-6">

                          <input type="text" name="staff_id" class="form-control" aria-describedby="helpId" value="<?php echo $data['post']->staff_id; ?>"
                            title="Staff Number (ID)" placeholder="Staff Number (ID) " required data-remote>
                          <small class=" with-errors help-block">
                            <?php echo $data['post']->staff_id_err; ?>
                          </small>
                        </div>
                      </div>
                      <div class="form-group form-row col-sm-6">
                        <label for="" class="col-md-4">Job Title</label>
                        <div class="col-md-6">

                          <input type="text" class="form-control text-capitalize" name="job_title" pattern="[a-zA-Z -]+"
                            pattern-error="Please input alphabets." title="Job Title" placeholder="Job Title" value="<?php echo $data['post']->job_title; ?>"
                            required>
                          <small class=" with-errors help-block">
                            <?php echo $data['post']->job_title_err; ?>
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group form-row col-sm-6">
                        <label for="" class="col-md-4">Phone Number</label>
                        <div class="col-md-6">

                          <input type="tel" name="phone_number" class="form-control" aria-describedby="helpId"
                            placeholder="Mobile Number" pattern="[0-9]{10}" value="<?php echo $data['post']->phone_number; ?>"
                            data-pattern-error="Please enter a valid ten-digit number" title="Phone Number" required>
                          <small class=" with-errors help-block">
                            <?php echo $data['post']->phone_number_err; ?>
                          </small>
                        </div>
                      </div>
                      <div class="form-group form-row col-sm-6">
                        <label for="" class="col-md-4">Email</label>
                        <div class="col-md-6">

                          <input type="email" name="email" class="form-control" value="<?php echo $data['post']->email; ?>"
                            aria-describedby="helpId" title="Email" placeholder="Email" data-pattern-error="The email address may be invalid!">
                          <small class=" with-errors help-block">
                            <?php echo $data['post']->email_err; ?>
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group form-row col-sm-6">
                        <label for="" class="col-md-4">Department </label>
                        <div class="col-md-6">
                          <select class="form-control  select2" name="department" data-required-error="Please select a department."
                            title="Department" data-placeholder="Department" required>
                            <option></option>
                            <option disabled>Department</option>
                            <?php 
                         foreach ($data['departments'] as $key => $value) { ?>
                            <option value="<?php echo $value->department; ?>" <?php echo $data[ 'post' ]->department ==
                              $value->department? 'selected': ''; ?>>
                              <?php echo ucwords($value->department); ?>
                            </option>
                            <?php }?>
                          </select>
                          <small class=" with-errors help-block">
                            <?php echo $data['post']->department_err; ?>
                          </small>
                        </div>
                      </div>
                      <div class="form-group form-row col-sm-6">
                        <label for="" class="col-md-4">Employment Date</label>
                        <div class="col-md-6">

                          <input type="text" class="form-control singledate-picker" name="employment_date" id="employment_date"
                            aria-describedby="helpId" value="<?php echo formatDate($data['post']->employment_date, DATE_FORMATS['back_end'], DATE_FORMATS['front_end']); ?>"
                            placeholder="Employment Date" title="Employment Date">
                          <small class=" with-errors help-block"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group form-row col-sm-6">
                        <label for="" class="col-md-4">Contract Start Date</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control  singledate-picker" name="contract_start" id="contract_start"
                            aria-describedby="helpId" value="<?php echo formatDate($data['post']->contract_start, DATE_FORMATS['back_end'], DATE_FORMATS['front_end']); ?>"
                            placeholder="Contract Start Date" title="Contract Start Date">
                          <small class=" with-errors help-block"></small>

                        </div>
                      </div>
                      <div class="form-group form-row col-sm-6">
                        <label for="" class="col-md-4">Contract End Date</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control  singledate-picker" name="contract_end" id="contract_end"
                            aria-describedby="helpId" value="<?php echo formatDate($data['post']->contract_end, DATE_FORMATS['back_end'], DATE_FORMATS['front_end']); ?>"
                            placeholder="Contract End Date" title="Contract End Date">
                          <small class=" with-errors help-block"></small>

                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group form-row col-sm-6">
                        <label for="" class="col-md-4">Special Role</label>
                        <div class="col-md-6">
                          <select class="form-control  select2" name="role" title="Special Role" data-placeholder="Special Role">
                            <option></option>
                            <option disabled>Special Role</option>
                            <?php 
                 foreach (SPECIAL_ROLES as $key => $value) { ?> echo '
                            <option value="<?php echo $value; ?>" <?php echo $data['post']->role == $value?
                              'selected': ''; ?>>
                              <?php echo $value; ?>
                            </option>'
                            <?php }?>
                          </select>
                        </div>

                      </div>
                      <div class="form-group form-row col-sm-6">
                        <label for="" class="col-md-4">Staff Category</label>
                        <div class="col-md-6">
                          <select class="form-control  select2" name="staff_category" title="Staff Category"
                            data-placeholder="Staff Category">
                            <option></option>
                            <option disabled>Staff Category</option>
                             <?php 
                             foreach (STAFF_CATEGORY as $key => $value) { ?> echo '
                            <option value="<?php echo $value; ?>" <?php echo $data['post']->staff_category == $value?
                                                                        'selected': ''; ?>>
                              <?php echo $value; ?>
                            </option>'
                            <?php }?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group form-row col-sm-6">
                        <label for="" class="col-md-4">Profile Picture</label>
                        <div class="col-md-6">
                         <a class="input-group-addon btn btn-default text-left col" data-target="#profile_pic"  href='javascript:;'>
                              <i class="fa fa-picture-o"></i> <small class="text-sm">Select a Profile Picture...</small>
                              <input type="file" class="col" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;'
                                name="profile_pic" id="profile_pic" size="40" accept=".png,.jpg,.gif">
                            </a>
                          <small class=" with-errors help-block"></small>
                        </div>
                      </div>
                      <div class="form-group col-sm-6">
                        <label id="upload-file-info" class="text-muted col p-0">No Profile Picture Selected</label>
                      </div>
                    </div>
                    <div class="form-group pr-md-5 mr-md-3">
                      <input name="submit" class="fa btn mt-2 float-right w3-btn w3-gray" type="submit" value="Submit"
                        form="register_staff_form">
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">

            </div>
            <!-- /.box-footer-->
          </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include (APP_ROOT.'\views\inc\footer.php'); ?>

  </div>
  <!-- ./wrapper -->
  <?php include (APP_ROOT.'\includes\scripts.php'); ?>

  <script>
      $(function () {
        $('.select2-container').addClass('w-100');
  
        $('#contract_start').dateRangePicker($.extend(true, date_rangepicker_options, {
          beforeShowDay: function (d) {
            var contract_start = moment(d);
            var contract_end = moment($('#contract_end').val());
  
            valid = true;
            _class = '';
            _tooltip = '';
  
            // Date is earlier than today
            if (contract_end.diff(contract_start, 'days') <= 0) {
              valid = false;
            }
  
            holiday = contract_start.isHoliday();
            if (holiday) {
              _tooltip = holiday;
              _class = 'bg-green';
            }
  
            return [
              valid,
              _class,
              _tooltip
            ];
          }
        }));
  
        $('#contract_end').dateRangePicker($.extend(true, date_rangepicker_options, {
          yearSelect: [1900, 2050],
          beforeShowDay: function (d) {
            var contract_end = moment(d);
            var contract_start = moment($('#contract_start').val());
  
            valid = true;
            _class = '';
            _tooltip = '';
  
            // Date is earlier than today
            if (contract_end.diff(contract_start, 'days') <= 0) {
              valid = false;
            }
  
            holiday = contract_end.isHoliday();
            if (holiday) {
              _tooltip = holiday;
              _class = 'bg-green';
            }
  
            return [
              valid,
              _class,
              _tooltip
            ];
          }
        }));
  
        $('#employment_date').dateRangePicker($.extend(true, date_rangepicker_options, {
          yearSelect: [1900, moment().get('year')],
          beforeShowDay: function (d) {
            var date = moment(d);
  
            valid = true;
            _class = '';
            _tooltip = '';
  
            holiday = date.isHoliday();
  
            if (holiday) {
              _tooltip = holiday;
              _class = 'bg-green';
            }
  
            return [
              valid,
              _class,
              _tooltip
            ];
          }
        }));
  
      });
    </script>
</body>

</html>