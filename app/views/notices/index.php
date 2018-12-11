<?php 
$user = $data['user'];
?>
<?php require_once APP_ROOT . '\views\inc\header.php'; ?>

<?php require_once APP_ROOT . '\views\inc\navbar.php';?>

<?php require_once APP_ROOT . '\views\inc\aside.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header d-none">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h4><?php echo APP_NAME;?></h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="<?php echo URL_ROOT;?>">CMS</a>
                </li>
               
              </ol>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- Main content -->
        <section class="content invisible">
            <div class="container-fluid fa col-12">
                <div class="navigation m-2">
                    <a href="#" onclick="window.history.back(); return false;" class="btn btn-default btn-lg w3-hover-text-grey btn-sm">
                        <i class="fa fa-angle-double-left  mr-1"></i>
                        Go Back
                    </a>
                </div>
                <div class="box m-0">
                    <div class="box-header">
                        <h3 class="box-title text-bold"></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body font-weight-normal"><?php  flash('flash_index'); ?>
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