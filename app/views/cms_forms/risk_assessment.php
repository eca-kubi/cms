<?php require_once APP_ROOT .'\views\includes\header.php';?>
<?php require_once APP_ROOT .'\views\includes\navbar.php';?>
<?php require_once APP_ROOT .'\views\includes\sidebar.php';?>
<style>
    .dtr-data > input {
        display: inline!important;
    }
    #impact_tbl tr:not(.child) {
        counter-increment: rowNumber;
    }

        #impact_tbl tr:not(.child) td:first-child .row-n::before {
            content: counter(rowNumber) ". ";
            min-width: 1em;
            margin-right: 0.5em;
            margin-left: 0.5em;
        }
</style>
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
                    <?php flash('flash_risk_assessment'); ?>
                </h5>
                <h3 class="box-title text-bold">
                    <?php echo $payload['title']; ?>
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
                    <?php require_once(APP_ROOT. '/views/cms_forms/sections/'. SECTION_1 . '.php'); ?>
                    <div class="dropdown-divider"></div>
                    <?php require_once(APP_ROOT. '/views/cms_forms/sections/'. SECTION_2. '.php'); ?>
                    <div class="dropdown-divider"></div>
                    <?php require_once(APP_ROOT. '/views/cms_forms/sections/'. SECTION_3. '.php'); ?>
                    <div class="dropdown-divider"></div>                    
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