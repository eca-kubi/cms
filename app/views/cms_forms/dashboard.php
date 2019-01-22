<?php require_once APP_ROOT . '\views\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\includes\navbar.php'; ?>
<?php require_once APP_ROOT . '\views\includes\sidebar.php'; ?>
<!-- .content-wrapper -->
<div class="content-wrapper animated fadeInRight" style="margin-top: <?php echo NAVBAR_MT; ?>">
    <!-- .content-header-->
    <section class="content-header d-none">
        <!-- .container-fluid -->
        <div class="container-fluid">
            <!-- .row -->
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <?php echo APP_NAME; ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <a href="#">Dashboard</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header-->
    <!-- content -->
    <section class="content">
        <div class="box-group" id="box_group">
            <div class="box collapsed">
                <div class="box-header">
                    <h5>
                        <?php flash('flash_dashboard'); ?>
                    </h5>
                    <h3 class="box-title text-bold d-none"></h3>
                    <div class="box-tools pull-right d-none">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <?php
                        foreach (STATE as $state) { ?>
                            <div class="col-12">
                                <div class="box box-<?php echo $state['color'] ?> collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title cursor-pointer"
                                            onclick="$('#btn_collapse_<?php echo $state['name'] ?>').click();">
                                            <b class="text-<?php echo $state['color'] ?>"><?php echo ucwords($state['name']) ?></b>
                                            CMS Forms
                                        </h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" id="btn_collapse_<?php echo $state['name'] ?>"
                                                    class="btn btn-box-tool"
                                                    data-widget="collapse">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool d-none" data-widget="remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <?php
                                        if (!empty($payload[$state['name']])) { ?>
                                            <div class="products-list product-list-in-box row">
                                                <?php
                                                $count = 1;
                                                foreach ($payload[$state['name']] as $val) {
                                                    $cms_form = new CMSForm(['cms_form_id' => $val->cms_form_id]);
                                                    $originator = new User($cms_form->originator_id); ?>
                                                    <div class="item cms-list-item col-sm-5 <?php echo $count % 2 > 0 ? 'mx-sm-5' : '';
                                                    $count++; ?>" data-target=""
                                                         style="cursor:pointer"
                                                         onclick="window.location.href = '<?php echo URL_ROOT . "/cms-forms/view-change-process/" . $cms_form->cms_form_id; ?>'">
                                                        <dl class="row callout">
                                                            <dt class="invisible">Id</dt>
                                                            <dd class="col-sm-8 product-description"><span
                                                                        class="badge">#<?php echo $cms_form->cms_form_id ?></span>
                                                            </dd>
                                                            <dt class="col-sm-4 text-sm-right">Originator</dt>
                                                            <dd class="col-sm-8 product-description"><?php echo its_logged_in_user($originator->user_id) ? ' You' : ucwords($originator->first_name . ' ' . $originator->last_name); ?>
                                                                (<?php echo $originator->job_title; ?>)
                                                                @ <?php echo $originator->department->department; ?></dd>
                                                            <dt class="col-sm-4 text-sm-right d-none">Ref</dt>
                                                            <dd class="col-sm-8 product-description d-none">
                                                                NGM/MW/2.01F1
                                                            </dd>
                                                            <dt class="col-sm-4 text-sm-right">Date</dt>
                                                            <dd class="col-sm-8 product-description">
                                                                <?php //echo formatDate($cms_form->date_raised, DFB_DT, DFF_DT);  ?>
                                                                <?php echoDate($cms_form->date_raised); ?>
                                                            </dd>
                                                            <dt class="col-sm-4 text-sm-right">Description</dt>
                                                            <dd class="col-sm-8 product-description">
                                                                <?php echo $cms_form->change_description; ?>
                                                            </dd>
                                                            <dt class="col-sm-4 invisible d-sm-block d-none">..</dt>
                                                            <dd class="col-sm-8">
                                                                <a href="<?php echo URL_ROOT . '/cms-forms/view-change-process/' . $cms_form->cms_form_id; ?>"
                                                                   title="View Change Process"
                                                                   class="btn w3-btn badge badge-info">
                                                                    <i class=" badge small"> Details</i>
                                                                </a>
                                                                <a href="<?php echo URL_ROOT; ?>/cms-forms/download-change-process/<?php echo $cms_form->cms_form_id; ?>"
                                                                   title="Download Change Process"
                                                                   class="btn w3-btn badge bg-aqua-gradient">
                                                                    <i class="badge small">Download</i>
                                                                </a>
                                                                <?php
                                                                if (isHOD($cms_form->cms_form_id, getUserSession()->user_id) || isOriginator($cms_form->cms_form_id, getUserSession()->user_id)) { ?>
                                                                    <a href="<?php echo URL_ROOT; ?>/cms-forms/stop-change-process/<?php echo $cms_form->cms_form_id; ?>"
                                                                       title="Stop Change Process"
                                                                       class="btn w3-btn badge bg-danger-gradient">
                                                                        <i class="badge small">Stop</i>
                                                                    </a>
                                                                <?php }
                                                                ?>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                <?php }
                                                ?>
                                                <!-- /.item -->
                                            </div>
                                        <?php } else { ?>
                                            <p class="text-center text-muted">No <?php echo ucwords($state['name']) ?>
                                                Change
                                                Proposal
                                                Applications</p>
                                        <?php }
                                        ?>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer text-center d-none">
                                    </div>
                                    <!-- /.box-footer -->
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer d-none"></div>
                <!-- /.box-footer-->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once APP_ROOT . '\views\includes\footer.php'; ?>
