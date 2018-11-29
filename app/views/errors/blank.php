<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    Notice
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/sms/public/favicon.ico" type="image/x-icon" />
  <?php require APP_ROOT . '\includes\styles.php';?>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">

  <div class="wrapper">
    <?php require APP_ROOT . '\views\inc\navbar.php';?>

    <?php require APP_ROOT . '\views\inc\aside.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header d-none">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h4>Services Management System (SMS)</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="/sms">Services</a>
                </li>
                <li class="breadcrumb-item"><a href="<?php echo URLS['dashboard'][$data['user']->role]; ?>">
                    <?php echo ucwords($data['user']->job_title); ?></a></li>
                <li class="breadcrumb-item active">Staff</li>
              </ol>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content d-none">
        <div class="container-fluid fa col-12">
          <div class="navigation m-2 d-none">
            <a href="#" class="btn btn-default btn-lg w3-hover-text-grey btn-sm"><i class="fa fa-angle-double-left  mr-1"></i>
              Go Back
            </a>
          </div>
          <div class="box m-0">
            <div class="box-header with-border">
              <h3 class="box-title text-bold"></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body font-weight-normal">
              <?php  flash('flash'); ?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require APP_ROOT . '\views\inc\footer.php';?>
  </div>
  <!-- ./wrapper -->
  <?php require APP_ROOT . '\includes\scripts.php';?>
</body>

</html>