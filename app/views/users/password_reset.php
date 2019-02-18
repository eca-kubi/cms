<?php
$user = $data['user'];
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
    <link rel="icon" href="/sms/public/favicon.ico" type="image/x-icon"/>
    <?php require APP_ROOT . '\includes\styles.php'; ?>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">

<div class="wrapper">
    <?php //require APP_ROOT . '\views\inc\navbar.php';?>

    <?php //require APP_ROOT . '\views\inc\aside.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content invisible">
            <div class="container-fluid fa col-12">
                <div class="navigation m-2 d-none">
                    <a href="#" class="btn btn-default btn-lg w3-hover-text-grey btn-sm"><i
                                class="fa fa-angle-double-left  mr-1"></i>
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
                        <?php flash('flash'); ?>
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
    <?php require APP_ROOT . '\views\inc\footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php require APP_ROOT . '\includes\scripts.php'; ?>
</body>

</html>