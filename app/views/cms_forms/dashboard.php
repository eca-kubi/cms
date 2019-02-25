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
                        <?php /** @var array $payload */
                        foreach (STATE as $state) { ?>
                            <div class="col-12">
                                <div class="box box-<?php echo $state['color'] ?> collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title cursor-pointer"
                                            onclick="$('#btn_collapse_<?php echo $state['name'] ?>').click();">
                                            <b class="text-<?php echo $state['color'] ?>"><?php echo ucwords($state['name']) ?></b>
                                            Change
                                        </h3>
                                        <div class="box-tools pull-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-box-tool dropdown-toggle p-1"
                                                    <?php $state_name = $state['name']; ?>
                                                        onclick="$(this).parents('.box').boxWidget('expand'); $('#list_search_<?php echo $state_name; ?>').focus()"
                                                        data-toggle="dropdown" aria-expanded="true">
                                                    <i class="fas fa-search"></i></button>
                                                <ul class="dropdown-menu px-2" role="menu">
                                                    <li>
                                                        <input type="text" class="form-control"
                                                               id="list_search_<?php echo $state['name']; ?>"
                                                               data-list-id="list_<?php echo $state['name']; ?>"
                                                               placeholder="Search..."
                                                               onkeydown="searchList(this);">
                                                    </li>
                                                </ul>
                                            </div>
                                            <button type="button" id="btn_collapse_<?php echo $state['name'] ?>"
                                                    class="btn btn-box-tool"
                                                    data-widget="collapse">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <?php
                                        if (!empty($payload[$state['name']])) { ?>
                                            <div id="list_container_<?php echo $state['name'] ?>">
                                                <input class="search d-none" id="search_<?php echo $state['name']; ?>"/>
                                                <div class="products-list product-list-in-box row list">
                                                    <?php
                                                    $count = 1;
                                                    foreach ($payload[$state['name']] as $val) {
                                                        $cms_form = new CMSForm(['cms_form_id' => $val->cms_form_id]);
                                                        $originator = new User($cms_form->originator_id); ?>
                                                        <div class="item cms-list-item col-sm-5  <?php echo $count % 2 > 0 ? 'mx-sm-5' : '';
                                                        $count++; ?>"
                                                             onclick="//window.location.href = '<?php echo site_url("cms-forms/view-change-process/$cms_form->cms_form_id"); ?>'">
                                                            <dl class="row callout">
                                                                <dt class="invisible">Ref:</dt>
                                                                <dd class="col-sm-8 product-description ref_num"><span
                                                                            class="badge badge-outline-<?php echo $state['color']; ?>"><?php echo $cms_form->getHodRefNum(); ?></span>
                                                                </dd>
                                                                <dt class="col-sm-4 text-sm-right">Title:</dt>
                                                                <dd class="col-sm-8 product-description title">
                                                                    <span><?php echo $cms_form->title; ?></span>
                                                                </dd>
                                                                <dt class="col-sm-4 text-sm-right">Originator</dt>
                                                                <dd class="col-sm-8 product-description originator"><?php echo ucwords($originator->first_name . ' ' . $originator->last_name); ?>
                                                                    (<?php echo $originator->job_title; ?>)
                                                                    @ <?php echo $originator->department->department; ?></dd>
                                                                <dt class="col-sm-4 text-sm-right">Date Raised</dt>
                                                                <dd class="col-sm-8 product-description date">
                                                                    <?php //echo formatDate($cms_form->date_raised, DFB_DT, DFF_DT);  ?>
                                                                    <?php echoDate($cms_form->date_raised); ?>
                                                                </dd>
                                                                <dt class="col-sm-4 text-sm-right">Change Type</dt>
                                                                <dd class="col-sm-8 product-description change_type">
                                                                    <?php echo $cms_form->getChangeType(); ?>
                                                                </dd>
                                                                <?php if ($cms_form->state === STATUS_CLOSED) { ?>
                                                                    <dt class="col-sm-4 text-sm-right">Date Closed:</dt>
                                                                    <dd class="col-sm-8 product-description date_closed">
                                                                        <?php echoDate($cms_form->date_closed); ?>
                                                                    </dd>
                                                                <?php } ?>
                                                                <dt class="col-sm-4 invisible d-sm-block d-none">..</dt>
                                                                <dd class="col-sm-8">
                                                                    <a href="<?php echo site_url("cms-forms/view-change-process/$cms_form->cms_form_id"); ?>"
                                                                       title="View Change Process"
                                                                       class="btn w3-btn badge badge-info">
                                                                        <i class=" badge small"> Details</i>
                                                                    </a>
                                                                    <?php if ($cms_form->state === STATUS_CLOSED) { ?>
                                                                        <a href="<?php echo site_url("cms-forms/download-change-process/$cms_form->cms_form_id"); ?>"
                                                                           title="Download Change Process"
                                                                           class="btn w3-btn badge bg-aqua-gradient">
                                                                            <i class="badge small">Download</i>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php
                                                                    if (isDepartmentManager(getUserSession()->user_id, $cms_form->cms_form_id) || isOriginator($cms_form->cms_form_id, getUserSession()->user_id)) {
                                                                        if ($cms_form->state === STATUS_ACTIVE) {
                                                                            ?>
                                                                            <a href="#stopProcess" data-toggle="modal"
                                                                               title="Stop Change Process"
                                                                               data-href="<?php echo site_url('cms-forms/stop-change-process/' . $cms_form->cms_form_id); ?>"
                                                                               class="btn w3-btn badge bg-danger-gradient">
                                                                                <i class="badge small">Stop</i>
                                                                            </a>
                                                                        <?php }
                                                                    }
                                                                    ?>
                                                                </dd>
                                                            </dl>
                                                        </div>
                                                    <?php }
                                                    ?>
                                                    <!-- /.item -->
                                                </div>
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
