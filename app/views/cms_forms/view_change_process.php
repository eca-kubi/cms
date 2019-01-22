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
                        <?php flash('flash_view_change_process'); ?>
                    </h5>
                    <h3 class="box-title text-bold w-100">
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body pt-0">
                    <?php
                    require_once APP_ROOT . "/views/cms_forms/sections/section_start_change_process.php";
                    require_once APP_ROOT . "/views/cms_forms/sections/section_hod_assessment.php";
                    /** @var array $payload */
                    if ($payload['form']->hod_approval !== 'rejected' && $payload['form']->hod_approval !== 'delayed') {
                        require_once APP_ROOT . "/views/cms_forms/sections/section_risk_assessment.php";
                        require_once APP_ROOT . "/views/cms_forms/sections/section_gm_assessment.php";
                        require_once APP_ROOT . "/views/cms_forms/sections/section_hod_authorization.php";
                        require_once APP_ROOT . "/views/cms_forms/sections/section_action_list.php";
                        require_once APP_ROOT . "/views/cms_forms/sections/section_change_process_closure.php";
                    }
                    ?>
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