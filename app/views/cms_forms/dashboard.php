<?php require_once APP_ROOT .'\views\includes\header.php';?>
<?php require_once APP_ROOT .'\views\includes\navbar.php';?>
<?php require_once APP_ROOT .'\views\includes\sidebar.php';?>
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
        <div class="box collapsed">
            <div class="box-header">
                <h5>
                    <?php flash('flash'); ?>
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
                    <div class="col-12">
                        <div class="box box-primary collapsed-box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Current CMS Forms <span class="text-muted d-sm-inline d-block">(Active Now)</span></h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
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
                                if (!empty( $data['active']))
                                { ?>
                                    <ul class="products-list product-list-in-box">
                                        <?php 
                                    foreach ((array)$data['active'] as $val)
                                    $cms_form = new CMSForm($val->cms_form_id);
                                    $originator = new User($cms_form->originator_id);
                                    { ?>
                                        <li class="item cms-list-item" data-target="" style="cursor:pointer">
                                            <dl class="row callout col-sm-6">
                                                <dt class="col-sm-2 text-sm-right">Originator</dt>
                                                <dd class="col-sm-10 product-description"><?php echo ucwords($originator->first_name. ' ' . $originator->last_name); ?>
                                                (<?php echo $originator->job_title; ?>) @ <?php echo $originator->department->department; ?></dd>
                                                <dt class="col-sm-2 text-sm-right d-none">Ref</dt>
                                                <dd class="col-sm-10 product-description d-none">NGM/MW/2.01F1</dd>
                                                <dt class="col-sm-2 text-sm-right">Date</dt>
                                                <dd class="col-sm-10 product-description">
                                                    <?php echo formatDate($cms_form->date_raised, DFB, DFF); ?>
                                                </dd>
                                                <dt class="col-sm-2 text-sm-right">Description</dt>
                                                <dd class="col-sm-10 product-description"> <?php echo $cms_form->change_description; ?></dd>
                                                <dt class="col-sm-2 invisible d-sm-block d-none">..</dt>
                                                <dd class="col-sm-10">
                                                    <a href="<?php echo URL_ROOT;?>/cms-forms/view-change-process/<?php echo $cms_form->cms_form_id;?>" title="View Change Process" class="btn w3-btn badge badge-success">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo URL_ROOT;?>/cms-forms/stop-change-process/<?php echo $cms_form->cms_form_id;?>" title="Stop Change Process" class="btn w3-btn badge badge-danger">
                                                        <i class="fa fa-stop"></i>
                                                    </a>
                                                    <a href="<?php echo URL_ROOT;?>/cms-forms/download-change-process/<?php echo $cms_form->cms_form_id;?>" title="Download Change Process" class="btn w3-btn badge badge-primary">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                </dd>
                                            </dl>
                                        </li>                                                                                
                                  <?php  }
                                        ?>
                                    <!-- /.item -->
                                </ul>
                              <?php  } 
                                else
                                { ?>
                                    <p class="text-center text-muted">No Active Change Proposal Applications</p>
                             <?php   }
                                ?>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center d-none" style="">
                                <a href="javascript:void(0)" class="uppercase scroll-to" data-target=""><i class="fa fa-arrow-circle-up"></i> Scroll to Top</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="box box-primary collapsed-box">
                            <div class="box-header with-border">
                                <h3 class="box-title">All Previous CMS Forms <span class="text-muted">(Closed)</span></h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool d-none" data-widget="remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
                                <?php
                                if (!empty( $data['closed']))
                                { ?>
                                <ul class="products-list product-list-in-box">
                                    <?php
                                    foreach ((array)$data['active'] as $val)
                                        $cms_form = new CMSForm($val->cms_form_id);
                                        $originator = new User($cms_form->originator_id);
                                    { ?>
                                    <li class="item cms-list-item" data-target="" style="cursor:pointer">
                                        <dl class="row callout col-sm-6">
                                            <dt class="col-sm-2 text-sm-right">Originator</dt>
                                            <dd class="col-sm-10 product-description">
                                                <?php echo ucwords($originator->first_name. ' ' . $originator->last_name); ?>
                                                (<?php echo $originator->job_title; ?>) @ <?php echo $originator->department->department; ?>
                                            </dd>
                                            <dt class="col-sm-2 text-sm-right d-none">Ref</dt>
                                            <dd class="col-sm-10 product-description d-none">NGM/MW/2.01F1</dd>
                                            <dt class="col-sm-2 text-sm-right">Date</dt>
                                            <dd class="col-sm-10 product-description">
                                                <?php echo formatDate($cms_form->date_raised, DFB, DFF); ?>
                                            </dd>
                                            <dt class="col-sm-2 text-sm-right">Description</dt>
                                            <dd class="col-sm-10 product-description">
                                                <?php echo $cms_form->change_description; ?>
                                            </dd>
                                            <dt class="col-sm-2 invisible d-sm-block d-none">..</dt>
                                            <dd class="col-sm-10">
                                                <a href="<?php echo URL_ROOT;?>/cms-forms/view-change-process/<?php echo $cms_form->cms_form_id;?>" title="View Change Process" class="btn w3-btn badge badge-success">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="<?php echo URL_ROOT;?>/cms-forms/download-change-process/<?php echo $cms_form->cms_form_id;?>" title="Download Change Process" class="btn w3-btn badge badge-primary">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </dd>
                                        </dl>
                                    </li>
                                    <?php  }
                                    ?>
                                    <!-- /.item -->
                                </ul>
                                <?php  }
                                else
                                { ?>
                                <p class="text-center text-muted">No Closed Change Proposal Applications</p>
                                <?php   }
                                ?>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center d-none" style="">
                                <a href="javascript:void(0)" class="uppercase scroll-to" data-target="">
<i class="fa fa-arrow-circle-up"></i> Scroll to Top</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                    </div>
                    <div class="col-12"></div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer d-none"></div>
            <!-- /.box-footer-->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once APP_ROOT.'\views\includes\footer.php';?>